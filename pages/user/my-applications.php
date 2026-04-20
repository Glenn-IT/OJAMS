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
                    <tbody id="myAppsTbody">
                        <?php
                        // Filter applications for current user (prototype: show Juan's apps)
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
                <h4 class="fw-bold text-primary mb-1" data-stat="total"><?php echo count($userApplications); ?></h4>
                <small class="text-muted">Total Applications</small>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm text-center p-3">
                <h4 class="fw-bold text-warning mb-1" data-stat="pending">
                    <?php echo count(array_filter($userApplications, fn($a) => $a['status'] === 'Pending')); ?>
                </h4>
                <small class="text-muted">Pending</small>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm text-center p-3">
                <h4 class="fw-bold text-success mb-1" data-stat="approved">
                    <?php echo count(array_filter($userApplications, fn($a) => $a['status'] === 'Approved')); ?>
                </h4>
                <small class="text-muted">Approved</small>
            </div>
        </div>
    </div>
</div>

<!-- Cancel Application Confirmation Modal -->
<div class="modal fade" id="cancelApplicationModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title"><i class="bi bi-exclamation-triangle me-2"></i>Cancel Application</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center py-4">
                <i class="bi bi-x-circle-fill text-danger display-4 mb-3 d-block"></i>
                <p class="mb-1">Are you sure you want to cancel your application for:</p>
                <h5 class="fw-bold" id="cancelAppJobTitle">—</h5>
                <p class="text-muted small">This action cannot be undone.</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-arrow-left me-1"></i>Go Back
                </button>
                <button type="button" class="btn btn-danger" onclick="cancelApplication()" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-1"></i>Yes, Cancel Application
                </button>
            </div>
        </div>
    </div>
</div>

<!-- View My Application Modal -->
<div class="modal fade" id="viewMyApplicationModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title"><i class="bi bi-eye me-2"></i>My Application Details</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <h6 class="fw-bold text-primary border-bottom pb-2">Job Information</h6>
                        <table class="table table-borderless table-sm">
                            <tr><th class="text-muted" style="width:45%;">Job Title</th>    <td id="vmyAppJobTitle">—</td></tr>
                            <tr><th class="text-muted">Company</th>                          <td id="vmyAppCompany">—</td></tr>
                            <tr><th class="text-muted">Date Applied</th>                     <td id="vmyAppDate">—</td></tr>
                            <tr><th class="text-muted">Status</th>                           <td id="vmyAppStatus">—</td></tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h6 class="fw-bold text-primary border-bottom pb-2">Your Info</h6>
                        <table class="table table-borderless table-sm">
                            <tr><th class="text-muted" style="width:45%;">Name</th>         <td id="vmyAppName">—</td></tr>
                            <tr><th class="text-muted">Email</th>                            <td id="vmyAppEmail">—</td></tr>
                            <tr><th class="text-muted">Contact</th>                          <td id="vmyAppContact">—</td></tr>
                            <tr><th class="text-muted">Address</th>                          <td id="vmyAppAddress">—</td></tr>
                        </table>
                    </div>
                    <div class="col-12">
                        <h6 class="fw-bold text-primary border-bottom pb-2">Education</h6>
                        <div class="row">
                            <div class="col-md-3"><small class="text-muted">Elementary</small><div id="vmyAppElem">—</div></div>
                            <div class="col-md-3"><small class="text-muted">JHS</small><div id="vmyAppJhs">—</div></div>
                            <div class="col-md-3"><small class="text-muted">SHS</small><div id="vmyAppShs">—</div></div>
                            <div class="col-md-3"><small class="text-muted">College</small><div id="vmyAppCollege">—</div></div>
                        </div>
                    </div>
                    <div class="col-12">
                        <h6 class="fw-bold text-primary border-bottom pb-2">Skills &amp; Experience</h6>
                        <div class="mb-1"><strong>Skills:</strong> <span id="vmyAppSkills">—</span></div>
                        <div><strong>Experience:</strong> <span id="vmyAppExperience">—</span></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-lg me-1"></i>Close
                </button>
            </div>
        </div>
    </div>
</div>

<?php include $basePath . 'layouts/footer.php'; ?>

<script>
requireUser('../../login.php', '../../pages/admin/dashboard.php');

/* ── Render My Applications from localStorage ── */
function renderMyApplicationsTable() {
    const session = Session.get();
    if (!session) return;
    const apps  = Applications.byUser(session.id);
    const tbody = document.getElementById('myAppsTbody');
    if (!tbody) return;

    // Update summary counts
    const totalEl    = document.querySelector('[data-stat="total"]');
    const pendingEl  = document.querySelector('[data-stat="pending"]');
    const approvedEl = document.querySelector('[data-stat="approved"]');
    if (totalEl)    totalEl.textContent = apps.length;
    if (pendingEl)  pendingEl.textContent = apps.filter(a => a.status === 'Pending').length;
    if (approvedEl) approvedEl.textContent = apps.filter(a => a.status === 'Approved').length;

    if (apps.length === 0) {
        tbody.innerHTML = `<tr><td colspan="6" class="text-center text-muted py-4">
            <i class="bi bi-inbox display-6 d-block mb-2"></i>No applications submitted yet.</td></tr>`;
        return;
    }

    tbody.innerHTML = apps.map((app, i) => {
        const badge = app.status === 'Approved' ? 'bg-success' : app.status === 'Rejected' ? 'bg-danger' : 'bg-warning text-dark';
        const cancelBtn = app.status === 'Pending'
            ? `<button class="btn btn-sm btn-outline-danger"
                   onclick="confirmCancel('${escS(app.job_title)}', ${app.id})"
                   data-bs-toggle="modal" data-bs-target="#cancelApplicationModal">
                   <i class="bi bi-x-circle"></i> Cancel</button>`
            : '';
        return `<tr>
            <td>${i + 1}</td>
            <td><i class="bi bi-briefcase me-1 text-primary"></i>${app.job_title}</td>
            <td>${app.company}</td>
            <td>${app.date_applied}</td>
            <td><span class="badge ${badge}">${app.status}</span></td>
            <td>
                <button class="btn btn-sm btn-outline-primary me-1"
                    onclick="viewMyApplication(${app.id})"
                    data-bs-toggle="modal" data-bs-target="#viewMyApplicationModal">
                    <i class="bi bi-eye"></i> View
                </button>
                ${cancelBtn}
            </td>
        </tr>`;
    }).join('');
}

function escS(str) { return (str || '').replace(/'/g, "\\'"); }

function viewMyApplication(appId) {
    const app = Applications.findById(appId);
    if (!app) return;
    const setT = (id, v) => { const el = document.getElementById(id); if (el) el.textContent = v || '—'; };
    setT('vmyAppJobTitle',  app.job_title);
    setT('vmyAppCompany',   app.company);
    setT('vmyAppDate',      app.date_applied);
    setT('vmyAppName',      app.user_name);
    setT('vmyAppEmail',     app.email);
    setT('vmyAppContact',   app.contact);
    setT('vmyAppAddress',   app.address);
    setT('vmyAppElem',      app.education?.elementary);
    setT('vmyAppJhs',       app.education?.jhs);
    setT('vmyAppShs',       app.education?.shs);
    setT('vmyAppCollege',   app.education?.college);
    setT('vmyAppSkills',    app.skills);
    setT('vmyAppExperience',app.experience);
    const statusEl = document.getElementById('vmyAppStatus');
    if (statusEl) {
        const badge = app.status === 'Approved' ? 'bg-success' : app.status === 'Rejected' ? 'bg-danger' : 'bg-warning text-dark';
        statusEl.innerHTML = `<span class="badge ${badge}">${app.status}</span>`;
    }
}

// viewApplication kept for legacy PHP calls
function viewApplication(title, company, date, status) {
    const setT = (id, v) => { const el = document.getElementById(id); if (el) el.textContent = v || '—'; };
    setT('vmyAppJobTitle', title);
    setT('vmyAppCompany',  company);
    setT('vmyAppDate',     date);
    const statusEl = document.getElementById('vmyAppStatus');
    if (statusEl) {
        const badge = status === 'Approved' ? 'bg-success' : status === 'Rejected' ? 'bg-danger' : 'bg-warning text-dark';
        statusEl.innerHTML = `<span class="badge ${badge}">${status}</span>`;
    }
}

document.addEventListener('DOMContentLoaded', renderMyApplicationsTable);
</script>
