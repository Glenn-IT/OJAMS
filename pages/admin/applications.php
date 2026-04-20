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
                            <tbody id="applicationsTableBody">
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

<script>
requireAdmin('../../login.php', '../../pages/user/browse-jobs.php');

let _filterStatus = 'All';

function filterByStatus(status) {
    _filterStatus = status;
    // Update button styles
    document.querySelectorAll('.btn-group .btn').forEach(b => b.classList.remove('active'));
    event.target.classList.add('active');
    renderApplicationsTable();
}

function renderApplicationsTable() {
    const tbody = document.getElementById('applicationsTableBody');
    if (!tbody) return;
    let apps = Applications.all();
    if (_filterStatus !== 'All') apps = apps.filter(a => a.status === _filterStatus);

    if (apps.length === 0) {
        tbody.innerHTML = `<tr><td colspan="5" class="text-center text-muted py-4">No ${_filterStatus !== 'All' ? _filterStatus.toLowerCase() : ''} applications found.</td></tr>`;
        return;
    }

    tbody.innerHTML = apps.map(a => {
        const badge = a.status === 'Approved' ? 'bg-success' : a.status === 'Rejected' ? 'bg-danger' : 'bg-warning text-dark';
        const approveDisabled = a.status === 'Approved' ? 'disabled' : '';
        const rejectDisabled  = a.status === 'Rejected'  ? 'disabled' : '';
        return `<tr>
            <td>${a.user_name}</td>
            <td>${a.job_title}</td>
            <td>${a.date_applied}</td>
            <td><span class="badge ${badge}">${a.status}</span></td>
            <td>
                <button class="btn btn-sm btn-outline-success me-1" ${approveDisabled}
                    onclick="approveApplication(${a.id}, '${a.user_name}')">
                    <i class="bi bi-check-circle"></i> Approve
                </button>
                <button class="btn btn-sm btn-outline-danger me-1" ${rejectDisabled}
                    onclick="rejectApplication(${a.id}, '${a.user_name}')">
                    <i class="bi bi-x-circle"></i> Reject
                </button>
                <button class="btn btn-sm btn-outline-primary"
                    data-bs-toggle="modal" data-bs-target="#viewApplicationModal"
                    onclick="viewApplicationDetails(${a.id})">
                    <i class="bi bi-eye"></i> View
                </button>
            </td>
        </tr>`;
    }).join('');
}

// Override filter buttons
document.querySelectorAll('.btn-group .btn').forEach(btn => {
    btn.removeAttribute('onclick');
    btn.addEventListener('click', function() {
        _filterStatus = this.textContent.trim();
        document.querySelectorAll('.btn-group .btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        renderApplicationsTable();
    });
});

document.addEventListener('DOMContentLoaded', renderApplicationsTable);
</script>
