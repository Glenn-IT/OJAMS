/**
 * ==============================================
 * OJAMS - Main JavaScript File
 * LocalStorage-powered CRUD for User & Admin
 * ==============================================
 * Depends on: storage.js (loaded before this file)
 * ==============================================
 */

/* ══════════════════════════════════════════════
   GENERAL UTILITIES
══════════════════════════════════════════════ */
function comingSoon() {
  alert("Feature Coming Soon");
}

function statusBadgeClass(status) {
  switch (status) {
    case "Approved":
      return "bg-success";
    case "Rejected":
      return "bg-danger";
    case "Pending":
      return "bg-warning text-dark";
    case "Open":
      return "bg-success";
    case "Closed":
      return "bg-secondary";
    case "New":
      return "bg-info text-dark";
    case "Created":
      return "bg-primary";
    case "Updated":
      return "bg-warning text-dark";
    case "Deleted":
      return "bg-danger";
    case "Cancelled":
      return "bg-secondary";
    default:
      return "bg-secondary";
  }
}

/* ══════════════════════════════════════════════
   APPLY JOB MODAL (User)
   Sets up the modal with job info before showing
══════════════════════════════════════════════ */
let _currentApplyJobId = null;

function setApplyJob(jobId, title, company) {
  _currentApplyJobId = jobId;
  const titleEl = document.getElementById("applyJobTitle");
  const companyEl = document.getElementById("applyJobCompany");
  if (titleEl) titleEl.textContent = title;
  if (companyEl) companyEl.textContent = company;
}

/* ── Submit Application (User) ─────────────── */
function submitApplication() {
  const session = Session.get();
  if (!session) {
    window.location.href = "/OJAMS/login.php";
    return;
  }

  const job = Jobs.findById(_currentApplyJobId);
  if (!job) {
    showToast("Job not found.", "danger");
    return;
  }

  // Collect form fields
  const fullName =
    document.getElementById("appFullName")?.value.trim() || session.full_name;
  const birthdate =
    document.getElementById("appBirthdate")?.value || session.birthdate || "";
  const age = document.getElementById("appAge")?.value || session.age || "";
  const address =
    document.getElementById("appAddress")?.value.trim() ||
    session.address ||
    "";
  const contact =
    document.getElementById("appContact")?.value.trim() ||
    session.contact_number ||
    "";
  const elementary =
    document.getElementById("appElementary")?.value.trim() || "";
  const jhs = document.getElementById("appJhs")?.value.trim() || "";
  const shs = document.getElementById("appShs")?.value.trim() || "";
  const college = document.getElementById("appCollege")?.value.trim() || "";
  const skills = document.getElementById("appSkills")?.value.trim() || "";
  const experience =
    document.getElementById("appExperience")?.value.trim() || "";

  const result = Applications.create({
    user_id: session.id,
    user_name: fullName || session.full_name,
    email: session.email,
    job_id: job.id,
    job_title: job.title,
    company: job.company,
    skills,
    experience,
    address,
    contact,
    birthdate,
    age,
    education: { elementary, jhs, shs, college },
  });

  const modal = bootstrap.Modal.getInstance(
    document.getElementById("applyJobModal"),
  );
  if (modal) modal.hide();

  if (!result.success) {
    showToast(result.message, "warning");
    return;
  }

  document.getElementById("applicationForm")?.reset();
  showToast("Application submitted successfully!", "success");

  // Refresh page table if on my-applications page
  if (typeof renderMyApplicationsTable === "function")
    renderMyApplicationsTable();
}

/* ══════════════════════════════════════════════
   REGISTER (redirect to register.php)
══════════════════════════════════════════════ */
function registerUser(e) {
  if (e) e.preventDefault();
  window.location.href = "register.php";
}

/* ══════════════════════════════════════════════
   PROFILE SETTINGS
══════════════════════════════════════════════ */
function toggleEditProfile() {
  const viewEl = document.getElementById("profileView");
  const editEl = document.getElementById("profileEdit");
  const btn = document.getElementById("editProfileBtn");

  if (!viewEl || !editEl) return;

  const isEditing =
    editEl.style.display !== "none" && editEl.style.display !== "";
  if (isEditing) {
    editEl.style.display = "none";
    viewEl.style.display = "block";
    if (btn) {
      btn.innerHTML = '<i class="bi bi-pencil me-1"></i>Edit Profile';
      btn.classList.replace("btn-secondary", "btn-outline-primary");
    }
  } else {
    // Pre-fill edit fields from session
    const user = Session.get();
    if (user) {
      _setVal("editFullName", user.full_name);
      _setVal("editEmail", user.email);
      _setVal("editContact", user.contact_number);
      _setVal("editAddress", user.address);
      _setVal("editBirthdate", user.birthdate);
    }
    viewEl.style.display = "none";
    editEl.style.display = "block";
    if (btn) {
      btn.innerHTML = '<i class="bi bi-x me-1"></i>Cancel';
      btn.classList.replace("btn-outline-primary", "btn-secondary");
    }
  }
}

function _setVal(id, val) {
  const el = document.getElementById(id);
  if (el) el.value = val || "";
}

function saveProfile() {
  const session = Session.get();
  if (!session) return;

  const data = {
    full_name:
      document.getElementById("editFullName")?.value.trim() ||
      session.full_name,
    email: document.getElementById("editEmail")?.value.trim() || session.email,
    contact_number: document.getElementById("editContact")?.value.trim() || "",
    address: document.getElementById("editAddress")?.value.trim() || "",
    birthdate: document.getElementById("editBirthdate")?.value || "",
  };

  // Password change (optional)
  const newPass = document.getElementById("editNewPassword")?.value;
  const curPass = document.getElementById("editCurrentPassword")?.value;
  if (newPass) {
    if (curPass !== session.password) {
      showToast("Current password is incorrect.", "danger");
      return;
    }
    if (newPass.length < 6) {
      showToast("New password must be at least 6 characters.", "warning");
      return;
    }
    data.password = newPass;
  }

  const result = Users.update(session.id, data);
  if (!result.success) {
    showToast(result.message, "danger");
    return;
  }

  showToast("Profile updated successfully!", "success");
  toggleEditProfile();
  if (typeof renderProfileView === "function") renderProfileView();
  else location.reload();
}

/* ══════════════════════════════════════════════
   ADMIN – MANAGE JOBS CRUD
══════════════════════════════════════════════ */
let _editingJobId = null;

/** Opens Add Job modal (fresh) */
function openAddJobModal() {
  _editingJobId = null;
  document.getElementById("addJobModalLabel").innerHTML =
    '<i class="bi bi-plus-circle me-2"></i>Add New Job Post';
  document.getElementById("addJobForm")?.reset();
  const dateField = document.getElementById("jobDatePosted");
  if (dateField) dateField.value = new Date().toISOString().split("T")[0];
  const modal = new bootstrap.Modal(document.getElementById("addJobModal"));
  modal.show();
}

/** Opens Edit Job modal pre-filled */
function editJob(
  title,
  company,
  description,
  qualification,
  datePosted,
  status,
  jobId,
) {
  _editingJobId = jobId || null;

  // If called from PHP table with jobId, find and fill; else fill from passed params
  if (_editingJobId) {
    const job = Jobs.findById(Number(_editingJobId));
    if (job) {
      title = job.title;
      company = job.company;
      description = job.description;
      qualification = job.qualification;
      datePosted = job.date_posted;
      status = job.status;
    }
  }

  document.getElementById("addJobModalLabel").innerHTML =
    '<i class="bi bi-pencil-square me-2"></i>Edit Job Post';

  _setVal("jobTitle", title);
  _setVal("jobCompany", company);
  _setVal("jobDescription", description);
  _setVal("jobQualification", qualification);
  _setVal("jobDatePosted", datePosted);
  const statusEl = document.getElementById("jobStatus");
  if (statusEl) statusEl.value = status;

  const modal = new bootstrap.Modal(document.getElementById("addJobModal"));
  modal.show();
}

/** Saves Add or Edit job */
function saveJob() {
  const title = document.getElementById("jobTitle")?.value.trim();
  const company = document.getElementById("jobCompany")?.value.trim();
  const description = document.getElementById("jobDescription")?.value.trim();
  const qualification = document
    .getElementById("jobQualification")
    ?.value.trim();
  const date_posted = document.getElementById("jobDatePosted")?.value;
  const status = document.getElementById("jobStatus")?.value;

  if (!title || !company || !description || !qualification) {
    showToast("Please fill in all required fields.", "warning");
    return;
  }

  let result;
  if (_editingJobId) {
    result = Jobs.update(Number(_editingJobId), {
      title,
      company,
      description,
      qualification,
      date_posted,
      status,
    });
  } else {
    result = Jobs.create({
      title,
      company,
      description,
      qualification,
      date_posted,
      status,
    });
  }

  if (!result.success) {
    showToast(result.message, "danger");
    return;
  }

  const modal = bootstrap.Modal.getInstance(
    document.getElementById("addJobModal"),
  );
  if (modal) modal.hide();

  showToast(
    _editingJobId ? "Job updated successfully!" : "Job added successfully!",
    "success",
  );
  _editingJobId = null;

  if (typeof renderJobsTable === "function") renderJobsTable();
  else location.reload();
}

/** Also handle old-style Add Job modal (separate modal) */
function addJob() {
  saveJob();
}

/** Old-style save edit (edit-job-modal) */
function saveJobEdit() {
  const title = document.getElementById("editJobTitle")?.value.trim();
  const company = document.getElementById("editJobCompany")?.value.trim();
  const description = document
    .getElementById("editJobDescription")
    ?.value.trim();
  const qualification = document
    .getElementById("editJobQualification")
    ?.value.trim();
  const date_posted = document.getElementById("editJobDate")?.value;
  const status = document.getElementById("editJobStatus")?.value;

  if (!title || !company) {
    showToast("Job title and company are required.", "warning");
    return;
  }

  if (_editingJobId) {
    Jobs.update(Number(_editingJobId), {
      title,
      company,
      description,
      qualification,
      date_posted,
      status,
    });
    showToast("Job updated successfully!", "success");
  }

  const modal = bootstrap.Modal.getInstance(
    document.getElementById("editJobModal"),
  );
  if (modal) modal.hide();
  _editingJobId = null;
  if (typeof renderJobsTable === "function") renderJobsTable();
  else location.reload();
}

/** Delete job – confirm then remove */
function deleteJob(titleOrId) {
  // Support both old (title string) and new (numeric id) callers
  if (typeof titleOrId === "number" || !isNaN(Number(titleOrId))) {
    const jobId = Number(titleOrId);
    if (!confirm("Are you sure you want to delete this job post?")) return;
    const result = Jobs.delete(jobId);
    showToast(
      result.success ? "Job deleted successfully!" : result.message,
      result.success ? "danger" : "warning",
    );
    if (typeof renderJobsTable === "function") renderJobsTable();
    else location.reload();
  } else {
    // Legacy: title-based delete
    if (!confirm(`Are you sure you want to delete "${titleOrId}"?`)) return;
    const job = Jobs.all().find((j) => j.title === titleOrId);
    if (job) {
      Jobs.delete(job.id);
      showToast("Job deleted!", "danger");
      location.reload();
    }
  }
}

/* ══════════════════════════════════════════════
   ADMIN – APPLICATIONS CRUD
══════════════════════════════════════════════ */

/** Approve application */
function approveApplication(appId, name) {
  // Support both old (name string) and new (id) callers
  if (typeof appId === "number" || !isNaN(Number(appId))) {
    if (!confirm(`Approve this application?`)) return;
    const result = Applications.updateStatus(Number(appId), "Approved");
    showToast(
      result.success ? "Application Approved!" : result.message,
      result.success ? "success" : "danger",
    );
    if (typeof renderApplicationsTable === "function")
      renderApplicationsTable();
    else location.reload();
  } else {
    // Legacy: name-based
    const app = Applications.all().find((a) => a.user_name === appId);
    if (app && confirm(`Approve application from "${appId}"?`)) {
      Applications.updateStatus(app.id, "Approved");
      showToast("Application Approved!", "success");
      location.reload();
    }
  }
}

/** Reject application */
function rejectApplication(appId, name) {
  if (typeof appId === "number" || !isNaN(Number(appId))) {
    if (!confirm(`Reject this application?`)) return;
    const result = Applications.updateStatus(Number(appId), "Rejected");
    showToast(
      result.success ? "Application Rejected." : result.message,
      result.success ? "danger" : "warning",
    );
    if (typeof renderApplicationsTable === "function")
      renderApplicationsTable();
    else location.reload();
  } else {
    const app = Applications.all().find((a) => a.user_name === appId);
    if (app && confirm(`Reject application from "${appId}"?`)) {
      Applications.updateStatus(app.id, "Rejected");
      showToast("Application Rejected.", "danger");
      location.reload();
    }
  }
}

/** View Application Details modal */
let _viewAppId = null;
function viewApplicationDetails(appId, name, jobTitle, dateApplied, status) {
  _viewAppId = appId;

  // Try to load full details from storage
  const app = !isNaN(Number(appId))
    ? Applications.findById(Number(appId))
    : null;

  if (app) {
    _setText("viewAppName", app.user_name);
    _setText("viewAppEmail", app.email);
    _setText("viewAppJobTitle", app.job_title);
    _setText("viewAppCompany", app.company);
    _setText("viewAppDate", app.date_applied);
    _setText("viewAppAddress", app.address);
    _setText("viewAppContact", app.contact);
    _setText("viewAppBirthdate", app.birthdate);
    _setText("viewAppAge", app.age);
    _setText("viewAppSkills", app.skills);
    _setText("viewAppExperience", app.experience);
    _setText("viewAppElemSchool", app.education?.elementary || "—");
    _setText("viewAppJhsSchool", app.education?.jhs || "—");
    _setText("viewAppShsSchool", app.education?.shs || "—");
    _setText("viewAppCollege", app.education?.college || "—");

    const statusEl = document.getElementById("viewAppStatus");
    if (statusEl) {
      statusEl.textContent = app.status;
      statusEl.className = `badge ${statusBadgeClass(app.status)}`;
    }
  } else {
    // Fallback to passed params
    _setText("viewAppName", name);
    _setText("viewAppJobTitle", jobTitle);
    _setText("viewAppDate", dateApplied);
    const statusEl = document.getElementById("viewAppStatus");
    if (statusEl) {
      statusEl.textContent = status;
      statusEl.className = `badge ${statusBadgeClass(status)}`;
    }
  }
}

function _setText(id, val) {
  const el = document.getElementById(id);
  if (el) el.textContent = val || "—";
}

/* ══════════════════════════════════════════════
   USER – CANCEL APPLICATION
══════════════════════════════════════════════ */
let _cancelAppId = null;
let _cancelJobTitle = null;

function confirmCancel(jobTitle, appId) {
  _cancelAppId = Number(appId);
  _cancelJobTitle = jobTitle;
  _setText("cancelAppJobTitle", jobTitle);
}

function cancelApplication() {
  if (!_cancelAppId) return;
  const session = Session.get();
  const result = Applications.delete(_cancelAppId, session?.id);

  const modal = bootstrap.Modal.getInstance(
    document.getElementById("cancelApplicationModal"),
  );
  if (modal) modal.hide();

  showToast(
    result.success ? "Application cancelled." : result.message,
    result.success ? "warning" : "danger",
  );
  _cancelAppId = null;

  if (typeof renderMyApplicationsTable === "function")
    renderMyApplicationsTable();
  else location.reload();
}

/* ══════════════════════════════════════════════
   BROWSE JOBS – Search Filter (PHP page)
══════════════════════════════════════════════ */
function filterJobs() {
  const q = (document.getElementById("jobSearch")?.value || "").toLowerCase();
  document
    .querySelectorAll(
      "#jobCardsContainer .col-md-6, #jobCardsContainer .col-md-4",
    )
    .forEach((card) => {
      card.style.display = card.textContent.toLowerCase().includes(q)
        ? ""
        : "none";
    });
}

/* ══════════════════════════════════════════════
   REPORT DOWNLOAD (Admin)
══════════════════════════════════════════════ */
function downloadReport() {
  const apps = Applications.all();
  const jobs = Jobs.all();
  const rows = [
    ["Applicant", "Email", "Job Title", "Company", "Date Applied", "Status"],
  ];
  apps.forEach((a) =>
    rows.push([
      a.user_name,
      a.email,
      a.job_title,
      a.company,
      a.date_applied,
      a.status,
    ]),
  );
  const csv = rows.map((r) => r.map((v) => `"${v}"`).join(",")).join("\n");
  const blob = new Blob([csv], { type: "text/csv" });
  const url = URL.createObjectURL(blob);
  const a = document.createElement("a");
  a.href = url;
  a.download = "ojams_report.csv";
  a.click();
  URL.revokeObjectURL(url);
  showToast("Report downloaded!", "success");
}

/* ══════════════════════════════════════════════
   DOCUMENT READY
══════════════════════════════════════════════ */
document.addEventListener("DOMContentLoaded", function () {
  console.log("OJAMS – LocalStorage CRUD Loaded");
});
