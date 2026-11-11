# 🎓 University LMS

A role-based **Learning Management System** for universities, built with **PHP, MySQL, HTML, CSS and JavaScript**. Students, instructors and admins each get their own dashboard.

![PHP](https://img.shields.io/badge/PHP-777BB4?style=flat-square&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=flat-square&logo=mysql&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=flat-square&logo=javascript&logoColor=black)
![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=flat-square&logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=flat-square&logo=css3&logoColor=white)

## ✨ Features

**🔐 Authentication & security**
- Registration only works for IDs an admin has already added, so there are no open sign-ups
- Passwords hashed with `password_hash()` / `password_verify()` (bcrypt)
- **Prepared statements** on all write and login queries to prevent SQL injection
- Role-based routing after login: student → student dashboard, instructor → instructor dashboard, admin → admin dashboard

**🛠️ Admin dashboard**
- **Bulk CSV upload** to create student and instructor records, including fee status, in one go

**👩‍🏫 Instructor dashboard**
- Create assignments with due dates
- Review submissions and enter grades
- **Mark attendance** for a class

**🎒 Student dashboard**
- Profile and attendance overview
- Fee status alert when fees are unpaid
- **Upload assignments** before the due date

## 📁 Project structure

```
university_lms/
├── login.html               # Login / register UI
├── login_backend.php        # Auth + role-based redirect
├── register_backend.php     # Account activation for pre-registered IDs
├── admin_dashboard.php
├── instructor_dashboard.php
├── student_dashboard.php
├── bulk_upload.php          # CSV import (admin)
├── mark_attendance.php      # Attendance (instructor)
├── upload.php               # Assignment submissions (student)
├── db_connect.php
├── main.js · style.css
└── uploads/assignments/
SQL.txt                      # Database schema + seed data
idea.text                    # Full product spec
```

## 🚀 Run it locally (XAMPP)

1. Copy the `university_lms` folder into `xampp/htdocs/`.
2. Start **Apache** and **MySQL** in XAMPP.
3. Open <http://localhost/phpmyadmin/>, click **New**, and create a database called `university_lms`.
4. Open the **SQL** tab, paste the contents of [`SQL.txt`](SQL.txt), and click **Go**.
5. Visit <http://localhost/university_lms/login.html>.

### Demo accounts

| Role | Registration ID | Password |
|---|---|---|
| Admin | `admin` | `123` |
| Instructor | `instructor` | `123` |
| Student | `student` | `123` |

> These are local demo credentials only. Change them before deploying anywhere.

## 📌 Roadmap

The full product spec is in [`idea.text`](idea.text). Next up: weighted grading policies, CSV grade import, a master timetable and finance vouchers.

---

Built by [Rehan Ali](https://github.com/Dr-islo)
