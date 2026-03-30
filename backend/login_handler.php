<?php
require_once '../config/db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user && password_verify($password, $user['password_hash'])) {
        $payload = [
            'user_id' => $user['id'],
            'email' => $user['email'],
            'exp' => time() + 3600
        ];
        $jwt = generate_jwt($payload);
        $secure = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on';
        setcookie('token', $jwt, time() + 3600, '/', '', $secure, true);
        $base = rtrim(dirname(dirname($_SERVER['PHP_SELF'])), '/');
        header('Location: ' . $base . '/dashboard.php');
        exit;
    }
    $base = rtrim(dirname(dirname($_SERVER['PHP_SELF'])), '/');
    header('Location: ' . $base . '/login.php?error=Invalid email or password');
    exit;
} else {
    $base = rtrim(dirname(dirname($_SERVER['PHP_SELF'])), '/');
    header('Location: ' . $base . '/login.php');
    exit;
}
?>