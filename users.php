<?php
// ===== users.php – where user accounts are looked up =====
// Demo account:  username: admin   password: admin123

function find_user(string $username): ?array
{
    $users = [
        'admin' => [
            'name' => 'Administrator',
            'hash' => password_hash('admin123', PASSWORD_DEFAULT),
        ],
    ];

    /* MySQL version (PDO) – use this instead of the array above:
     * $pdo  = new PDO('mysql:host=localhost;dbname=mydb;charset=utf8mb4', 'root', '');
     * $stmt = $pdo->prepare('SELECT name, password_hash AS hash FROM users WHERE username = ?');
     * $stmt->execute([$username]);
     * return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
     */

    return $users[strtolower($username)] ?? null;
}
