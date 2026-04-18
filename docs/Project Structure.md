# 🎯 OJAMS Project Structure

📊 **Visual Tree Overview**

```
OJAMS/
├── 📄 index.html
├── 📄 index.php
├── 📄 login.php
├── 📄 logout.php
├── 📄 register.php
├── 📄 README.md
├── 📁 docs/
│   ├── 📄 Project Structure.md
│   └── 📄 Tech Stacks.md
├── 📁 assets/
│   ├── 📁 css/
│   │   └── 📄 style.css
│   ├── 📁 images/
│   │   └── 📄 default-profile.svg
│   └── 📁 js/
│       ├── 📄 app.js
│       ├── 📄 data.js
│       └── 📄 script.js
├── 📁 components/
│   ├── 📄 application-row.php
│   ├── 📄 job-card.php
│   ├── 📄 stats-card.php
│   └── 📄 table-header.php
├── 📁 data/
│   └── 📄 sample-data.php
├── 📁 layouts/
│   ├── 📄 footer.php
│   ├── 📄 header.php
│   ├── 📄 navbar-admin.php
│   ├── 📄 navbar-user.php
│   └── 📄 sidebar-admin.php
├── 📁 modals/
│   ├── 📄 add-job-modal.php
│   ├── 📄 apply-job-modal.php
│   ├── 📄 edit-job-modal.php
│   ├── 📄 logout-modal.php
│   └── 📄 view-application-modal.php
└── 📁 pages/
    ├── 📁 admin/
    │   ├── 📄 applications.php
    │   ├── 📄 dashboard.php
    │   ├── 📄 manage-jobs.php
    │   └── 📄 reports.php
    └── 📁 user/
        ├── 📄 browse-jobs.php
        ├── 📄 my-applications.php
        └── 📄 profile-settings.php
```

## 📁 Root Directory Files

| Icon | File           | Description                   |
| ---- | -------------- | ----------------------------- |
| 📄   | `index.html`   | Static homepage (fallback)    |
| 📄   | `index.php`    | Main PHP homepage/entry point |
| 🔐   | `login.php`    | User login page               |
| 🚪   | `logout.php`   | User logout handler           |
| 👤   | `register.php` | User registration page        |
| 📖   | `README.md`    | Project documentation         |

- `index.html` - Static homepage (fallback)
- `index.php` - Main PHP homepage/entry point
- `login.php` - User login page
- `logout.php` - User logout handler
- `register.php` - User registration page
- `README.md` - Project documentation
- **Project Structure.md** - This file
- **Tech Stacks.md** - Technology stack documentation

## 🎨 Assets `<details><summary>Expand (5 files)</summary>`

**🎨 assets/**
| Icon | File | Description |
|------|------|-------------|
| 🎨 | `css/style.css` | Main stylesheet |
| 🖼️ | `images/default-profile.svg` | Default profile image |
| ⚙️ | `js/app.js` | Main app JS |
| 📊 | `js/data.js` | Sample data |
| ⚙️ | `js/script.js` | Additional scripts |

</details>

## 🧩 Components `<details><summary>Expand (4 files)</summary>`

**🧩 components/**
| Icon | File | Description |
|------|------|-------------|
| 📋 | `application-row.php` | Job application table row |
| 💼 | `job-card.php` | Job listing card |
| 📈 | `stats-card.php` | Dashboard stats cards |
| 📊 | `table-header.php` | Table headers |

</details>

## 🗄️ Data `<details><summary>Expand (1 file)</summary>`

**🗄️ data/**
| Icon | File | Description |
|------|------|-------------|
| 📁 | `sample-data.php` | Mock data for dev/testing |

</details>

## 📚 Docs `<details><summary>Expand</summary>`

Currently contains:

- 📄 `Project Structure.md` (this file)
- 📄 `Tech Stacks.md`

</details>

## 🎨 Layouts `<details><summary>Expand (5 files)</summary>`

**🏗️ layouts/**
| Icon | File | Description |
|------|------|-------------|
| ⬇️ | `footer.php` | Page footer |
| ⬆️ | `header.php` | Page header |
| 🧭 | `navbar-admin.php` | Admin nav bar |
| 🧭 | `navbar-user.php` | User nav bar |
| 📋 | `sidebar-admin.php` | Admin sidebar |

</details>

## 🪟 Modals `<details><summary>Expand (5 files)</summary>`

**🪟 modals/** (Bootstrap modals)
| Icon | File | Description |
|------|------|-------------|
| ➕ | `add-job-modal.php` | Add new job |
| ✅ | `apply-job-modal.php` | Apply to job |
| ✏️ | `edit-job-modal.php` | Edit job |
| 🚪 | `logout-modal.php` | Logout confirmation |
| 👁️ | `view-application-modal.php` | View application details |

</details>

## 🧭 Pages `<details><summary>Expand (7 files)</summary>`

**📄 pages/**

### 👑 Admin Pages

| Icon | File                     | Description         |
| ---- | ------------------------ | ------------------- |
| 📋   | `admin/applications.php` | Manage applications |
| 📊   | `admin/dashboard.php`    | Admin dashboard     |
| 💼   | `admin/manage-jobs.php`  | Job management      |
| 📈   | `admin/reports.php`      | Reports & analytics |

### 👤 User Pages

| Icon | File                        | Description      |
| ---- | --------------------------- | ---------------- |
| 🔍   | `user/browse-jobs.php`      | Job browser      |
| 📋   | `user/my-applications.php`  | My applications  |
| ⚙️   | `user/profile-settings.php` | Profile settings |

</details>

## 🏗️ Architecture Overview

```
┌─────────────────┐    ┌──────────────────┐
│     Frontend    │◄──►│   PHP Backend    │
│ HTML/CSS/JS/BS  │    │ Sessions/DB Conn │
└─────────────────┘    └──────────────────┘
         │                       │
    🎨 layouts/             🗄️ data/
    🧩 components/           📁 pages/
    🪟 modals/
```

- ![badge](https://img.shields.io/badge/Architecture-MVC%20like-brightgreen) pages/ (Views/Controllers)
- Role-based: Admin 👑 vs User 👤
- XAMPP 🐧: Local PHP/MySQL dev server
