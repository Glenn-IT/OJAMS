# 📋 OJAMS — Online Job Application Monitoring System

> A frontend-focused PHP prototype for a Job Application Monitoring System built for student presentations, UI/UX demonstrations, and system walkthroughs — **using sample data only, no database required**.

---

## 📸 Overview

OJAMS is a structured PHP prototype that simulates a complete Job Application Monitoring workflow with two roles:

| Role         | Access                                                 |
| ------------ | ------------------------------------------------------ |
| 👤 **User**  | Browse Jobs, Apply, View My Applications, Edit Profile |
| 🛠️ **Admin** | Dashboard, Manage Jobs, Review Applications, Reports   |

---

## 🛠️ Technology Stack

- **PHP** — Modular file structure (MVC-like)
- **Bootstrap 5** — Via CDN for responsive UI
- **Bootstrap Icons** — Via CDN for iconography
- **Vanilla JavaScript** — For interactions & prototype alerts
- **Sample Data** — PHP arrays (no database)

---

## 🗂️ Project Structure

```
OJAMS/
│
├── index.php                  # Entry point (redirects to login)
├── login.php                  # Login page with role selection
├── register.php               # Registration page (prototype)
├── logout.php                 # Logout handler (redirect)
│
├── data/
│   └── sample-data.php        # All sample data arrays
│
├── layouts/
│   ├── header.php             # HTML head & meta tags
│   ├── footer.php             # Scripts & closing tags
│   ├── navbar-user.php        # User navigation bar
│   ├── navbar-admin.php       # Admin top navigation bar
│   └── sidebar-admin.php      # Admin sidebar navigation
│
├── pages/
│   ├── user/
│   │   ├── browse-jobs.php        # Job listings with cards
│   │   ├── my-applications.php    # User's application history
│   │   └── profile-settings.php   # Profile view & edit
│   │
│   └── admin/
│       ├── dashboard.php          # Stats & activity overview
│       ├── manage-jobs.php        # CRUD table for jobs
│       ├── applications.php       # Approve/reject applications
│       └── reports.php            # Reports & analytics
│
├── components/
│   ├── job-card.php           # Reusable job listing card
│   ├── stats-card.php         # Dashboard stat card
│   ├── application-row.php    # Application table row
│   └── table-header.php       # Reusable table header
│
├── modals/
│   ├── apply-job-modal.php        # Full application form
│   ├── add-job-modal.php          # Admin: add new job
│   ├── edit-job-modal.php         # Admin: edit existing job
│   ├── view-application-modal.php # Admin: view applicant details
│   └── logout-modal.php          # Logout confirmation
│
├── assets/
│   ├── css/
│   │   └── style.css          # Custom styles
│   ├── js/
│   │   └── script.js          # JavaScript behaviors
│   └── images/
│       └── default-profile.svg
│
└── README.md
```

---

## 🚀 Getting Started

### Prerequisites

- **XAMPP** (or any PHP-enabled web server)
- A modern web browser

### Installation

1. Clone or copy this project into your web server's document root:
   ```
   C:\xampp\htdocs\OJAMS\
   ```
2. Start **Apache** in XAMPP.
3. Open your browser and navigate to:
   ```
   http://localhost/OJAMS/
   ```
4. You'll be redirected to the **Login Page** where you can choose to enter as:
   - **User** — Browse jobs, apply, and manage your profile
   - **Admin** — Dashboard, manage jobs, review applications, reports

---

## 📖 Module Details

### 🔐 Authentication (Prototype)

- **Login** — Role-based navigation (User / Admin buttons)
- **Register** — Sample registration form with alert
- **Logout** — Confirmation modal, redirects to login

### 👤 User Module

| Page                 | Description                                                                        |
| -------------------- | ---------------------------------------------------------------------------------- |
| **Browse Jobs**      | Job cards with title, company, description, qualifications, date, and Apply button |
| **My Applications**  | Table of submitted applications with status badges                                 |
| **Profile Settings** | View personal info, toggle edit mode                                               |

### 🛡️ Admin Module

| Page             | Description                                                         |
| ---------------- | ------------------------------------------------------------------- |
| **Dashboard**    | Stat cards (jobs, applicants, pending, approved) + activity history |
| **Manage Jobs**  | Table with Edit/Delete actions + Add New Job modal                  |
| **Applications** | Approve/Reject/View details for each applicant                      |
| **Reports**      | Applicants per job, monthly report, download button                 |

---

## 💡 Design Principles

- ✅ Clean, modular PHP structure (MVC-like separation)
- ✅ Reusable components (`job-card`, `stats-card`, `table-header`, etc.)
- ✅ PHP `include` for layouts — no duplicate HTML
- ✅ Responsive design with Bootstrap 5
- ✅ All data from PHP arrays — no database needed
- ✅ Descriptive comments in every file
- ✅ Clear naming conventions

---

## ⚠️ Disclaimer

This is a **prototype** for academic/demonstration purposes only. No real authentication, database, or backend logic is implemented. All actions trigger placeholder alerts.

---

## 📄 License

This project is for educational purposes.
This is made by Glenard Pagurayan

---

&copy; 2026 OJAMS — Online Job Application Monitoring System
