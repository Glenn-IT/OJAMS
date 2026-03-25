<?php
/**
 * ==============================================
 * OJAMS - Manage Jobs (Admin Module)
 * ==============================================
 * Admin view to manage all job postings.
 * Supports Add, Edit, Delete via modals.
 */
$pageTitle   = "OJAMS - Manage Jobs";
$basePath    = "../../";
$currentPage = "manage-jobs";

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
                        <i class="bi bi-kanban me-2 text-primary"></i>Manage Jobs
                    </h2>
                    <p class="text-muted mb-0">Create, edit, and manage job postings.</p>
                </div>
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addJobModal">
                    <i class="bi bi-plus-circle me-1"></i>Add New Job
                </button>
            </div>

            <!-- Jobs Table -->
            <div class="card border-0 shadow-sm">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <?php
                            $columns = ['#', 'Job Title', 'Company', 'Date Posted', 'Status', 'Actions'];
                            include $basePath . 'components/table-header.php';
                            ?>
                            <tbody>
                                <?php $count = 1; ?>
                                <?php foreach ($jobs as $job): ?>
                                    <tr>
                                        <td><?php echo $count++; ?></td>
                                        <td>
                                            <i class="bi bi-briefcase me-1 text-primary"></i>
                                            <?php echo $job['title']; ?>
                                        </td>
                                        <td><?php echo $job['company']; ?></td>
                                        <td><?php echo $job['date_posted']; ?></td>
                                        <td>
                                            <span class="badge <?php echo $job['status'] === 'Open' ? 'bg-success' : 'bg-secondary'; ?>">
                                                <?php echo $job['status']; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <!-- Edit Button -->
                                            <button class="btn btn-sm btn-outline-warning me-1"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editJobModal"
                                                    onclick="editJob('<?php echo $job['title']; ?>', '<?php echo $job['company']; ?>', '<?php echo addslashes($job['description']); ?>', '<?php echo $job['qualification']; ?>', '<?php echo $job['date_posted']; ?>', '<?php echo $job['status']; ?>')">
                                                <i class="bi bi-pencil"></i> Edit
                                            </button>
                                            <!-- Delete Button -->
                                            <button class="btn btn-sm btn-outline-danger"
                                                    onclick="deleteJob('<?php echo $job['title']; ?>')">
                                                <i class="bi bi-trash"></i> Delete
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modals -->
<?php include $basePath . 'modals/add-job-modal.php'; ?>
<?php include $basePath . 'modals/edit-job-modal.php'; ?>

<?php include $basePath . 'layouts/footer.php'; ?>
