<?php
require 'db_connect.php';
if ($_SESSION['role'] !== 'admin') die("Unauthorized");

if (isset($_FILES['user_csv'])) {
    
    $fileName = $_FILES['user_csv']['tmp_name'];
    $role     = $_POST['role']; // 'student' or 'instructor'

    if ($_FILES['user_csv']['size'] > 0) {
        
        $file = fopen($fileName, "r");
        
        // Skip Header Row if necessary
        fgetcsv($file); 

        // Prepare Insert Statement (Password is NULL)
        $stmt = $conn->prepare("INSERT INTO users (reg_no, full_name, session, role, fee_status) VALUES (?, ?, ?, ?, 'unpaid')");

        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
            // CSV Structure assumed: Col 0 = RegNo, Col 1 = Name, Col 2 = Session
            $reg_no  = $column[0];
            $name    = $column[1];
            $session = $column[2];

            $stmt->bind_param("ssss", $reg_no, $name, $session, $role);
            $stmt->execute();
        }
        
        echo "Bulk Import Complete.";
        fclose($file);
    }
}
?>