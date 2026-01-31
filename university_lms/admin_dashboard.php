<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="navbar">
        <div class="brand">Admin Control Center</div>
        <div class="nav-links"><a href="logout.php">Logout</a></div>
    </div>

    <div class="container">
        <div class="grid-2">
            <div class="card">
                <h3>Bulk User Creation</h3>
                <p>Upload a CSV file to generate placeholders for Students/Instructors.</p>
                <br>
                <form action="bulk_upload.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>User Role</label>
                        <select name="role">
                            <option value="student">Students</option>
                            <option value="instructor">Instructors</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Upload CSV</label>
                        <input type="file" name="user_csv" accept=".csv" required>
                    </div>
                    <button type="submit">Process CSV</button>
                </form>
            </div>

            <div class="card">
                <h3>Finance Status Update</h3>
                <div class="form-group">
                    <label>Search Student (Reg No)</label>
                    <input type="text" placeholder="Enter Reg No">
                </div>
                <div class="form-group">
                    <label>New Status</label>
                    <select>
                        <option value="paid">Paid</option>
                        <option value="unpaid">Unpaid</option>
                    </select>
                </div>
                <button class="btn-danger">Update Status</button>
            </div>
        </div>

        <div class="card">
            <h3>Master Schedule Manager</h3>
            <table>
                <thead><tr><th>Session</th><th>Day</th><th>Time</th><th>Subject</th><th>Room</th><th>Instructor</th><th>Action</th></tr></thead>
                <tbody>
                    <tr>
                        <td>BSCS-2024</td>
                        <td>Monday</td>
                        <td>09:00</td>
                        <td>Prog. Fund.</td>
                        <td>Lab 1</td>
                        <td>Dr. Alan</td>
                        <td><button class="btn-outline" style="padding:2px 8px;">Edit</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>