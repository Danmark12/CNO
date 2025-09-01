<?php
session_start();
require __DIR__ . 'db/config.php'; 

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}


$email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
$password = $_POST['password'] ?? '';


if (!filter_var($email, FILTER_VALIDATE_EMAIL) || $password === '') {
    $_SESSION['login_error'] = 'Please provide a valid email and password.';
    $_SESSION['old_email'] = $email;
    header('Location: index.php');
    exit;
}

try {
    // Fetch user from DB
    $stmt = $pdo->prepare('SELECT id, first_name, last_name, email, password_hash, user_type 
                           FROM users 
                           WHERE email = :email 
                           LIMIT 1');
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password_hash'])) {
        // Login successful
        session_regenerate_id(true); // prevent session fixation
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['last_name'] = $user['last_name'];
        $_SESSION['user_type'] = $user['user_type'];

        // Update last login time
        $update = $pdo->prepare('UPDATE users SET last_login = NOW() WHERE id = :id');
        $update->execute(['id' => $user['id']]);

        // Redirect based on role
        if ($user['user_type'] === 'admin') {
            header('Location: admin/dashboard.php');
        } else {
            header('Location: bns/dashboard.php');
        }
        exit;
    } else {
        // Invalid credentials
        $_SESSION['login_error'] = 'Email or password is incorrect.';
        $_SESSION['old_email'] = $email;
        header('Location: index.php');
        exit;
    }
} catch (Exception $e) {
    // Log the error in production
    $_SESSION['login_error'] = 'An internal error occurred. Please try again later.';
    header('Location: index.php');
    exit;
}
