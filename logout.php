<?php
// ===== logout.php – ends the session and returns to login.html =====

session_start();
$_SESSION = [];
session_destroy();

header('Location: login.html?error=logout');
exit;
