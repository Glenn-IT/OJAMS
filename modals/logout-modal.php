<!-- ============================================
     Modal: Logout Confirmation
     ============================================ -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Header -->
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="logoutModalLabel">
                    <i class="bi bi-box-arrow-right me-2"></i>Confirm Logout
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Body -->
            <div class="modal-body text-center py-4">
                <i class="bi bi-question-circle text-danger display-3 mb-3 d-block"></i>
                <h5>Are you sure you want to logout?</h5>
                <p class="text-muted mb-0">You will be redirected to the login page.</p>
            </div>

            <!-- Footer -->
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">
                    <i class="bi bi-x-lg me-1"></i>No
                </button>
                <a href="<?php echo $basePath ?? ''; ?>logout.php" class="btn btn-danger px-4">
                    <i class="bi bi-box-arrow-right me-1"></i>Yes, Logout
                </a>
            </div>
        </div>
    </div>
</div>
