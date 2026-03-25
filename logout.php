<?php
/**
 * ==============================================
 * OJAMS - Logout Handler
 * ==============================================
 * Prototype: Simply redirects to login page.
 * In production, this would destroy sessions.
 */
// session_destroy(); // Would be used in production
header("Location: login.php");
exit;
