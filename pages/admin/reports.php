<?php
/**
 * ==============================================
 * OJAMS - Reports & Monitoring (Admin Module)
 * ==============================================
 * Displays report tables and download functionality.
 */
$pageTitle   = "OJAMS - Reports & Monitoring";
$basePath    = "../../";
$currentPage = "reports";

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
                        <i class="bi bi-graph-up me-2 text-primary"></i>Reports & Monitoring
                    </h2>
                    <p class="text-muted mb-0">View analytics and generate system reports.</p>
                </div>
                <button class="btn btn-primary" onclick="downloadReport()">
                    <i class="bi bi-download me-1"></i>Download Report
                </button>
            </div>

            <!-- ── Section: Total Applicants per Job ── -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0 fw-bold">
                        <i class="bi bi-bar-chart me-2 text-primary"></i>Total Applicants per Job
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <?php
                            $columns = ['#', 'Job Title', 'Total Applicants', 'Visual'];
                            include $basePath . 'components/table-header.php';
                            ?>
                            <tbody id="reportPerJobTbody">
                                <?php $count = 1; ?>
                                <?php foreach ($applicants_per_job as $row): ?>
                                    <tr>
                                        <td><?php echo $count++; ?></td>
                                        <td>
                                            <i class="bi bi-briefcase me-1 text-primary"></i>
                                            <?php echo $row['job_title']; ?>
                                        </td>
                                        <td>
                                            <span class="badge bg-primary rounded-pill"><?php echo $row['applicants']; ?></span>
                                        </td>
                                        <td style="width: 40%;">
                                            <!-- Simple Bar Visualization -->
                                            <div class="progress" style="height: 20px;">
                                                <?php
                                                $maxApplicants = max(array_column($applicants_per_job, 'applicants'));
                                                $percentage = $maxApplicants > 0 ? ($row['applicants'] / $maxApplicants) * 100 : 0;
                                                ?>
                                                <div class="progress-bar bg-primary" style="width: <?php echo $percentage; ?>%">
                                                    <?php echo $row['applicants']; ?>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- ── Section: Monthly Application Report ── -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0 fw-bold">
                        <i class="bi bi-calendar-month me-2 text-primary"></i>Monthly Application Report
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive mb-4">
                        <table class="table table-hover">
                            <?php
                            $columns = ['#', 'Month', 'Total Applications', 'Visual'];
                            include $basePath . 'components/table-header.php';
                            ?>
                            <tbody id="reportMonthlyTbody">
                                <?php $count = 1; ?>
                                <?php foreach ($monthly_report as $row): ?>
                                    <tr>
                                        <td><?php echo $count++; ?></td>
                                        <td>
                                            <i class="bi bi-calendar me-1 text-primary"></i>
                                            <?php echo $row['month']; ?>
                                        </td>
                                        <td>
                                            <span class="badge bg-success rounded-pill"><?php echo $row['applications']; ?></span>
                                        </td>
                                        <td style="width: 40%;">
                                            <div class="progress" style="height: 20px;">
                                                <?php
                                                $maxMonthly = max(array_column($monthly_report, 'applications'));
                                                $pctMonthly = $maxMonthly > 0 ? ($row['applications'] / $maxMonthly) * 100 : 0;
                                                ?>
                                                <div class="progress-bar bg-success" style="width: <?php echo $pctMonthly; ?>%">
                                                    <?php echo $row['applications']; ?>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Chart Placeholder -->
                    <div class="border rounded p-5 text-center bg-light">
                        <i class="bi bi-bar-chart-line display-1 text-muted"></i>
                        <p class="text-muted mt-3 mb-0">
                            <strong>Chart Placeholder</strong><br>
                            A visual chart (e.g., Chart.js) would be rendered here in the full implementation.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include $basePath . 'layouts/footer.php'; ?>

<script>
requireAdmin('../../login.php', '../../pages/user/browse-jobs.php');

document.addEventListener('DOMContentLoaded', () => {
    const apps = Applications.all();
    const jobs = Jobs.all();

    // Applicants per job
    const perJobTbody = document.getElementById('reportPerJobTbody');
    if (perJobTbody) {
        const counts = {};
        apps.forEach(a => { const k = a.job_id; counts[k] = (counts[k] || { title: a.job_title, count: 0 }); counts[k].count++; });
        const rows = Object.values(counts);
        if (rows.length === 0) {
            perJobTbody.innerHTML = '<tr><td colspan="3" class="text-center text-muted">No data yet.</td></tr>';
        } else {
            perJobTbody.innerHTML = rows.map(r => `<tr><td>${r.title}</td><td>${r.count}</td></tr>`).join('');
        }
    }

    // Monthly report
    const monthlyTbody = document.getElementById('reportMonthlyTbody');
    if (monthlyTbody) {
        const months = {};
        apps.forEach(a => {
            const m = a.date_applied?.slice(0,7) || 'Unknown';
            if (!months[m]) months[m] = { total: 0, approved: 0, rejected: 0 };
            months[m].total++;
            if (a.status === 'Approved') months[m].approved++;
            if (a.status === 'Rejected') months[m].rejected++;
        });
        const entries = Object.entries(months);
        if (entries.length === 0) {
            monthlyTbody.innerHTML = '<tr><td colspan="4" class="text-center text-muted">No data yet.</td></tr>';
        } else {
            monthlyTbody.innerHTML = entries.map(([m, d]) =>
                `<tr><td>${m}</td><td>${d.total}</td><td><span class="badge bg-success">${d.approved}</span></td><td><span class="badge bg-danger">${d.rejected}</span></td></tr>`
            ).join('');
        }
    }
});
</script>
