<?php
require 'db_connect.php';

// Only Instructor
if ($_SESSION['role'] !== 'instructor') die("Unauthorized");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $course_id = $_POST['course_id'];
    $date      = date('Y-m-d');
    
    // Prepared Statement for insertion
    $stmt = $conn->prepare("INSERT INTO attendance (student_id, course_id, attendance_date, status) VALUES (?, ?, ?, ?)");

    // Loop through POST data
    // Assuming form inputs are named like: attendance[student_id] = 'Present'
    foreach ($_POST['attendance'] as $stud_id => $status) {
        $stmt->bind_param("iiss", $stud_id, $course_id, $date, $status);
        $stmt->execute();
    }
    
    echo "Attendance Saved Successfully.";
    $stmt->close();
}
?>