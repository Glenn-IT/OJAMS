<?php
/**
 * ==============================================
 * OJAMS - Admin Profile Settings
 * ==============================================
 * Allows the admin to update their credentials.
 */
$pageTitle   = "OJAMS - Admin Profile Settings";
$basePath    = "../../";
$currentPage = "profile-settings";

include $basePath . 'data/sample-data.php';
include $basePath . 'layouts/header.php';
include $basePath . 'layouts/navbar-admin.php';
?>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <?php include $basePath . 'layouts/sidebar-admin.php'; ?>

        <!-- Main Content -->
        <div class="col-lg-10 col-md-9 p-4">
            <!-- Page Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold mb-1">
                        <i class="bi bi-person-gear me-2 text-primary"></i>Admin Profile Settings
                    </h2>
                    <p class="text-muted mb-0">Update your account credentials and personal information.</p>
                </div>
            </div>

            <div class="row">
                <!-- Profile Overview Card -->
                <div class="col-lg-4 mb-4">
                    <div class="card border-0 shadow-sm text-center p-4">
                        <div class="mb-3">
                            <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center"
                                 style="width:90px;height:90px;">
                                <i class="bi bi-shield-lock-fill text-white" style="font-size:2.5rem;"></i>
                            </div>
                        </div>
                        <h5 class="fw-bold mb-0">Administrator</h5>
                        <p class="text-muted small mb-1">admin@ojams.com</p>
                        <span class="badge bg-dark">System Admin</span>
                        <hr>
                        <small class="text-muted">
                            <i class="bi bi-clock me-1"></i>Last updated: April 18, 2026
                        </small>
                    </div>
                </div>

                <!-- Forms Column -->
                <div class="col-lg-8">
                    <!-- Update Personal Info -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white border-0 pt-4 pb-0">
                            <h5 class="fw-bold mb-0">
                                <i class="bi bi-person-lines-fill me-2 text-primary"></i>Personal Information
                            </h5>
                        </div>
                        <div class="card-body">
                            <form id="personalInfoForm">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">First Name</label>
                                        <input type="text" class="form-control" value="Admin" id="pi-firstname">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Last Name</label>
                                        <input type="text" class="form-control" value="User" id="pi-lastname">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Email Address</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                        <input type="email" class="form-control" value="admin@ojams.com" id="pi-email">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Contact Number</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-phone"></i></span>
                                        <input type="text" class="form-control" value="09171234567" id="pi-contact">
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="button" class="btn btn-primary" onclick="savePersonalInfo()">
                                        <i class="bi bi-check-lg me-1"></i>Save Changes
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Change Password -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white border-0 pt-4 pb-0">
                            <h5 class="fw-bold mb-0">
                                <i class="bi bi-shield-lock me-2 text-danger"></i>Change Password
                            </h5>
                        </div>
                        <div class="card-body">
                            <form id="changePasswordForm">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Current Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                        <input type="password" class="form-control" id="cp-current" placeholder="Enter current password">
                                        <button class="btn btn-outline-secondary" type="button" onclick="togglePw('cp-current')">
                                            <i class="bi bi-eye" id="icon-cp-current"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">New Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                        <input type="password" class="form-control" id="cp-new" placeholder="Enter new password">
                                        <button class="btn btn-outline-secondary" type="button" onclick="togglePw('cp-new')">
                                            <i class="bi bi-eye" id="icon-cp-new"></i>
                                        </button>
                                    </div>
                                    <div class="form-text">Minimum 8 characters.</div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Confirm New Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                        <input type="password" class="form-control" id="cp-confirm" placeholder="Confirm new password">
                                        <button class="btn btn-outline-secondary" type="button" onclick="togglePw('cp-confirm')">
                                            <i class="bi bi-eye" id="icon-cp-confirm"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Password Strength -->
                                <div class="mb-3">
                                    <label class="form-label fw-semibold small text-muted">Password Strength</label>
                                    <div class="progress" style="height:8px;">
                                        <div class="progress-bar" id="pw-strength-bar" role="progressbar" style="width:0%"></div>
                                    </div>
                                    <small id="pw-strength-label" class="text-muted"></small>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <button type="button" class="btn btn-danger" onclick="changePassword()">
                                        <i class="bi bi-shield-check me-1"></i>Update Password
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Success Toast -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index:9999;">
    <div id="successToast" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body" id="toast-message">
                <i class="bi bi-check-circle me-2"></i>Changes saved successfully!
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
</div>

<!-- Error Toast -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index:9998;">
    <div id="errorToast" class="toast align-items-center text-white bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body" id="error-message">
                <i class="bi bi-exclamation-circle me-2"></i>An error occurred.
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
</div>

<?php include $basePath . 'modals/logout-modal.php'; ?>

<script>
requireAdmin('../../login.php', '../../pages/user/browse-jobs.php');

/* ── Load admin profile from localStorage ── */
document.addEventListener('DOMContentLoaded', () => {
    const user = Session.get();
    if (!user) return;

    // Populate card
    const cardName  = document.querySelector('.card.text-center h5');
    const cardEmail = document.querySelector('.card.text-center p.text-muted.small');
    if (cardName)  cardName.textContent  = user.full_name;
    if (cardEmail) cardEmail.textContent = user.email;

    // Populate form fields
    const parts = user.full_name.split(' ');
    const setV  = (id, v) => { const el = document.getElementById(id); if (el) el.value = v || ''; };
    setV('pi-firstname', parts[0] || '');
    setV('pi-lastname',  parts.slice(1).join(' ') || '');
    setV('pi-email',     user.email);
    setV('pi-contact',   user.contact_number);
});

function showToast(message, isError = false) {
    if (isError) {
        document.getElementById('error-message').innerHTML = `<i class="bi bi-exclamation-circle me-2"></i>${message}`;
        new bootstrap.Toast(document.getElementById('errorToast')).show();
    } else {
        document.getElementById('toast-message').innerHTML = `<i class="bi bi-check-circle me-2"></i>${message}`;
        new bootstrap.Toast(document.getElementById('successToast')).show();
    }
}

function savePersonalInfo() {
    const firstname = document.getElementById('pi-firstname').value.trim();
    const lastname  = document.getElementById('pi-lastname').value.trim();
    const email     = document.getElementById('pi-email').value.trim();
    const contact   = document.getElementById('pi-contact').value.trim();
    if (!firstname || !email) { showToast('Please fill in all required fields.', true); return; }
    const session = Session.get();
    const result  = Users.update(session.id, { full_name: `${firstname} ${lastname}`.trim(), email, contact_number: contact });
    if (!result.success) { showToast(result.message, true); return; }
    showToast('Personal information updated successfully!');
    // Update card
    const cardName  = document.querySelector('.card.text-center h5');
    const cardEmail = document.querySelector('.card.text-center p.text-muted.small');
    if (cardName)  cardName.textContent  = result.user.full_name;
    if (cardEmail) cardEmail.textContent = result.user.email;
}

function togglePw(id) {
    const input = document.getElementById(id);
    const icon  = document.getElementById('icon-' + id);
    input.type = input.type === 'password' ? 'text' : 'password';
    icon.className = input.type === 'password' ? 'bi bi-eye' : 'bi bi-eye-slash';
}

function changePassword() {
    const current = document.getElementById('cp-current').value;
    const newPw   = document.getElementById('cp-new').value;
    const confirm = document.getElementById('cp-confirm').value;
    const session = Session.get();
    if (!current || !newPw || !confirm) { showToast('Please fill in all password fields.', true); return; }
    if (current !== session.password) { showToast('Current password is incorrect.', true); return; }
    if (newPw.length < 6) { showToast('New password must be at least 6 characters.', true); return; }
    if (newPw !== confirm) { showToast('New passwords do not match.', true); return; }
    Users.update(session.id, { password: newPw });
    document.getElementById('cp-current').value = '';
    document.getElementById('cp-new').value     = '';
    document.getElementById('cp-confirm').value = '';
    document.getElementById('pw-strength-bar').style.width = '0%';
    document.getElementById('pw-strength-label').textContent = '';
    showToast('Password updated successfully!');
}

// Password strength meter
document.getElementById('cp-new').addEventListener('input', function () {
    const val = this.value;
    const bar = document.getElementById('pw-strength-bar');
    const lbl = document.getElementById('pw-strength-label');
    let s = 0;
    if (val.length >= 6) s++;
    if (/[A-Z]/.test(val)) s++;
    if (/[0-9]/.test(val)) s++;
    if (/[^A-Za-z0-9]/.test(val)) s++;
    const lvl = [
        { w:'0%',   cls:'',           text:'' },
        { w:'25%',  cls:'bg-danger',  text:'Weak' },
        { w:'50%',  cls:'bg-warning', text:'Fair' },
        { w:'75%',  cls:'bg-info',    text:'Good' },
        { w:'100%', cls:'bg-success', text:'Strong' },
    ][s];
    bar.style.width = lvl.w; bar.className = 'progress-bar ' + lvl.cls;
    lbl.textContent = lvl.text;
});
</script>

<?php include $basePath . 'layouts/footer.php'; ?>
