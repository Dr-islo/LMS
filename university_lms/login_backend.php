<?php
require 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reg_id = trim($_POST['reg_id']);
    $pass   = $_POST['password'];

    // Prevent SQL Injection
    $stmt = $conn->prepare("SELECT id, reg_no, password_hash, role, full_name, fee_status FROM users WHERE reg_no = ?");
    $stmt->bind_param("s", $reg_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        // Verify Password
        if (password_verify($pass, $row['password_hash'])) {
            
            // Set Session Variables
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['role']    = $row['role'];
            $_SESSION['name']    = $row['full_name'];
            $_SESSION['fee']     = $row['fee_status']; // For the Student Banner

            // Redirect based on Role
            switch ($row['role']) {
                case 'student':
                    header("Location: student_dashboard.php");
                    break;
                case 'instructor':
                    header("Location: instructor_dashboard.php");
                    break;
                case 'admin':
                    header("Location: admin_dashboard.php");
                    break;
                default:
                    echo "Invalid Role Assigned.";
            }
            exit();
        } else {
            echo "Invalid Password.";
        }
    } else {
        echo "User not found.";
    }
    $stmt->close();
    $conn->close();
}
?>