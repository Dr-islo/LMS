<?php
require 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reg_id = trim($_POST['reg_id']);
    $pass   = $_POST['new_password'];
    $conf   = $_POST['confirm_password'];

    // 1. Validation
    if ($pass !== $conf) {
        die("Passwords do not match.");
    }

    // 2. Check if User exists and is NOT yet registered
    // We look for a row with this Reg ID where password is NULL
    $stmt = $conn->prepare("SELECT id FROM users WHERE reg_no = ? AND password_hash IS NULL");
    $stmt->bind_param("s", $reg_id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        // 3. User found, set the password
        $hashed_password = password_hash($pass, PASSWORD_BCRYPT);
        
        $update_stmt = $conn->prepare("UPDATE users SET password_hash = ? WHERE reg_no = ?");
        $update_stmt->bind_param("ss", $hashed_password, $reg_id);
        
        if ($update_stmt->execute()) {
            echo "Registration Successful! <a href='login.html'>Login Now</a>";
        } else {
            echo "Error updating record.";
        }
        $update_stmt->close();
    } else {
        die("Invalid Registration ID or Account already registered.");
    }
    $stmt->close();
    $conn->close();
}
?>