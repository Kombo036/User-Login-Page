<?php
// check.php – finds out why login fails. DELETE this file after use.
$username = 'gillion_kombo';
$password = 'mypassword';   // the password you type on the login page

require 'users.php';
$src = file_get_contents('users.php');
echo strpos($src, 'mysql:') !== false
    ? "OK: users.php reads from the database<br>"
    : "PROBLEM: users.php is still the demo version (only admin/admin123 works)<br>";

$user = find_user($username);
if (!$user) {
    exit("PROBLEM: user '$username' was not found");
}
echo "OK: user found<br>";

if (strpos($user['hash'], '$2y$') !== 0) {
    exit("PROBLEM: password is stored as plain text, not a hash");
}
echo "OK: password is stored as a hash<br>";

echo password_verify($password, $user['hash'])
    ? "OK: password matches – login should work"
    : "PROBLEM: password does not match the stored hash";