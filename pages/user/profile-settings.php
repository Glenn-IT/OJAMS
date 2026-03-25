<?php
/**
 * ==============================================
 * OJAMS - Profile Settings (User Module)
 * ==============================================
 * Displays user profile info with edit capability.
 */
$pageTitle   = "OJAMS - Profile Settings";
$basePath    = "../../";
$currentPage = "profile-settings";

// Load sample data
include $basePath . 'data/sample-data.php';

// Include header and user navbar
include $basePath . 'layouts/header.php';
include $basePath . 'layouts/navbar-user.php';
?>

<!-- ── Page Content ── -->
<div class="container py-4">
    <!-- Page Header -->
    <div class="mb-4">
        <h2 class="fw-bold mb-1">
            <i class="bi bi-person-gear me-2 text-primary"></i>Profile Settings
        </h2>
        <p class="text-muted mb-0">View and manage your personal information.</p>
    </div>

    <div class="row">
        <!-- Profile Card -->
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm text-center">
                <div class="card-body p-4">
                    <!-- Profile Image Placeholder -->
                    <div class="rounded-circle bg-primary d-inline-flex align-items-center justify-content-center mb-3"
                         style="width: 100px; height: 100px;">
                        <i class="bi bi-person-fill text-white display-5"></i>
                    </div>
                    <h5 class="fw-bold mb-1"><?php echo $user_profile['full_name']; ?></h5>
                    <p class="text-muted mb-2"><?php echo $user_profile['email']; ?></p>
                    <span class="badge bg-primary">Job Seeker</span>
                </div>
            </div>
        </div>

        <!-- Profile Details -->
        <div class="col-md-8 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold">
                        <i class="bi bi-info-circle me-2 text-primary"></i>Personal Information
                    </h5>
                    <button class="btn btn-sm btn-outline-primary" id="editProfileBtn" onclick="toggleEditProfile()">
                        <i class="bi bi-pencil me-1"></i>Edit Profile
                    </button>
                </div>
                <div class="card-body">
                    <!-- View Mode -->
                    <div id="profileView">
                        <table class="table table-borderless mb-0">
                            <tr>
                                <th class="text-muted" style="width: 35%;">
                                    <i class="bi bi-person me-2"></i>Full Name
                                </th>
                                <td><?php echo $user_profile['full_name']; ?></td>
                            </tr>
                            <tr>
                                <th class="text-muted">
                                    <i class="bi bi-envelope me-2"></i>Email
                                </th>
                                <td><?php echo $user_profile['email']; ?></td>
                            </tr>
                            <tr>
                                <th class="text-muted">
                                    <i class="bi bi-phone me-2"></i>Contact Number
                                </th>
                                <td><?php echo $user_profile['contact_number']; ?></td>
                            </tr>
                            <tr>
                                <th class="text-muted">
                                    <i class="bi bi-geo-alt me-2"></i>Address
                                </th>
                                <td><?php echo $user_profile['address']; ?></td>
                            </tr>
                            <tr>
                                <th class="text-muted">
                                    <i class="bi bi-calendar me-2"></i>Birthdate
                                </th>
                                <td><?php echo $user_profile['birthdate']; ?></td>
                            </tr>
                            <tr>
                                <th class="text-muted">
                                    <i class="bi bi-lock me-2"></i>Password
                                </th>
                                <td><?php echo $user_profile['password']; ?></td>
                            </tr>
                        </table>
                    </div>

                    <!-- Edit Mode (Hidden by default) -->
                    <div id="profileEdit" style="display: none;">
                        <form id="editProfileForm">
                            <div class="mb-3">
                                <label class="form-label">Full Name</label>
                                <input type="text" class="form-control" value="<?php echo $user_profile['full_name']; ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" value="<?php echo $user_profile['email']; ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Contact Number</label>
                                <input type="tel" class="form-control" value="<?php echo $user_profile['contact_number']; ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Address</label>
                                <input type="text" class="form-control" value="<?php echo $user_profile['address']; ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">New Password</label>
                                <input type="password" class="form-control" placeholder="Leave blank to keep current">
                            </div>
                            <div class="d-flex gap-2">
                                <button type="button" class="btn btn-primary" onclick="saveProfile()">
                                    <i class="bi bi-save me-1"></i>Save Changes
                                </button>
                                <button type="button" class="btn btn-secondary" onclick="toggleEditProfile()">
                                    <i class="bi bi-x-lg me-1"></i>Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include $basePath . 'layouts/footer.php'; ?>
