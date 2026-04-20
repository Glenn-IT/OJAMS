<?php
/**
 * ==============================================
 * OJAMS - Registration Page
 * ==============================================
 * Prototype registration page.
 * No actual user creation is implemented.
 */
$pageTitle = "OJAMS - Register";
$basePath  = "";
include 'layouts/header.php';
?>

<div class="min-vh-100 d-flex align-items-center justify-content-center bg-light py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">

                <!-- Registration Card -->
                <div class="card shadow-lg border-0">
                    <div class="card-body p-5">
                        <!-- Logo / Brand -->
                        <div class="text-center mb-4">
                            <i class="bi bi-briefcase-fill text-primary display-3"></i>
                            <h3 class="fw-bold mt-2">Create Account</h3>
                            <p class="text-muted">Join OJAMS to find your dream job</p>
                        </div>

                        <!-- Alert Box -->
                        <div id="registerAlert" class="alert d-none mb-3" role="alert"></div>

                        <!-- Registration Form -->
                        <form id="registerForm" onsubmit="registerUser(event)">
                            <div class="mb-3">
                                <label class="form-label">Full Name <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                                    <input type="text" class="form-control" id="regName" placeholder="Enter your full name" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email Address <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                    <input type="email" class="form-control" id="regEmail" placeholder="Enter your email" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Contact Number <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-phone"></i></span>
                                    <input type="tel" class="form-control" id="regContact" placeholder="e.g. 09171234567" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                    <input type="password" class="form-control" id="regPassword" placeholder="Create a password" required minlength="6">
                                    <button type="button" class="btn btn-outline-secondary" onclick="toggleRegPass()">
                                        <i class="bi bi-eye" id="regEyeIcon"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                    <input type="password" class="form-control" id="regConfirm" placeholder="Confirm your password" required>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="bi bi-person-plus me-2"></i>Register
                                </button>
                            </div>
                        </form>

                        <!-- Login Link -->
                        <div class="text-center mt-4">
                            <p class="text-muted mb-0">
                                Already have an account?
                                <a href="login.php" class="text-primary fw-semibold">Login here</a>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Footer Note -->
                <div class="text-center mt-3">
                    <small class="text-muted">&copy; 2026 OJAMS. Prototype Version</small>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'layouts/footer.php'; ?>

<script>
function registerUser(e) {
    e.preventDefault();
    const alertBox = document.getElementById('registerAlert');
    const name     = document.getElementById('regName').value.trim();
    const email    = document.getElementById('regEmail').value.trim();
    const contact  = document.getElementById('regContact').value.trim();
    const password = document.getElementById('regPassword').value;
    const confirm  = document.getElementById('regConfirm').value;

    if (password !== confirm) {
        alertBox.className = 'alert alert-danger';
        alertBox.textContent = 'Passwords do not match.';
        alertBox.classList.remove('d-none');
        return;
    }
    if (password.length < 6) {
        alertBox.className = 'alert alert-danger';
        alertBox.textContent = 'Password must be at least 6 characters.';
        alertBox.classList.remove('d-none');
        return;
    }

    const result = Users.create({ full_name: name, email, password, contact_number: contact });
    if (!result.success) {
        alertBox.className = 'alert alert-danger';
        alertBox.textContent = result.message;
        alertBox.classList.remove('d-none');
        return;
    }

    alertBox.className = 'alert alert-success';
    alertBox.textContent = 'Account created! Redirecting to login...';
    alertBox.classList.remove('d-none');
    setTimeout(() => { window.location.href = 'login.php'; }, 1200);
}

function toggleRegPass() {
    const inp  = document.getElementById('regPassword');
    const icon = document.getElementById('regEyeIcon');
    if (inp.type === 'password') { inp.type = 'text'; icon.className = 'bi bi-eye-slash'; }
    else                         { inp.type = 'password'; icon.className = 'bi bi-eye'; }
}
</script>
