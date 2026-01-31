<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'instructor') {
    header("Location: login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Instructor Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="navbar">
        <div class="brand">Instructor Panel</div>
        <div class="nav-links">
            <a href="logout.php">Logout</a>
        </div>
    </div>

    <div class="container">
        <div class="card" style="border-left: 5px solid var(--accent);">
            <p><strong>🔔 Action Required:</strong> You have 5 unchecked assignments for <em>Data Structures</em>.</p>
        </div>

        <div class="grid-2">
            <div class="card">
                <h3>Create New Assignment</h3>
                <form action="create_assignment.php" method="POST">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" required>
                    </div>
                    <div class="form-group">
                        <label>Target Class</label>
                        <select><option>BSCS - Sem 4</option><option>BSIT - Sem 2</option></select>
                    </div>
                    <div class="form-group">
                        <label>Due Date</label>
                        <input type="date" name="due_date" required>
                    </div>
                    <button type="submit">Publish Assignment</button>
                </form>
            </div>

            <div class="card">
                <h3>Upload Lecture Notes</h3>
                <form action="upload_notes.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Select File (PDF/PPT)</label>
                        <input type="file" name="lecture_file">
                    </div>
                    <button type="submit" class="btn-outline">Upload Resource</button>
                </form>
            </div>
        </div>

        <div class="card">
            <div style="display:flex; justify-content:space-between; align-items:center;">
                <h3>Mark Attendance</h3>
                <button class="btn-outline">Save Attendance</button>
            </div>
            <table>
                <thead><tr><th>Reg No</th><th>Name</th><th>Present</th><th>Absent</th></tr></thead>
                <tbody>
                    <tr>
                        <td>S-2024-001</td>
                        <td>Alice Smith</td>
                        <td><input type="radio" name="att_1" value="P" checked></td>
                        <td><input type="radio" name="att_1" value="A"></td>
                    </tr>
                    <tr>
                        <td>S-2024-002</td>
                        <td>Bob Jones</td>
                        <td><input type="radio" name="att_2" value="P"></td>
                        <td><input type="radio" name="att_2" value="A" checked></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="card">
            <h3>Grading Interface</h3>
            <div style="background: #eef; padding: 15px; border-radius: 5px; margin-bottom: 15px;">
                <label><strong>Bulk Import Grades (CSV)</strong></label>
                <p style="font-size:0.8rem; margin-bottom:5px;">Format: RegNo, Marks (e.g., S-001, 85)</p>
                <input type="file" accept=".csv">
                <button style="margin-top:5px;">Import CSV</button>
            </div>
            
            <table>
                <thead><tr><th>Student</th><th>Submission</th><th>Marks / 100</th></tr></thead>
                <tbody>
                    <tr>
                        <td>Alice Smith</td>
                        <td><a href="#">View PDF</a></td>
                        <td><input type="number" style="width:80px;" value="0"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>