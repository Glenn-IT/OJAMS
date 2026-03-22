/* ==========================================================
   OJAMS – Application Logic
   Sections:
   1. State
   2. Role Toggle
   3. Login / Logout
   4. Layout Builder (Sidebar + Navigation)
   5. Data Renderers
   6. Application Form
   7. Registration
   8. Profile
   9. Admin – Manage Jobs
   10. Admin – Applications
   11. Utility Functions
   12. Init
========================================================== */

/* ── 1. State ─────────────────────────────────────────── */
let currentRole = "user"; // "user" | "admin"
let currentSection = "";
let jobDeleteIdx = -1;
let currentJobIdx = -1;
let loggedIn = false;

/* ── 2. Role Toggle ───────────────────────────────────── */
function setRole(role) {
  currentRole = role;

  document
    .getElementById("btn-role-user")
    .classList.toggle("active", role === "user");
  document
    .getElementById("btn-role-admin")
    .classList.toggle("active", role === "admin");

  // Update login badge colour
  const badge = document.getElementById("login-role-badge");
  if (badge) {
    badge.innerHTML =
      role === "admin"
        ? '<span class="badge bg-danger px-3 py-1">Admin Login</span>'
        : '<span class="badge bg-primary px-3 py-1">User Login</span>';
  }

  // If already logged in, rebuild the layout for the new role
  if (loggedIn) buildLayout();
}

/* ── 3. Login / Logout ────────────────────────────────── */
function doLogin() {
  loggedIn = true;
  document.getElementById("login-page").style.display = "none";
  document.getElementById("app-layout").style.display = "flex";
  buildLayout();
  showToast("Logged in successfully!", "success");
}

function doLogout() {
  const m = bootstrap.Modal.getInstance(
    document.getElementById("modal-logout"),
  );
  if (m) m.hide();

  loggedIn = false;
  document.getElementById("login-page").style.display = "flex";
  document.getElementById("app-layout").style.display = "none";
  showToast("Logged out successfully.", "warning");
}

function togglePassVis() {
  const inp = document.getElementById("inp-password");
  const icon = document.getElementById("eye-icon");
  if (inp.type === "password") {
    inp.type = "text";
    icon.className = "bi bi-eye-slash";
  } else {
    inp.type = "password";
    icon.className = "bi bi-eye";
  }
}

/* ── 4. Layout Builder ────────────────────────────────── */
function buildLayout() {
  buildSidebar();
  const defaultSection =
    currentRole === "admin" ? "sec-dashboard" : "sec-browse";
  navigateTo(defaultSection);
  populateAll();
}

function buildSidebar() {
  const menu = currentRole === "admin" ? adminMenu : userMenu;
  const sidebar = document.getElementById("sidebar");

  let html = `<div class="px-3 py-2" style="color:#6c8096;font-size:.7rem;letter-spacing:1px;text-transform:uppercase;">
    ${currentRole === "admin" ? "🛠 Admin Panel" : "👤 User Panel"}
  </div>`;

  menu.forEach((item) => {
    const isDanger = item.section === "logout";
    html += `
      <a class="nav-item ${isDanger ? "text-danger-emphasis" : ""}"
         id="nav-${item.section}"
         onclick="handleNav('${item.section}')"
         style="${isDanger ? "color:#dc3545;" : ""}">
        <i class="bi ${item.icon}"></i>${item.label}
      </a>`;
  });

  sidebar.innerHTML = html;
}

function handleNav(section) {
  if (section === "logout") {
    openModal("modal-logout");
    return;
  }
  navigateTo(section);
}

function navigateTo(section) {
  currentSection = section;

  // Hide all sections, show target
  document
    .querySelectorAll(".page-section")
    .forEach((s) => s.classList.remove("active"));
  const target = document.getElementById(section);
  if (target) target.classList.add("active");

  // Update active nav highlight
  document
    .querySelectorAll("#sidebar .nav-item")
    .forEach((n) => n.classList.remove("active"));
  const activeNav = document.getElementById("nav-" + section);
  if (activeNav) activeNav.classList.add("active");
}

/* ── 5. Data Renderers ────────────────────────────────── */
function populateAll() {
  renderJobCards(jobs);
  renderMyApps();
  renderAdminJobs();
  renderAdminApps();
  renderActivityLog();
  renderReports();
}

/** Render browseable job cards (User view) */
function renderJobCards(list) {
  const container = document.getElementById("job-list");
  if (!container) return;

  container.innerHTML = list
    .map(
      (j, i) => `
    <div class="col-md-6 col-lg-4">
      <div class="card job-card border shadow-sm h-100">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-start mb-1">
            <span class="fw-bold">${j.title}</span>
            <span class="badge ${j.status === "Open" ? "bg-success" : "bg-secondary"} badge-date">${j.status}</span>
          </div>
          <div class="text-muted small mb-1"><i class="bi bi-building me-1"></i>${j.company}</div>
          <div class="small mb-1">${j.desc}</div>
          <div class="small text-muted mb-1"><i class="bi bi-check2-square me-1"></i>${j.qual}</div>
          <div class="text-muted badge-date small"><i class="bi bi-calendar3 me-1"></i>Posted: ${j.date}</div>
        </div>
        <div class="card-footer bg-white border-0">
          <button class="btn btn-primary btn-sm w-100 ${j.status === "Closed" ? "disabled" : ""}"
                  onclick="openApplyModal(${i})">
            <i class="bi bi-send me-1"></i>${j.status === "Closed" ? "Position Closed" : "Apply Now"}
          </button>
        </div>
      </div>
    </div>
  `,
    )
    .join("");
}

/** Live search filter for job cards */
function filterJobs(q) {
  const filtered = jobs.filter(
    (j) =>
      j.title.toLowerCase().includes(q.toLowerCase()) ||
      j.company.toLowerCase().includes(q.toLowerCase()),
  );
  renderJobCards(filtered);
}

/** Render the user's own applications table */
function renderMyApps() {
  const tbody = document.getElementById("my-apps-tbody");
  if (!tbody) return;

  tbody.innerHTML = myApplications
    .map(
      (a, i) => `
    <tr>
      <td>${i + 1}</td>
      <td>${a.title}</td>
      <td>${a.company}</td>
      <td>${a.date}</td>
      <td><span class="badge ${statusBadge(a.status)}">${a.status}</span></td>
    </tr>
  `,
    )
    .join("");
}

/** Render admin job management table */
function renderAdminJobs() {
  const tbody = document.getElementById("admin-jobs-tbody");
  if (!tbody) return;

  tbody.innerHTML = jobs
    .map(
      (j, i) => `
    <tr>
      <td>${i + 1}</td>
      <td>${j.title}</td>
      <td>${j.company}</td>
      <td>${j.date}</td>
      <td><span class="badge ${j.status === "Open" ? "bg-success" : "bg-secondary"}">${j.status}</span></td>
      <td>
        <button class="btn btn-outline-primary btn-sm py-0 px-1"
                onclick="editJob(${i})" title="Edit">
          <i class="bi bi-pencil"></i>
        </button>
        <button class="btn btn-outline-danger btn-sm py-0 px-1 ms-1"
                onclick="deleteJob(${i})" title="Delete">
          <i class="bi bi-trash"></i>
        </button>
      </td>
    </tr>
  `,
    )
    .join("");
}

/** Render admin applications table */
function renderAdminApps() {
  const tbody = document.getElementById("admin-apps-tbody");
  if (!tbody) return;

  tbody.innerHTML = adminApplications
    .map(
      (a, i) => `
    <tr>
      <td>${i + 1}</td>
      <td>${a.name}</td>
      <td>${a.title}<br><small class="text-muted">${a.company}</small></td>
      <td>${a.date}</td>
      <td><span class="badge ${statusBadge(a.status)}">${a.status}</span></td>
      <td>
        <button class="btn btn-success btn-sm py-0 px-1 me-1"
                onclick="updateAppStatus(${i}, 'Approved')" title="Approve">
          <i class="bi bi-check-lg"></i>
        </button>
        <button class="btn btn-danger btn-sm py-0 px-1 me-1"
                onclick="updateAppStatus(${i}, 'Rejected')" title="Reject">
          <i class="bi bi-x-lg"></i>
        </button>
        <button class="btn btn-secondary btn-sm py-0 px-1"
                onclick="viewAppDetails(${i})" title="View">
          <i class="bi bi-eye"></i>
        </button>
      </td>
    </tr>
  `,
    )
    .join("");
}

/** Render recent activity table on the dashboard */
function renderActivityLog() {
  const tbody = document.getElementById("activity-tbody");
  if (!tbody) return;

  tbody.innerHTML = activityLog
    .map(
      (a) => `
    <tr>
      <td>${a.date}</td>
      <td>${a.time}</td>
      <td>${a.activity}</td>
      <td><span class="badge ${statusBadge(a.status)}">${a.status}</span></td>
    </tr>
  `,
    )
    .join("");
}

/** Render reports section tables */
function renderReports() {
  // Applicants per Job
  const perJob = document.getElementById("report-per-job");
  if (perJob) {
    const counts = {};
    adminApplications.forEach((a) => {
      const key = `${a.title}|${a.company}`;
      counts[key] = (counts[key] || 0) + 1;
    });
    perJob.innerHTML = Object.entries(counts)
      .map(([k, v]) => {
        const [title, company] = k.split("|");
        return `<tr>
        <td>${title}</td>
        <td>${company}</td>
        <td><span class="badge bg-primary">${v}</span></td>
      </tr>`;
      })
      .join("");
  }

  // Monthly report
  const monthly = document.getElementById("report-monthly");
  if (monthly) {
    monthly.innerHTML = monthlyReport
      .map(
        (m) => `
      <tr>
        <td>${m.month}</td>
        <td>${m.apps}</td>
        <td><span class="badge badge-approved">${m.approved}</span></td>
        <td><span class="badge badge-rejected">${m.rejected}</span></td>
      </tr>
    `,
      )
      .join("");
  }
}

/* ── 6. Application Form ──────────────────────────────── */
function openApplyModal(idx) {
  currentJobIdx = idx;
  const job = jobs[idx];
  document.getElementById("apply-job-title").textContent = job.title;
  document.getElementById("apply-company").textContent = job.company;
  openModal("modal-apply");
}

function submitApplication() {
  const modal = bootstrap.Modal.getInstance(
    document.getElementById("modal-apply"),
  );
  if (modal) modal.hide();

  if (currentJobIdx >= 0) {
    const job = jobs[currentJobIdx];
    const today = new Date().toISOString().split("T")[0];

    // Add to both lists (prototype simulation)
    myApplications.push({
      title: job.title,
      company: job.company,
      date: today,
      status: "Pending",
    });
    adminApplications.push({
      name: "Juan Dela Cruz",
      title: job.title,
      company: job.company,
      date: today,
      status: "Pending",
    });

    renderMyApps();
    renderAdminApps();

    // Update Total Applicants counter on dashboard
    const statVals = document.querySelectorAll("#stat-cards .stat-val");
    if (statVals[1]) statVals[1].textContent = adminApplications.length;
  }

  showToast("Application Submitted (Prototype Only)", "success");
}

/* ── 7. Registration ──────────────────────────────────── */
function doRegister() {
  const modal = bootstrap.Modal.getInstance(
    document.getElementById("modal-register"),
  );
  if (modal) modal.hide();
  showToast("Account registered (Prototype Only)!", "success");
}

/* ── 8. Profile ───────────────────────────────────────── */
function toggleProfileEdit(show) {
  document.getElementById("profile-view").style.display = show
    ? "none"
    : "block";
  document.getElementById("profile-edit").style.display = show
    ? "block"
    : "none";
}

function saveProfile() {
  const name = document.getElementById("pe-name").value;
  const email = document.getElementById("pe-email").value;
  const contact = document.getElementById("pe-contact").value;

  // Update view fields
  document.getElementById("pv-name").textContent = name;
  document.getElementById("pv-email").textContent = email;
  document.getElementById("pv-contact").textContent = contact;

  // Update sidebar header info
  document.getElementById("profile-name").textContent = name;
  document.getElementById("profile-email").textContent = email;

  toggleProfileEdit(false);
  showToast("Profile updated (Prototype Only)", "success");
}

/* ── 9. Admin – Manage Jobs ───────────────────────────── */
function editJob(idx) {
  const j = jobs[idx];
  document.getElementById("job-modal-title").innerHTML =
    '<i class="bi bi-pencil me-2"></i>Edit Job';
  document.getElementById("edit-job-idx").value = idx;
  document.getElementById("jf-title").value = j.title;
  document.getElementById("jf-company").value = j.company;
  document.getElementById("jf-desc").value = j.desc;
  document.getElementById("jf-qual").value = j.qual;
  document.getElementById("jf-status").value = j.status;
  document.getElementById("jf-date").value = j.date;
  openModal("modal-add-job");
}

function saveJob() {
  const idx = parseInt(document.getElementById("edit-job-idx").value);
  const newJob = {
    title: document.getElementById("jf-title").value || "Untitled Job",
    company: document.getElementById("jf-company").value || "N/A",
    desc: document.getElementById("jf-desc").value,
    qual: document.getElementById("jf-qual").value,
    status: document.getElementById("jf-status").value,
    date:
      document.getElementById("jf-date").value ||
      new Date().toISOString().split("T")[0],
  };

  if (idx === -1) {
    jobs.push(newJob);
  } else {
    jobs[idx] = newJob;
  }

  // Close modal and reset form
  const modal = bootstrap.Modal.getInstance(
    document.getElementById("modal-add-job"),
  );
  if (modal) modal.hide();

  document.getElementById("edit-job-idx").value = -1;
  document.getElementById("job-modal-title").innerHTML =
    '<i class="bi bi-briefcase me-2"></i>Add New Job';
  ["jf-title", "jf-company", "jf-desc", "jf-qual"].forEach(
    (id) => (document.getElementById(id).value = ""),
  );

  // Refresh both tables
  renderAdminJobs();
  renderJobCards(jobs);
  showToast(
    idx === -1 ? "Job added successfully!" : "Job updated successfully!",
    "success",
  );
}

function deleteJob(idx) {
  jobDeleteIdx = idx;
  openModal("modal-del-job");
}

function confirmDeleteJob() {
  if (jobDeleteIdx >= 0) {
    jobs.splice(jobDeleteIdx, 1);
    jobDeleteIdx = -1;
    renderAdminJobs();
    renderJobCards(jobs);
  }
  const modal = bootstrap.Modal.getInstance(
    document.getElementById("modal-del-job"),
  );
  if (modal) modal.hide();
  showToast("Job deleted (Prototype Only)", "danger");
}

/* ── 10. Admin – Applications ─────────────────────────── */
function updateAppStatus(idx, newStatus) {
  adminApplications[idx].status = newStatus;

  // Mirror status change to My Applications if same job title
  const app = adminApplications[idx];
  const myApp = myApplications.find((a) => a.title === app.title);
  if (myApp) myApp.status = newStatus;

  renderAdminApps();
  renderMyApps();
  showToast(
    `Application ${newStatus} (Prototype Only)`,
    newStatus === "Approved" ? "success" : "danger",
  );
}

function viewAppDetails(idx) {
  const a = adminApplications[idx];
  document.getElementById("view-app-body").innerHTML = `
    <div class="row g-3">
      <div class="col-md-6">
        <div class="info-row">
          <span class="info-label">Applicant Name</span>
          <span class="info-val fw-bold">${a.name}</span>
        </div>
        <div class="info-row">
          <span class="info-label">Job Applied</span>
          <span class="info-val">${a.title}</span>
        </div>
        <div class="info-row">
          <span class="info-label">Company</span>
          <span class="info-val">${a.company}</span>
        </div>
        <div class="info-row">
          <span class="info-label">Date Applied</span>
          <span class="info-val">${a.date}</span>
        </div>
        <div class="info-row">
          <span class="info-label">Status</span>
          <span class="badge ${statusBadge(a.status)}">${a.status}</span>
        </div>
      </div>
      <div class="col-md-6">
        <div class="p-3 bg-light rounded text-muted small">
          <i class="bi bi-info-circle me-1"></i>
          Full applicant details (personal info, education, skills, uploaded ID)
          will appear here when connected to a backend.
        </div>
        <div class="mt-2">
          <div class="fw-semibold small mb-1">Skills <span class="text-muted">(Sample)</span></div>
          <div class="small">HTML, CSS, JavaScript, PHP, MySQL</div>
        </div>
        <div class="mt-2">
          <div class="fw-semibold small mb-1">Experience <span class="text-muted">(Sample)</span></div>
          <div class="small">1 year as Junior Developer at XYZ Company</div>
        </div>
      </div>
    </div>
  `;
  openModal("modal-view-app");
}

/* ── 11. Utility Functions ────────────────────────────── */

/** Open a Bootstrap modal by element ID */
function openModal(id) {
  const el = document.getElementById(id);
  if (!el) return;
  bootstrap.Modal.getOrCreateInstance(el).show();
}

/** Return the CSS class string for a status badge */
function statusBadge(status) {
  if (status === "Approved") return "badge-approved";
  if (status === "Rejected") return "badge-rejected";
  if (status === "Pending") return "badge-pending";
  return "bg-secondary";
}

/** Display a transient toast notification */
function showToast(msg, type = "success") {
  const iconMap = {
    success: "check-circle",
    danger: "x-circle",
    warning: "exclamation-circle",
  };
  const icon = iconMap[type] || "info-circle";

  const container = document.getElementById("toast-container");
  const div = document.createElement("div");
  div.className = `toast-msg ${type}`;
  div.innerHTML = `<i class="bi bi-${icon} me-2"></i>${msg}`;
  container.appendChild(div);

  setTimeout(() => div.remove(), 3500);
}

/* ── 12. Init ─────────────────────────────────────────── */
document.addEventListener("DOMContentLoaded", () => {
  // Default date for new job form
  const jfDate = document.getElementById("jf-date");
  if (jfDate) jfDate.value = new Date().toISOString().split("T")[0];

  // Reset Add Job form fields when the modal opens for a new entry
  document
    .getElementById("modal-add-job")
    .addEventListener("show.bs.modal", () => {
      const idx = parseInt(document.getElementById("edit-job-idx").value);
      if (idx === -1) {
        ["jf-title", "jf-company", "jf-desc", "jf-qual"].forEach(
          (id) => (document.getElementById(id).value = ""),
        );
        document.getElementById("jf-status").value = "Open";
        document.getElementById("jf-date").value = new Date()
          .toISOString()
          .split("T")[0];
      }
    });
});
