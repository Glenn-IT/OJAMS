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

                        <!-- Registration Form -->
                        <form id="registerForm">
                            <div class="mb-3">
                                <label class="form-label">Full Name <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                                    <input type="text" class="form-control" placeholder="Enter your full name" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email Address <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                    <input type="email" class="form-control" placeholder="Enter your email" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Contact Number <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-phone"></i></span>
                                    <input type="tel" class="form-control" placeholder="e.g. 09171234567" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                    <input type="password" class="form-control" placeholder="Create a password" required>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                    <input type="password" class="form-control" placeholder="Confirm your password" required>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid">
                                <button type="button" class="btn btn-primary btn-lg" onclick="registerUser()">
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
