<?php
// ===== dashboard.php – the page users see after logging in =====

session_start();

// If not logged in, send them back to the login page
if (!isset($_SESSION['user'])) {
    header('Location: login.html?error=login');
    exit;
}

$name = htmlspecialchars($_SESSION['user'], ENT_QUOTES, 'UTF-8');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="card">
        <div class="logo"><?= strtoupper(substr($name, 0, 1)) ?></div>
        <h1>Welcome, <?= $name ?>!</h1>
        <p class="welcome-text">You have logged in successfully.</p>
        <a class="btn" href="logout.php">Log out</a>
    </div>
</body>
</html>
