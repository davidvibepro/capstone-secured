<?php
require_once '../config/db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = $_POST['full_name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    if ($password !== $confirm_password) {
        header('Location: ../register.php?error=Passwords do not match');
        exit;
    }
    $check = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $check->execute([$email]);
    if ($check->rowCount() > 0) {
        header('Location: ../register.php?error=Email already exists');
        exit;
    }
    $password_hash = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
    $insert = $pdo->prepare("INSERT INTO users (full_name, email, password_hash) VALUES (?, ?, ?)");
    if ($insert->execute([$full_name, $email, $password_hash])) {
        header('Location: ../login.php');
        exit;
    } else {
        header('Location: ../register.php?error=Registration failed. Please try again');
        exit;
    }
} else {
    header('Location: ../register.php');
    exit;
}
?>
