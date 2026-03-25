<?php
/**
 * ==============================================
 * OJAMS - Login Page
 * ==============================================
 * Prototype login page with role-based navigation.
 * No actual authentication is implemented.
 */
$pageTitle = "OJAMS - Login";
$basePath  = "";
include 'layouts/header.php';
?>

<div class="min-vh-100 d-flex align-items-center justify-content-center bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 col-lg-4">

                <!-- Login Card -->
                <div class="card shadow-lg border-0">
                    <div class="card-body p-5">
                        <!-- Logo / Brand -->
                        <div class="text-center mb-4">
                            <i class="bi bi-briefcase-fill text-primary display-3"></i>
                            <h3 class="fw-bold mt-2">OJAMS</h3>
                            <p class="text-muted">Online Job Application Monitoring System</p>
                        </div>

                        <!-- Login Form -->
                        <form id="loginForm">
                            <div class="mb-3">
                                <label class="form-label">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                    <input type="email" class="form-control" placeholder="Enter your email" value="user@email.com">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                    <input type="password" class="form-control" placeholder="Enter your password" value="password123">
                                </div>
                            </div>

                            <!-- Role Selection (Prototype Only) -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold text-primary">Login As (Prototype)</label>
                                <div class="d-grid gap-2">
                                    <a href="pages/user/browse-jobs.php" class="btn btn-primary btn-lg">
                                        <i class="bi bi-person me-2"></i>Login as User
                                    </a>
                                    <a href="pages/admin/dashboard.php" class="btn btn-dark btn-lg">
                                        <i class="bi bi-shield-lock me-2"></i>Login as Admin
                                    </a>
                                </div>
                            </div>
                        </form>

                        <!-- Register Link -->
                        <div class="text-center">
                            <p class="text-muted mb-0">
                                Don't have an account?
                                <a href="register.php" class="text-primary fw-semibold">Register here</a>
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
