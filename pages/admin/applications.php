<?php
/**
 * ==============================================
 * OJAMS - Applications (Admin Module)
 * ==============================================
 * Displays all applicants with Approve/Reject/View actions.
 */
$pageTitle   = "OJAMS - Applications";
$basePath    = "../../";
$currentPage = "applications";

// Load sample data
include $basePath . 'data/sample-data.php';

// Include header and admin navbar
include $basePath . 'layouts/header.php';
include $basePath . 'layouts/navbar-admin.php';
?>

<!-- ── Admin Layout: Sidebar + Content ── -->
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <?php include $basePath . 'layouts/sidebar-admin.php'; ?>

        <!-- Main Content -->
        <div class="col-lg-10 col-md-9 py-4 px-4">
            <!-- Page Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold mb-1">
                        <i class="bi bi-file-earmark-person me-2 text-primary"></i>Applications
                    </h2>
                    <p class="text-muted mb-0">Review and manage all job applications.</p>
                </div>
                <!-- Filter Buttons -->
                <div class="btn-group" role="group">
                    <button class="btn btn-outline-primary btn-sm active" onclick="comingSoon()">All</button>
                    <button class="btn btn-outline-warning btn-sm" onclick="comingSoon()">Pending</button>
                    <button class="btn btn-outline-success btn-sm" onclick="comingSoon()">Approved</button>
                    <button class="btn btn-outline-danger btn-sm" onclick="comingSoon()">Rejected</button>
                </div>
            </div>

            <!-- Applications Table -->
            <div class="card border-0 shadow-sm">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <?php
                            $columns = ['Applicant Name', 'Job Title', 'Date Applied', 'Status', 'Actions'];
                            include $basePath . 'components/table-header.php';
                            ?>
                            <tbody>
                                <?php foreach ($applications as $app): ?>
                                    <?php include $basePath . 'components/application-row.php'; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- View Application Modal -->
<?php include $basePath . 'modals/view-application-modal.php'; ?>

<?php include $basePath . 'layouts/footer.php'; ?>
