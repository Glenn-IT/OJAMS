<?php
/**
 * ==============================================
 * OJAMS - Browse Jobs (User Module)
 * ==============================================
 * Displays all available job listings as cards.
 * Users can apply to open positions via modal.
 */
$pageTitle   = "OJAMS - Browse Jobs";
$basePath    = "../../";
$currentPage = "browse-jobs";

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
                <i class="bi bi-search me-2 text-primary"></i>Browse Jobs
            </h2>
            <p class="text-muted mb-0">Find and apply to job openings that match your skills.</p>
        </div>
        <span class="badge bg-primary fs-6"><?php echo count($jobs); ?> Jobs Available</span>
    </div>

    <!-- Search Bar (Prototype) -->
    <div class="row mb-4">
        <div class="col-md-8">
            <div class="input-group">
                <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                <input type="text" class="form-control" placeholder="Search jobs by title, company, or keyword..." id="jobSearch" onkeyup="filterJobs()">
            </div>
        </div>
        <div class="col-md-4">
            <select class="form-select" id="jobFilter" onchange="comingSoon()">
                <option value="">All Categories</option>
                <option value="it">Information Technology</option>
                <option value="design">Design</option>
                <option value="support">Technical Support</option>
            </select>
        </div>
    </div>

    <!-- Job Cards Grid -->
    <div class="row" id="jobCardsContainer">
        <?php foreach ($jobs as $job): ?>
            <?php include $basePath . 'components/job-card.php'; ?>
        <?php endforeach; ?>
    </div>
</div>

<!-- Apply Job Modal -->
<?php include $basePath . 'modals/apply-job-modal.php'; ?>

<?php include $basePath . 'layouts/footer.php'; ?>

<script>
requireUser('../../login.php', '../../pages/admin/dashboard.php');

// Reload job cards from localStorage on page load
document.addEventListener('DOMContentLoaded', () => {
    const container = document.getElementById('jobCardsContainer');
    if (!container) return;
    const jobs = Jobs.all();
    const session = Session.get();

    container.innerHTML = jobs.map(job => {
        const applied = session ? Applications.findByUserJob(session.id, job.id) : null;
        const isOpen  = job.status === 'Open';
        const badge   = isOpen ? 'bg-success' : 'bg-secondary';
        const appCount = Applications.all().filter(a => a.job_id === job.id).length;
        const btnHtml = isOpen && !applied
            ? `<button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#applyJobModal"
                   onclick="setApplyJob(${job.id}, '${escStr(job.title)}', '${escStr(job.company)}')">
                   <i class="bi bi-send me-1"></i>Apply Now</button>`
            : applied
                ? `<button class="btn btn-success w-100" disabled><i class="bi bi-check-circle me-1"></i>Already Applied</button>`
                : `<button class="btn btn-secondary w-100" disabled><i class="bi bi-lock me-1"></i>Closed</button>`;
        return `
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100 shadow-sm border-0 job-card">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title fw-bold text-primary"><i class="bi bi-briefcase me-2"></i>${job.title}</h5>
                    <h6 class="card-subtitle mb-2 text-muted"><i class="bi bi-building me-1"></i>${job.company}</h6>
                    <p class="card-text flex-grow-1">${job.description}</p>
                    <p class="card-text"><small class="text-muted"><i class="bi bi-mortarboard me-1"></i><strong>Qualifications:</strong> ${job.qualification}</small></p>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <small class="text-muted"><i class="bi bi-calendar-event me-1"></i>Posted: ${job.date_posted}</small>
                        <span class="badge ${badge}">${job.status}</span>
                    </div>
                    <div class="mb-3"><span class="badge bg-light text-dark border"><i class="bi bi-people-fill text-primary me-1"></i>${appCount} Applicant${appCount !== 1 ? 's' : ''}</span></div>
                    ${btnHtml}
                </div>
            </div>
        </div>`;
    }).join('');

    // Update job count badge
    const countBadge = document.querySelector('.badge.bg-primary.fs-6');
    if (countBadge) countBadge.textContent = jobs.length + ' Jobs Available';
});

function escStr(str) { return (str || '').replace(/'/g, "\\'"); }

// Pre-fill apply form with session user data
document.getElementById('applyJobModal')?.addEventListener('show.bs.modal', () => {
    const user = Session.get();
    if (!user) return;
    const setV = (id, v) => { const el = document.getElementById(id); if (el && !el.value) el.value = v || ''; };
    setV('appFullName', user.full_name);
    setV('appContact',  user.contact_number);
    setV('appAddress',  user.address);
    setV('appBirthdate', user.birthdate);
    setV('appAge',      user.age);
});
</script>
