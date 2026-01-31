<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: login.html");
    exit();
}
$fee_status = $_SESSION['fee']; // Get fee status from login session
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="fee-alert" class="alert-banner">
        <span>⚠ Alert: You have unpaid semester fees. Please clear your dues.</span>
        <button onclick="downloadVoucher()">Download Voucher</button>
        <button style="background:transparent; color:white; border:1px solid white;" onclick="dismissBanner()">Dismiss</button>
    </div>

    <div class="navbar">
        <div class="brand">University Portal</div>
        <div class="nav-links">
            <a href="#">Dashboard</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>

    <div class="container">
        <div class="card">
            <div class="grid-2">
                <div>
                    <h2>John Doe</h2>
                    <p class="text-light">Reg: S-2024-105 | Session: 2024-2028</p>
                </div>
                <div style="text-align: right;">
                    <p><strong>Admission:</strong> Sept 2024</p>
                    <p><strong>CGPA:</strong> 3.45</p>
                </div>
            </div>
        </div>

        <div class="grid-2">
            <div class="card">
                <h3>Today's Schedule</h3>
                <table>
                    <thead><tr><th>Time</th><th>Subject</th><th>Room</th></tr></thead>
                    <tbody>
                        <tr><td>09:00 AM</td><td>Data Structures</td><td>Rm 101</td></tr>
                        <tr><td>11:00 AM</td><td>Linear Algebra</td><td>Rm 204</td></tr>
                    </tbody>
                </table>
            </div>

            <div class="card">
                <h3>Attendance</h3>
                <p>Data Structures: <strong>85%</strong></p>
                <div style="background:#ddd; height:10px; border-radius:5px; margin-top:5px;">
                    <div style="background:var(--success); width:85%; height:100%; border-radius:5px;"></div>
                </div>
                <br>
                <p>Linear Algebra: <strong>60%</strong></p>
                <div style="background:#ddd; height:10px; border-radius:5px; margin-top:5px;">
                    <div style="background:var(--accent); width:60%; height:100%; border-radius:5px;"></div>
                </div>
            </div>
        </div>

        <div class="card">
            <h3>Pending Assignments</h3>
            <table>
                <thead><tr><th>Subject</th><th>Title</th><th>Due Date</th><th>Action</th></tr></thead>
                <tbody>
                    <tr>
                        <td>Data Structures</td>
                        <td>LinkedList Implementation</td>
                        <td>2024-02-15</td>
                        <td>
                            <form action="upload.php" method="POST" enctype="multipart/form-data">
                                <input type="file" name="assignment_file" required>
                                <button type="submit" style="margin-top:5px; width:100%;">Upload</button>
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td>Database Systems</td>
                        <td>ERD Design</td>
                        <td style="color:var(--danger)">2023-12-01 (Closed)</td>
                        <td><button disabled style="background:#ccc; cursor:not-allowed;">Closed</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    
    <script>
        // Simulate backend variable
        const feeStatus = 'unpaid'; 
    </script>
    <script src="main.js"></script>
</body>
</html>