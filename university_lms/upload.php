<?php
require 'db_connect.php';

// Check if student is logged in
if ($_SESSION['role'] !== 'student') die("Unauthorized");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['assignment_file'])) {
    
    $student_id = $_SESSION['user_id'];
    $reg_no     = $_SESSION['reg_no'] ?? 'Unknown'; // Assuming you saved this in session
    $assign_id  = $_POST['assignment_id']; // Passed from hidden input in form

    // File Details
    $fileName = $_FILES['assignment_file']['name'];
    $fileTmp  = $_FILES['assignment_file']['tmp_name'];
    $fileExt  = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // 1. Validation
    $allowed = array('pdf', 'docx', 'doc');
    if (!in_array($fileExt, $allowed)) {
        die("Error: Only PDF and DOCX files allowed.");
    }

    // 2. Rename Logic: StudentID_AssignmentID.ext
    $newFileName = "SUB_" . $student_id . "_" . $assign_id . "." . $fileExt;
    $uploadDir   = "uploads/assignments/";
    
    // Ensure directory exists
    if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

    $destPath = $uploadDir . $newFileName;

    if (move_uploaded_file($fileTmp, $destPath)) {
        // 3. Save to Database
        $stmt = $conn->prepare("INSERT INTO submissions (assignment_id, student_id, file_path) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $assign_id, $student_id, $destPath);
        
        if ($stmt->execute()) {
            header("Location: student_dashboard.php?msg=UploadSuccess");
        } else {
            echo "Database Error.";
        }
    } else {
        echo "Error moving file.";
    }
}
?>