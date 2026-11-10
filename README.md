<?php
// ===== users.php – looks up user accounts in the MySQL database (login_db) =====

function find_user(string $username): ?array
{
    // XAMPP default MySQL login: user "root" with no password
    $pdo = new PDO('mysql:host=localhost;dbname=login_db;charset=utf8mb4', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare('SELECT name, password_hash AS hash FROM users WHERE username = ?');
    $stmt->execute([$username]);
    return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
}
