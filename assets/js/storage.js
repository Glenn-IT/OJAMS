/* ==========================================================
   OJAMS – LocalStorage Manager
   Handles all CRUD operations for:
   - Users (register, login, profile update)
   - Jobs  (add, edit, delete)
   - Applications (submit, cancel, update status)
   - Session (login state, current user)
   ==========================================================
   Keys used in localStorage:
     ojams_users        → Array of user objects
     ojams_jobs         → Array of job objects
     ojams_applications → Array of application objects
     ojams_session      → Current logged-in user object (or null)
     ojams_activity     → Array of activity log entries
========================================================== */

/* ── Helpers ──────────────────────────────────────────── */
function _get(key) {
  try {
    return JSON.parse(localStorage.getItem(key));
  } catch {
    return null;
  }
}
function _set(key, value) {
  localStorage.setItem(key, JSON.stringify(value));
}

/* ── Seed: Initialise default data if not yet stored ──── */
function seedStorage() {
  // ── Default Admin Account
  if (!_get("ojams_users")) {
    _set("ojams_users", [
      {
        id: 1,
        role: "admin",
        full_name: "Administrator",
        email: "admin@ojams.com",
        password: "admin123",
        contact_number: "09000000000",
        address: "OJAMS HQ",
        birthdate: "1990-01-01",
        age: 36,
        created_at: "2026-01-01",
      },
      {
        id: 2,
        role: "user",
        full_name: "Juan Dela Cruz",
        email: "juan@email.com",
        password: "password123",
        contact_number: "09171234567",
        address: "123 Main St, Quezon City, Metro Manila",
        birthdate: "1998-05-15",
        age: 27,
        created_at: "2026-03-01",
      },
    ]);
  }

  // ── Default Jobs
  if (!_get("ojams_jobs")) {
    _set("ojams_jobs", [
      {
        id: 1,
        title: "Web Developer",
        company: "ABC Technologies",
        description:
          "Develop and maintain company websites using modern frameworks and technologies.",
        qualification: "HTML, CSS, JavaScript, PHP",
        date_posted: "2026-03-20",
        status: "Open",
      },
      {
        id: 2,
        title: "IT Support Specialist",
        company: "TechFix Solutions",
        description:
          "Provide technical support to end-users and troubleshoot hardware/software issues.",
        qualification: "Basic networking and troubleshooting",
        date_posted: "2026-03-18",
        status: "Open",
      },
      {
        id: 3,
        title: "Data Analyst",
        company: "DataWorks Inc.",
        description:
          "Analyze datasets and generate actionable insights for business stakeholders.",
        qualification: "Excel, SQL, Python, Statistics",
        date_posted: "2026-03-15",
        status: "Closed",
      },
      {
        id: 4,
        title: "Graphic Designer",
        company: "Creative Minds Studio",
        description:
          "Design marketing materials, social media assets, and brand collateral.",
        qualification: "Adobe Photoshop, Illustrator, Figma",
        date_posted: "2026-03-22",
        status: "Open",
      },
      {
        id: 5,
        title: "Network Administrator",
        company: "ConnectPH Corp.",
        description:
          "Manage and monitor corporate network infrastructure and security.",
        qualification: "CCNA, Network Security, Linux",
        date_posted: "2026-03-10",
        status: "Open",
      },
      {
        id: 6,
        title: "Mobile App Developer",
        company: "AppForge PH",
        description:
          "Build and maintain cross-platform mobile applications for clients.",
        qualification: "Flutter, React Native, Dart",
        date_posted: "2026-03-24",
        status: "Open",
      },
    ]);
  }

  // ── Default Applications
  if (!_get("ojams_applications")) {
    _set("ojams_applications", [
      {
        id: 1,
        user_id: 2,
        user_name: "Juan Dela Cruz",
        email: "juan@email.com",
        job_id: 1,
        job_title: "Web Developer",
        company: "ABC Technologies",
        date_applied: "2026-03-22",
        status: "Pending",
        skills: "HTML, CSS, JavaScript, PHP",
        experience: "Intern at ABC Corp (2024-2025)",
        education: { elementary: "", jhs: "", shs: "", college: "" },
        address: "123 Main St, Quezon City",
        contact: "09171234567",
        birthdate: "1998-05-15",
        age: 27,
      },
      {
        id: 2,
        user_id: 2,
        user_name: "Juan Dela Cruz",
        email: "juan@email.com",
        job_id: 2,
        job_title: "IT Support Specialist",
        company: "TechFix Solutions",
        date_applied: "2026-03-24",
        status: "Approved",
        skills: "Networking, Troubleshooting",
        experience: "",
        education: { elementary: "", jhs: "", shs: "", college: "" },
        address: "123 Main St, Quezon City",
        contact: "09171234567",
        birthdate: "1998-05-15",
        age: 27,
      },
    ]);
  }

  // ── Default Activity Log
  if (!_get("ojams_activity")) {
    _set("ojams_activity", [
      {
        date: "2026-03-24",
        time: "02:15 PM",
        action: "New application received from Juan Dela Cruz",
        status: "New",
      },
      {
        date: "2026-03-23",
        time: "10:30 AM",
        action: 'Job post "Mobile App Developer" created',
        status: "Created",
      },
      {
        date: "2026-03-22",
        time: "09:00 AM",
        action: "Application of Juan Dela Cruz submitted",
        status: "New",
      },
      {
        date: "2026-03-21",
        time: "03:45 PM",
        action: "Application status updated to Approved",
        status: "Approved",
      },
    ]);
  }
}

/* ══════════════════════════════════════════════════════════
   SESSION
══════════════════════════════════════════════════════════ */
const Session = {
  get() {
    return _get("ojams_session");
  },
  set(user) {
    _set("ojams_session", user);
  },
  clear() {
    localStorage.removeItem("ojams_session");
  },
  isLoggedIn() {
    return !!this.get();
  },
  isAdmin() {
    const s = this.get();
    return s && s.role === "admin";
  },
  isUser() {
    const s = this.get();
    return s && s.role === "user";
  },
};

/* ══════════════════════════════════════════════════════════
   USERS CRUD
══════════════════════════════════════════════════════════ */
const Users = {
  all() {
    return _get("ojams_users") || [];
  },

  findById(id) {
    return this.all().find((u) => u.id === id) || null;
  },

  findByEmail(email) {
    return (
      this.all().find((u) => u.email.toLowerCase() === email.toLowerCase()) ||
      null
    );
  },

  /** Create (Register) a new user */
  create(data) {
    const users = this.all();
    if (this.findByEmail(data.email))
      return { success: false, message: "Email already registered." };
    const newUser = {
      id: Date.now(),
      role: "user",
      full_name: data.full_name,
      email: data.email,
      password: data.password,
      contact_number: data.contact_number || "",
      address: data.address || "",
      birthdate: data.birthdate || "",
      age: data.age || "",
      created_at: new Date().toISOString().split("T")[0],
    };
    users.push(newUser);
    _set("ojams_users", users);
    logActivity(`New user registered: ${newUser.full_name}`, "New");
    return { success: true, user: newUser };
  },

  /** Update (Edit) user profile */
  update(id, data) {
    const users = this.all();
    const idx = users.findIndex((u) => u.id === id);
    if (idx === -1) return { success: false, message: "User not found." };
    users[idx] = { ...users[idx], ...data };
    _set("ojams_users", users);
    // Refresh session if editing self
    if (Session.get() && Session.get().id === id) Session.set(users[idx]);
    logActivity(`User profile updated: ${users[idx].full_name}`, "Updated");
    return { success: true, user: users[idx] };
  },

  /** Delete user (Admin only) */
  delete(id) {
    let users = this.all();
    const user = this.findById(id);
    if (!user) return { success: false, message: "User not found." };
    users = users.filter((u) => u.id !== id);
    _set("ojams_users", users);
    logActivity(`User deleted: ${user.full_name}`, "Deleted");
    return { success: true };
  },

  /** Authenticate login */
  authenticate(email, password) {
    const user = this.findByEmail(email);
    if (!user) return { success: false, message: "Email not found." };
    if (user.password !== password)
      return { success: false, message: "Incorrect password." };
    return { success: true, user };
  },
};

/* ══════════════════════════════════════════════════════════
   JOBS CRUD
══════════════════════════════════════════════════════════ */
const Jobs = {
  all() {
    return _get("ojams_jobs") || [];
  },

  findById(id) {
    return this.all().find((j) => j.id === id) || null;
  },

  /** Create – Admin only */
  create(data) {
    const jobs = this.all();
    const newJob = {
      id: Date.now(),
      title: data.title,
      company: data.company,
      description: data.description,
      qualification: data.qualification,
      date_posted: data.date_posted || new Date().toISOString().split("T")[0],
      status: data.status || "Open",
    };
    jobs.push(newJob);
    _set("ojams_jobs", jobs);
    logActivity(
      `New job posted: "${newJob.title}" at ${newJob.company}`,
      "Created",
    );
    return { success: true, job: newJob };
  },

  /** Update – Admin only */
  update(id, data) {
    const jobs = this.all();
    const idx = jobs.findIndex((j) => j.id === id);
    if (idx === -1) return { success: false, message: "Job not found." };
    jobs[idx] = { ...jobs[idx], ...data };
    _set("ojams_jobs", jobs);
    logActivity(`Job updated: "${jobs[idx].title}"`, "Updated");
    return { success: true, job: jobs[idx] };
  },

  /** Delete – Admin only */
  delete(id) {
    let jobs = this.all();
    const job = this.findById(id);
    if (!job) return { success: false, message: "Job not found." };
    jobs = jobs.filter((j) => j.id !== id);
    _set("ojams_jobs", jobs);
    logActivity(`Job deleted: "${job.title}"`, "Deleted");
    return { success: true };
  },
};

/* ══════════════════════════════════════════════════════════
   APPLICATIONS CRUD
══════════════════════════════════════════════════════════ */
const Applications = {
  all() {
    return _get("ojams_applications") || [];
  },

  findById(id) {
    return this.all().find((a) => a.id === id) || null;
  },

  /** Get applications for a specific user */
  byUser(userId) {
    return this.all().filter((a) => a.user_id === userId);
  },

  /** Get application by user+job (to prevent duplicates) */
  findByUserJob(userId, jobId) {
    return (
      this.all().find((a) => a.user_id === userId && a.job_id === jobId) || null
    );
  },

  /** Create – User submits application */
  create(data) {
    const apps = this.all();
    if (this.findByUserJob(data.user_id, data.job_id)) {
      return {
        success: false,
        message: "You have already applied for this job.",
      };
    }
    const newApp = {
      id: Date.now(),
      user_id: data.user_id,
      user_name: data.user_name,
      email: data.email,
      job_id: data.job_id,
      job_title: data.job_title,
      company: data.company,
      date_applied: new Date().toISOString().split("T")[0],
      status: "Pending",
      skills: data.skills || "",
      experience: data.experience || "",
      education: data.education || {
        elementary: "",
        jhs: "",
        shs: "",
        college: "",
      },
      address: data.address || "",
      contact: data.contact || "",
      birthdate: data.birthdate || "",
      age: data.age || "",
    };
    apps.push(newApp);
    _set("ojams_applications", apps);
    logActivity(
      `New application from ${newApp.user_name} for "${newApp.job_title}"`,
      "New",
    );
    return { success: true, application: newApp };
  },

  /** Update status – Admin only (Approve / Reject) */
  updateStatus(id, status) {
    const apps = this.all();
    const idx = apps.findIndex((a) => a.id === id);
    if (idx === -1)
      return { success: false, message: "Application not found." };
    apps[idx].status = status;
    _set("ojams_applications", apps);
    logActivity(
      `Application of ${apps[idx].user_name} marked as ${status}`,
      status,
    );
    return { success: true, application: apps[idx] };
  },

  /** Delete (cancel) – User can cancel own Pending application */
  delete(id, requesterId = null) {
    let apps = this.all();
    const app = this.findById(id);
    if (!app) return { success: false, message: "Application not found." };
    if (requesterId && app.user_id !== requesterId)
      return { success: false, message: "Unauthorized." };
    if (requesterId && app.status !== "Pending")
      return {
        success: false,
        message: "Only pending applications can be cancelled.",
      };
    apps = apps.filter((a) => a.id !== id);
    _set("ojams_applications", apps);
    logActivity(
      `Application cancelled by ${app.user_name} for "${app.job_title}"`,
      "Cancelled",
    );
    return { success: true };
  },
};

/* ══════════════════════════════════════════════════════════
   ACTIVITY LOG
══════════════════════════════════════════════════════════ */
function logActivity(action, status) {
  const log = _get("ojams_activity") || [];
  const now = new Date();
  log.unshift({
    date: now.toISOString().split("T")[0],
    time: now.toLocaleTimeString("en-PH", {
      hour: "2-digit",
      minute: "2-digit",
    }),
    action,
    status,
  });
  // Keep only last 50 entries
  _set("ojams_activity", log.slice(0, 50));
}

function getActivityLog() {
  return _get("ojams_activity") || [];
}

/* ── Auth Guard Helpers ───────────────────────────────── */

/**
 * requireAdmin(loginPath, wrongRolePath)
 * Checks login AND admin role in ONE call to prevent
 * sequential-redirect loops (the prior two-call pattern
 * caused an infinite redirect between pages).
 */
function requireAdmin(loginPath, wrongRolePath) {
  if (!Session.isLoggedIn()) {
    window.location.replace(loginPath || "/OJAMS/login.php");
    return;
  }
  if (!Session.isAdmin()) {
    window.location.replace(
      wrongRolePath || "/OJAMS/pages/user/browse-jobs.php",
    );
  }
}

/**
 * requireUser(loginPath, wrongRolePath)
 * Checks login AND user role in ONE call.
 */
function requireUser(loginPath, wrongRolePath) {
  if (!Session.isLoggedIn()) {
    window.location.replace(loginPath || "/OJAMS/login.php");
    return;
  }
  if (!Session.isUser()) {
    window.location.replace(
      wrongRolePath || "/OJAMS/pages/admin/dashboard.php",
    );
  }
}

/** requireLogin – kept for login.php only (no role check needed there) */
function requireLogin(redirectPath) {
  if (!Session.isLoggedIn()) {
    window.location.replace(redirectPath || "/OJAMS/login.php");
  }
}

/* ── Toast Notification Helper ───────────────────────── */
function showToast(msg, type = "success") {
  const iconMap = {
    success: "check-circle",
    danger: "x-circle",
    warning: "exclamation-circle",
    info: "info-circle",
  };
  const icon = iconMap[type] || "info-circle";
  let container = document.getElementById("toast-container");
  if (!container) {
    container = document.createElement("div");
    container.id = "toast-container";
    container.style.cssText =
      "position:fixed;bottom:20px;right:20px;z-index:9999;display:flex;flex-direction:column;gap:8px;";
    document.body.appendChild(container);
  }
  const div = document.createElement("div");
  div.className = `toast-msg ${type}`;
  div.style.cssText =
    "padding:10px 18px;border-radius:8px;color:#fff;font-size:.9rem;box-shadow:0 4px 15px rgba(0,0,0,.2);display:flex;align-items:center;gap:8px;min-width:220px;";
  const colors = {
    success: "#198754",
    danger: "#dc3545",
    warning: "#856404",
    info: "#0d6efd",
  };
  div.style.background = colors[type] || "#198754";
  div.innerHTML = `<i class="bi bi-${icon}"></i>${msg}`;
  container.appendChild(div);
  setTimeout(() => div.remove(), 3500);
}

/* ── Initialise on load ───────────────────────────────── */
seedStorage();
