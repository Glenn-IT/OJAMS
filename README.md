# 📋 OJAMS — Online Job Application Monitoring System

> A frontend-only, single-page prototype for a Job Application Monitoring System built for student presentations, UI/UX demonstrations, and system walkthroughs — **no backend required**.

---

## 📸 Overview

OJAMS is a clickable prototype that simulates a complete Job Application Monitoring workflow with two roles:

| Role         | Access                                                 |
| ------------ | ------------------------------------------------------ |
| 👤 **User**  | Browse Jobs, Apply, View My Applications, Edit Profile |
| 🛠️ **Admin** | Dashboard, Manage Jobs, Review Applications, Reports   |

---

## 🗂️ Project Structure

```
OJAMS/
├── index.html              # Main HTML — single-page structure
└── assets/
    ├── css/
    │   └── style.css       # All custom styles (17 sections)
    └── js/
        ├── data.js         # Static/dummy data & sidebar menus
        └── app.js          # All application logic (12 sections)
```

---

## 🛠️ Tech Stack

| Technology                                              | Purpose                                |
| ------------------------------------------------------- | -------------------------------------- |
| HTML5                                                   | Page structure                         |
| CSS3                                                    | Custom styling                         |
| [Bootstrap 5.3](https://getbootstrap.com/)              | UI components & layout (CDN)           |
| [Bootstrap Icons 1.11](https://icons.getbootstrap.com/) | Icons (CDN)                            |
| Vanilla JavaScript                                      | SPA navigation, modals, data rendering |

> ⚠️ **No frameworks** (React, Vue, Angular) — pure HTML, CSS, and JavaScript only.  
> ⚠️ **No backend** — all data is static and stored in `assets/js/data.js`.

---

## 🚀 How to Run

You can run this project in **two ways**. Choose the one that suits your setup.

---

### ✅ Method 1 — Using XAMPP (Recommended)

> Best if you already have [XAMPP](https://www.apachefriends.org/) installed.

1. **Download or clone this repository** into your XAMPP `htdocs` folder:

   ```bash
   git clone https://github.com/Glenn-IT/OJAMS.git C:/xampp/htdocs/OJAMS
   ```

   Or manually copy the folder so the path is:

   ```
   C:\xampp\htdocs\OJAMS\index.html
   ```

2. **Start XAMPP** and turn on the **Apache** module.

3. **Open your browser** and go to:

   ```
   http://localhost/OJAMS/
   ```

4. The app should load immediately. ✅

---

### ✅ Method 2 — Open Directly in Browser (No Server Needed)

> Since this is a **frontend-only** project with **no PHP or database**, you can open it directly.

1. **Download or clone this repository**:

   ```bash
   git clone https://github.com/Glenn-IT/OJAMS.git
   ```

2. **Navigate** to the downloaded folder.

3. **Double-click** `index.html` — it will open in your default browser.

   Or right-click → **Open with** → choose your browser (Chrome, Edge, Firefox, etc.)

4. The app should load immediately. ✅

---

### ✅ Method 3 — Using VS Code Live Server Extension

> Best for developers who use [Visual Studio Code](https://code.visualstudio.com/).

1. **Clone the repository**:

   ```bash
   git clone https://github.com/Glenn-IT/OJAMS.git
   ```

2. **Open the folder** in VS Code:

   ```bash
   cd OJAMS
   code .
   ```

3. Install the **Live Server** extension by Ritwick Dey (if not already installed):
   - Press `Ctrl + Shift + X`
   - Search for `Live Server`
   - Click **Install**

4. Right-click `index.html` → **Open with Live Server**

5. The browser will open at:

   ```
   http://127.0.0.1:5500/index.html
   ```

---

## 🔑 Demo Credentials

> This is a prototype — **no real authentication is implemented**. Any input will log you in.

| Field    | Value                     |
| -------- | ------------------------- |
| Username | `user1` _(pre-filled)_    |
| Password | `password` _(pre-filled)_ |

Simply click the **Login** button. No validation is enforced.

---

## 🔁 Switching Roles

Use the **role toggle bar** at the very top of the page:

- Click **👤 User** — shows User navigation and sections
- Click **🛠 Admin** — shows Admin navigation and sections

You can switch roles **at any time**, even while logged in.

---

## 📦 Features

### 👤 User Module

- [x] Login & Registration (modal form)
- [x] Browse Job listings (searchable cards)
- [x] Job Application Form (personal info, education, skills, ID upload)
- [x] My Applications table with status tracking
- [x] Profile Settings (view & edit)
- [x] Logout confirmation modal

### 🛠️ Admin Module

- [x] Dashboard with stat cards & recent activity log
- [x] Manage Jobs (Add / Edit / Delete with modals)
- [x] Applications table (Approve / Reject / View Details)
- [x] Reports & Monitoring (per-job table, monthly report, chart placeholder)
- [x] Download Report (prototype alert)

---

## ⚠️ Limitations

| Limitation        | Details                                  |
| ----------------- | ---------------------------------------- |
| No backend        | All data is in-memory JavaScript arrays  |
| No database       | Data resets on every page refresh        |
| No authentication | Login accepts any input                  |
| No file upload    | File inputs are UI-only                  |
| No real download  | Download button shows a toast alert only |

---

## 📄 License

This project is for **educational and demonstration purposes only**.

---

## 👤 Author

**Glenn-IT**  
GitHub: [https://github.com/Glenn-IT](https://github.com/Glenn-IT)
