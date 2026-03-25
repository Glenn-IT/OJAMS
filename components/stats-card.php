<!-- ============================================
     Component: Stats Card
     Usage: Pass $statTitle, $statValue, $statIcon, $statColor
     ============================================ -->
<div class="col-md-6 col-lg-3 mb-4">
    <div class="card border-0 shadow-sm stats-card">
        <div class="card-body text-center">
            <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                 style="width: 60px; height: 60px; background-color: <?php echo $statColor; ?>20;">
                <i class="bi <?php echo $statIcon; ?> fs-3" style="color: <?php echo $statColor; ?>;"></i>
            </div>
            <h3 class="fw-bold mb-1"><?php echo $statValue; ?></h3>
            <p class="text-muted mb-0"><?php echo $statTitle; ?></p>
        </div>
    </div>
</div>
