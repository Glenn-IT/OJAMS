<?php
/**
 * ==============================================
 * OJAMS - My Applications (User Module)
 * ==============================================
 * Displays a table of the user's submitted applications.
 */
$pageTitle   = "OJAMS - My Applications";
$basePath    = "../../";
$currentPage = "my-applications";

// Load sample data
include $basePath . 'data/sample-data.php';

// Include header and user navbar
include $basePath . 'layouts/header.php';
include $basePath . 'layouts/navbar-user.php';
?>

<!-- ── Page Content ── -->
<div class="container py-4">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">
                <i class="bi bi-file-earmark-text me-2 text-primary"></i>My Applications
            </h2>
            <p class="text-muted mb-0">Track the status of your submitted job applications.</p>
        </div>
    </div>

    <!-- Applications Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <!-- Table Header -->
                    <?php
                    $columns = ['#', 'Job Title', 'Company', 'Date Applied', 'Status'];
                    include $basePath . 'components/table-header.php';
                    ?>

                    <!-- Table Body -->
                    <tbody>
                        <?php
                        // Filter applications for current user (prototype: show all)
                        $userApplications = array_filter($applications, fn($a) => $a['name'] === 'Juan Dela Cruz');
                        $count = 1;
                        ?>
                        <?php if (count($userApplications) > 0): ?>
                            <?php foreach ($userApplications as $app): ?>
                                <tr>
                                    <td><?php echo $count++; ?></td>
                                    <td>
                                        <i class="bi bi-briefcase me-1 text-primary"></i>
                                        <?php echo $app['job_title']; ?>
                                    </td>
                                    <td><?php echo $app['company']; ?></td>
                                    <td><?php echo $app['date_applied']; ?></td>
                                    <td>
                                        <?php
                                        $badgeClass = match($app['status']) {
                                            'Approved' => 'bg-success',
                                            'Rejected' => 'bg-danger',
                                            'Pending'  => 'bg-warning text-dark',
                                            default    => 'bg-secondary'
                                        };
                                        ?>
                                        <span class="badge <?php echo $badgeClass; ?>">
                                            <?php echo $app['status']; ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    <i class="bi bi-inbox display-6 d-block mb-2"></i>
                                    No applications submitted yet.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="row mt-4">
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm text-center p-3">
                <h4 class="fw-bold text-primary mb-1"><?php echo count($userApplications); ?></h4>
                <small class="text-muted">Total Applications</small>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm text-center p-3">
                <h4 class="fw-bold text-warning mb-1">
                    <?php echo count(array_filter($userApplications, fn($a) => $a['status'] === 'Pending')); ?>
                </h4>
                <small class="text-muted">Pending</small>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm text-center p-3">
                <h4 class="fw-bold text-success mb-1">
                    <?php echo count(array_filter($userApplications, fn($a) => $a['status'] === 'Approved')); ?>
                </h4>
                <small class="text-muted">Approved</small>
            </div>
        </div>
    </div>
</div>

<?php include $basePath . 'layouts/footer.php'; ?>
