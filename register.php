<?php
session_start();
require 'db/config.php';

// Handle form submission
$message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $phone_number = trim($_POST['phone_number']);
    $user_type = $_POST['user_type']; // admin or bns
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $message = "Passwords do not match!";
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO users (first_name, last_name, email, phone_number, user_type, password_hash) 
                               VALUES (?, ?, ?, ?, ?, ?)");
        try {
            $stmt->execute([$first_name, $last_name, $email, $phone_number, $user_type, $hash]);
            $message = "✅ Account created successfully!";
        } catch (PDOException $e) {
            $message = "❌ Error: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - CNO NutriMap</title>
</head>
<body style="margin:0; font-family: Arial, sans-serif; background:#f4f6f9;">

    <!-- Top Bar -->
    <div style="background:#1e3a8a; color:white; padding:10px 20px; display:flex; align-items:center; justify-content:space-between;">
        <div style="display:flex; align-items:center;">
            <span style="font-size:24px; margin-right:15px; cursor:pointer;">☰</span>
            <h2 style="margin:0; font-size:20px;">CNO NutriMap</h2>
        </div>
        <div style="flex:1; text-align:center;">
            <input type="text" placeholder="Search..." 
                   style="padding:5px 10px; width:50%; border-radius:20px; border:1px solid #ccc;">
        </div>
        <div style="display:flex; align-items:center; gap:15px;">
            <span style="cursor:pointer;">🔔</span>
            <span style="cursor:pointer;">👤</span>
        </div>
    </div>

    <!-- Register Card -->
    <div style="display:flex; justify-content:center; align-items:center; margin-top:40px;">
        <div style="background:white; padding:30px; border-radius:12px; box-shadow:0 4px 10px rgba(0,0,0,0.1); width:450px;">
            <h2 style="text-align:center; margin-bottom:20px; color:#1e3a8a;">Create Account</h2>

            <?php if ($message): ?>
                <p style="color:red; text-align:center;"><?= $message ?></p>
            <?php endif; ?>

            <form method="POST" style="display:flex; flex-direction:column; gap:15px;">
                
                <div style="display:flex; gap:10px;">
                    <input type="text" name="first_name" placeholder="First Name" required
                           style="flex:1; padding:10px; border:1px solid #ccc; border-radius:8px;">
                    <input type="text" name="last_name" placeholder="Last Name" required
                           style="flex:1; padding:10px; border:1px solid #ccc; border-radius:8px;">
                </div>

                <input type="email" name="email" placeholder="Email" required
                       style="padding:10px; border:1px solid #ccc; border-radius:8px;">

                <div style="display:flex; gap:10px;">
                    <input type="text" name="phone_number" placeholder="Phone Number" required
                           style="flex:1; padding:10px; border:1px solid #ccc; border-radius:8px;">
                    <select name="user_type" required
                            style="flex:1; padding:10px; border:1px solid #ccc; border-radius:8px;">
                        <option value="bns">BNS</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                <input type="password" name="password" placeholder="Password" required
                       style="padding:10px; border:1px solid #ccc; border-radius:8px;">

                <input type="password" name="confirm_password" placeholder="Confirm Password" required
                       style="padding:10px; border:1px solid #ccc; border-radius:8px;">

                <button type="submit"
                        style="background:#1e3a8a; color:white; padding:12px; border:none; border-radius:25px; font-size:16px; cursor:pointer;">
                    Register
                </button>
            </form>
        </div>
    </div>

</body>
</html>
