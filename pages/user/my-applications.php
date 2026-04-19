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
                    $columns = ['#', 'Job Title', 'Company', 'Date Applied', 'Status', 'Actions'];
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
                                    <td>
                                        <!-- View Button -->
                                        <button class="btn btn-sm btn-outline-primary me-1"
                                            onclick="viewApplication(
                                                '<?php echo htmlspecialchars($app['job_title']); ?>',
                                                '<?php echo htmlspecialchars($app['company']); ?>',
                                                '<?php echo $app['date_applied']; ?>',
                                                '<?php echo $app['status']; ?>'
                                            )"
                                            data-bs-toggle="modal" data-bs-target="#viewMyApplicationModal"
                                            title="View Application">
                                            <i class="bi bi-eye"></i> View
                                        </button>
                                        <!-- Cancel Button (only for Pending) -->
                                        <?php if ($app['status'] === 'Pending'): ?>
                                        <button class="btn btn-sm btn-outline-danger"
                                            onclick="confirmCancel('<?php echo htmlspecialchars($app['job_title']); ?>', '<?php echo $app['id']; ?>')"
                                            data-bs-toggle="modal" data-bs-target="#cancelApplicationModal"
                                            title="Cancel Application">
                                            <i class="bi bi-x-circle"></i> Cancel
                                        </button>
                                        <?php endif; ?>
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

<!-- View My Application Modal -->
<div class="modal fade" id="viewMyApplicationModal" tabindex="-1" aria-labelledby="viewMyApplicationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="viewMyApplicationModalLabel">
                    <i class="bi bi-eye me-2"></i>Application Details
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <table class="table table-borderless">
                    <tr><th class="text-muted" style="width:40%">Applicant</th><td>Juan Dela Cruz</td></tr>
                    <tr><th class="text-muted">Job Title</th><td id="vma-title">—</td></tr>
                    <tr><th class="text-muted">Company</th><td id="vma-company">—</td></tr>
                    <tr><th class="text-muted">Date Applied</th><td id="vma-date">—</td></tr>
                    <tr><th class="text-muted">Status</th><td id="vma-status">—</td></tr>
                    <tr><th class="text-muted">Email</th><td>juan@email.com</td></tr>
                    <tr><th class="text-muted">Contact</th><td>09171234567</td></tr>
                    <tr><th class="text-muted">Skills</th><td>HTML, CSS, JavaScript, PHP</td></tr>
                    <tr><th class="text-muted">Experience</th><td>Intern at Sample Corp (2024–2025)</td></tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-lg me-1"></i>Close
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Cancel Application Confirmation Modal -->
<div class="modal fade" id="cancelApplicationModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="bi bi-exclamation-triangle me-2"></i>Cancel Application
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center py-4">
                <i class="bi bi-x-circle-fill text-danger display-4 mb-3 d-block"></i>
                <p class="mb-1">Are you sure you want to cancel your application for:</p>
                <h5 class="fw-bold" id="cancel-job-title">—</h5>
                <p class="text-muted small">This action cannot be undone.</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-arrow-left me-1"></i>Go Back
                </button>
                <button type="button" class="btn btn-danger" onclick="processCancelApplication()" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-1"></i>Yes, Cancel Application
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function viewApplication(title, company, date, status) {
    document.getElementById('vma-title').textContent   = title;
    document.getElementById('vma-company').textContent = company;
    document.getElementById('vma-date').textContent    = date;
    const statusEl = document.getElementById('vma-status');
    const badgeMap = { Approved: 'bg-success', Rejected: 'bg-danger', Pending: 'bg-warning text-dark' };
    statusEl.innerHTML = `<span class="badge ${badgeMap[status] || 'bg-secondary'}">${status}</span>`;
}

function confirmCancel(title, id) {
    document.getElementById('cancel-job-title').textContent = title;
    document.getElementById('cancelApplicationModal').dataset.appId = id;
}

function processCancelApplication() {
    // Prototype: show toast notification
    const toast = document.createElement('div');
    toast.className = 'position-fixed bottom-0 end-0 p-3';
    toast.style.zIndex = 9999;
    toast.innerHTML = `
        <div class="toast show align-items-center text-white bg-success border-0" role="alert">
            <div class="d-flex">
                <div class="toast-body"><i class="bi bi-check-circle me-2"></i>Application cancelled successfully.</div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" onclick="this.closest('.position-fixed').remove()"></button>
            </div>
        </div>`;
    document.body.appendChild(toast);
    setTimeout(() => toast.remove(), 3500);
}
</script>

<?php include $basePath . 'layouts/footer.php'; ?>
