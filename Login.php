<?php
session_start();
require 'db/config.php'; // your DB connection file

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (!empty($email) && !empty($password)) {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password_hash'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_type'] = $user['user_type'];
            $_SESSION['first_name'] = $user['first_name'];

            // update last login
            $pdo->prepare("UPDATE users SET last_login = NOW() WHERE id = ?")->execute([$user['id']]);

            // redirect based on role
            if ($user['user_type'] === 'admin') {
                header("Location: admin_dashboard.php");
            } else {
                header("Location: bns_dashboard.php");
            }
            exit;
        } else {
            $error = "Invalid email/username or password!";
        }
    } else {
        $error = "All fields are required!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>CNO NutriMap - Login</title>
</head>
<body style="margin:0; font-family: Arial, sans-serif; background:#fff;">

  <!-- Header -->
  <div style="display:flex; align-items:center; padding:15px 25px;">
    <img src="image/241505183_2029324617215618_7371484540230229919_n (1).jpg" alt="CNO Logo" style="width:35px; height:35px; margin-right:8px;">
    <h2 style="margin:0; font-size:18px; color:#00AEEF; font-weight:bold;">CNO <span style="color:#000;">NutriMap</span></h2>
  </div>

  <!-- Container -->
  <div style="display:flex; flex-direction:column; align-items:center; justify-content:center; height:80vh;">

    <!-- Seal -->
    <img src="image/241505183_2029324617215618_7371484540230229919_n (1).jpg" alt="City Seal" style="width:80px; height:80px; margin-bottom:15px;">

    <!-- Title -->
    <h2 style="margin:0 0 20px 0; font-weight:700;">LOGIN</h2>

    <!-- Error -->
    <?php if (!empty($error)): ?>
      <p style="color:red; font-size:14px; margin-bottom:10px;"><?php echo $error; ?></p>
    <?php endif; ?>

    <!-- Form -->
    <form method="POST" action="" style="width:280px; text-align:center;">
      <input type="text" name="email" placeholder="Enter Email or Username" required
             style="width:100%; padding:10px; margin-bottom:12px; border:1px solid #ccc; border-radius:5px; font-size:14px;">

      <input type="password" name="password" placeholder="Enter Password" required
             style="width:100%; padding:10px; margin-bottom:15px; border:1px solid #ccc; border-radius:5px; font-size:14px;">

      <button type="submit"
              style="width:100%; padding:10px; background:#000080; color:white; border:none; border-radius:6px; font-size:15px; font-weight:bold; cursor:pointer;">
        Log in
      </button>
    </form>

    <!-- Footer links -->
    <div style="margin-top:10px; font-size:13px; width:280px; display:flex; justify-content:space-between;">
      <a href="#" style="text-decoration:none; color:#555;">Forgot password?</a>
      <a href="#" style="text-decoration:none; color:#00AEEF;">Just visit!</a>
    </div>
  </div>
</body>
</html>
