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
function showToast(message, isError = false) {
    if (isError) {
        document.getElementById('error-message').innerHTML = `<i class="bi bi-exclamation-circle me-2"></i>${message}`;
        const toast = new bootstrap.Toast(document.getElementById('errorToast'));
        toast.show();
    } else {
        document.getElementById('toast-message').innerHTML = `<i class="bi bi-check-circle me-2"></i>${message}`;
        const toast = new bootstrap.Toast(document.getElementById('successToast'));
        toast.show();
    }
}

function savePersonalInfo() {
    const firstname = document.getElementById('pi-firstname').value.trim();
    const email     = document.getElementById('pi-email').value.trim();
    if (!firstname || !email) {
        showToast('Please fill in all required fields.', true);
        return;
    }
    showToast('Personal information updated successfully!');
}

function togglePw(id) {
    const input = document.getElementById(id);
    const icon  = document.getElementById('icon-' + id);
    if (input.type === 'password') {
        input.type = 'text';
        icon.className = 'bi bi-eye-slash';
    } else {
        input.type = 'password';
        icon.className = 'bi bi-eye';
    }
}

function changePassword() {
    const current = document.getElementById('cp-current').value;
    const newPw   = document.getElementById('cp-new').value;
    const confirm = document.getElementById('cp-confirm').value;

    if (!current || !newPw || !confirm) {
        showToast('Please fill in all password fields.', true);
        return;
    }
    if (newPw.length < 8) {
        showToast('New password must be at least 8 characters.', true);
        return;
    }
    if (newPw !== confirm) {
        showToast('New passwords do not match.', true);
        return;
    }
    // Prototype: simulate success
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
    let strength = 0;
    if (val.length >= 8) strength++;
    if (/[A-Z]/.test(val)) strength++;
    if (/[0-9]/.test(val)) strength++;
    if (/[^A-Za-z0-9]/.test(val)) strength++;
    const levels = [
        { w: '0%',   cls: '',             text: '' },
        { w: '25%',  cls: 'bg-danger',    text: 'Weak' },
        { w: '50%',  cls: 'bg-warning',   text: 'Fair' },
        { w: '75%',  cls: 'bg-info',      text: 'Good' },
        { w: '100%', cls: 'bg-success',   text: 'Strong' },
    ];
    bar.style.width  = levels[strength].w;
    bar.className    = 'progress-bar ' + levels[strength].cls;
    lbl.textContent  = levels[strength].text;
    lbl.className    = 'small text-muted';
});
</script>

<?php include $basePath . 'layouts/footer.php'; ?>
