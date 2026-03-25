/**
 * ==============================================
 * OJAMS - Main JavaScript File
 * Online Job Application Monitoring System
 * ==============================================
 * Handles:
 * - Modal interactions
 * - Placeholder alerts
 * - Form prototype behaviors
 * - Navigation helpers
 * ==============================================
 */

// ── Coming Soon Placeholder ────────────────────
function comingSoon() {
    alert("Feature Coming Soon (Prototype)");
}

// ── Apply Job Modal: Set Job Info ──────────────
function setApplyJob(title, company) {
    document.getElementById('applyJobTitle').textContent = title;
    document.getElementById('applyJobCompany').textContent = company;
}

// ── Submit Application (Prototype) ─────────────
function submitApplication() {
    alert("Application Submitted (Prototype Only)");
    // Close the modal
    var modal = bootstrap.Modal.getInstance(document.getElementById('applyJobModal'));
    if (modal) modal.hide();
    // Reset form
    document.getElementById('applicationForm').reset();
}

// ── Register User (Prototype) ──────────────────
function registerUser() {
    alert("Registration Successful (Prototype Only)");
    window.location.href = "login.php";
}

// ── Profile: Toggle Edit Mode ──────────────────
function toggleEditProfile() {
    var viewEl = document.getElementById('profileView');
    var editEl = document.getElementById('profileEdit');
    var btn    = document.getElementById('editProfileBtn');

    if (viewEl && editEl) {
        if (editEl.style.display === 'none') {
            editEl.style.display = 'block';
            viewEl.style.display = 'none';
            if (btn) btn.style.display = 'none';
        } else {
            editEl.style.display = 'none';
            viewEl.style.display = 'block';
            if (btn) btn.style.display = 'inline-block';
        }
    }
}

// ── Save Profile (Prototype) ───────────────────
function saveProfile() {
    alert("Profile Updated (Prototype Only)");
    toggleEditProfile();
}

// ── Admin: Add Job (Prototype) ─────────────────
function addJob() {
    alert("Job Added Successfully (Prototype Only)");
    var modal = bootstrap.Modal.getInstance(document.getElementById('addJobModal'));
    if (modal) modal.hide();
    document.getElementById('addJobForm').reset();
}

// ── Admin: Edit Job - Populate Modal ───────────
function editJob(title, company, description, qualification, datePosted, status) {
    document.getElementById('editJobTitle').value = title;
    document.getElementById('editJobCompany').value = company;
    document.getElementById('editJobDescription').value = description;
    document.getElementById('editJobQualification').value = qualification;
    document.getElementById('editJobDate').value = datePosted;
    document.getElementById('editJobStatus').value = status;
}

// ── Admin: Save Job Edit (Prototype) ───────────
function saveJobEdit() {
    alert("Job Updated Successfully (Prototype Only)");
    var modal = bootstrap.Modal.getInstance(document.getElementById('editJobModal'));
    if (modal) modal.hide();
}

// ── Admin: Delete Job (Prototype) ──────────────
function deleteJob(title) {
    if (confirm('Are you sure you want to delete "' + title + '"?')) {
        alert('Job "' + title + '" Deleted (Prototype Only)');
    }
}

// ── Admin: Approve Application (Prototype) ─────
function approveApplication(name) {
    if (confirm('Approve application from "' + name + '"?')) {
        alert('Application from "' + name + '" Approved (Prototype Only)');
    }
}

// ── Admin: Reject Application (Prototype) ──────
function rejectApplication(name) {
    if (confirm('Reject application from "' + name + '"?')) {
        alert('Application from "' + name + '" Rejected (Prototype Only)');
    }
}

// ── Admin: View Application Details ────────────
function viewApplicationDetails(name, jobTitle, dateApplied, status) {
    document.getElementById('viewAppName').textContent = name;
    document.getElementById('viewAppJobTitle').textContent = jobTitle;
    document.getElementById('viewAppDate').textContent = dateApplied;

    var statusEl = document.getElementById('viewAppStatus');
    statusEl.textContent = status;
    statusEl.className = '';

    // Apply badge styling
    var badgeClass = 'badge ';
    switch (status) {
        case 'Approved': badgeClass += 'bg-success'; break;
        case 'Rejected': badgeClass += 'bg-danger';  break;
        case 'Pending':  badgeClass += 'bg-warning text-dark'; break;
        default:         badgeClass += 'bg-secondary';
    }
    statusEl.className = badgeClass;
}

// ── Admin: Download Report (Prototype) ─────────
function downloadReport() {
    alert("Download started (Prototype Only)");
}

// ── Browse Jobs: Simple Search Filter ──────────
function filterJobs() {
    var searchTerm = document.getElementById('jobSearch').value.toLowerCase();
    var cards = document.querySelectorAll('#jobCardsContainer .col-md-6');

    cards.forEach(function(card) {
        var text = card.textContent.toLowerCase();
        if (text.includes(searchTerm)) {
            card.style.display = '';
        } else {
            card.style.display = 'none';
        }
    });
}

// ── Document Ready ─────────────────────────────
document.addEventListener('DOMContentLoaded', function() {
    console.log('OJAMS Prototype Loaded Successfully');
});
