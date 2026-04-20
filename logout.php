<?php
/**
 * ==============================================
 * OJAMS - Logout Handler
 * ==============================================
 * Clears the localStorage session via JS redirect page.
 */
$basePath = "";
$pageTitle = "OJAMS - Logging out...";
include 'layouts/header.php';
?>
<div class="min-vh-100 d-flex align-items-center justify-content-center bg-light">
    <div class="text-center">
        <div class="spinner-border text-primary mb-3" role="status"></div>
        <p class="text-muted">Logging you out...</p>
    </div>
</div>
<?php include 'layouts/footer.php'; ?>
<script>
    Session.clear();
    setTimeout(() => { window.location.href = 'login.php'; }, 600);
</script>

