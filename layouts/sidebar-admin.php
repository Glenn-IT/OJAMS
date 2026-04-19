<!-- ============================================
     Admin Sidebar Navigation
     ============================================ -->
<div class="col-lg-2 col-md-3 bg-dark text-white min-vh-100 sidebar p-0">
    <div class="d-flex flex-column p-3">
        <!-- Sidebar Header -->
        <div class="text-center py-3 mb-3 border-bottom border-secondary">
            <i class="bi bi-person-circle display-5"></i>
            <p class="mt-2 mb-0 fw-semibold">Admin Panel</p>
        </div>

        <!-- Sidebar Links -->
        <ul class="nav nav-pills flex-column">
            <li class="nav-item mb-1">
                <a class="nav-link text-white <?php echo ($currentPage ?? '') === 'dashboard' ? 'active bg-primary' : ''; ?>"
                   href="<?php echo $basePath ?? ''; ?>pages/admin/dashboard.php">
                    <i class="bi bi-speedometer2 me-2"></i>Dashboard
                </a>
            </li>
            <li class="nav-item mb-1">
                <a class="nav-link text-white <?php echo ($currentPage ?? '') === 'manage-jobs' ? 'active bg-primary' : ''; ?>"
                   href="<?php echo $basePath ?? ''; ?>pages/admin/manage-jobs.php">
                    <i class="bi bi-kanban me-2"></i>Manage Jobs
                </a>
            </li>
            <li class="nav-item mb-1">
                <a class="nav-link text-white <?php echo ($currentPage ?? '') === 'applications' ? 'active bg-primary' : ''; ?>"
                   href="<?php echo $basePath ?? ''; ?>pages/admin/applications.php">
                    <i class="bi bi-file-earmark-person me-2"></i>Applications
                </a>
            </li>
            <li class="nav-item mb-1">
                <a class="nav-link text-white <?php echo ($currentPage ?? '') === 'reports' ? 'active bg-primary' : ''; ?>"
                   href="<?php echo $basePath ?? ''; ?>pages/admin/reports.php">
                    <i class="bi bi-graph-up me-2"></i>Reports
                </a>
            </li>
            <li class="nav-item mb-1">
                <a class="nav-link text-white <?php echo ($currentPage ?? '') === 'profile-settings' ? 'active bg-primary' : ''; ?>"
                   href="<?php echo $basePath ?? ''; ?>pages/admin/profile-settings.php">
                    <i class="bi bi-person-gear me-2"></i>Profile Settings
                </a>
            </li>
        </ul>

        <!-- Sidebar Footer -->
        <div class="mt-auto pt-4 border-top border-secondary text-center">
            <small class="text-muted">OJAMS Admin v1.0</small>
        </div>
    </div>
</div>
