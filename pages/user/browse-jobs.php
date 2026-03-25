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
