<?php
// index.php
session_start();

// Grab and clear any flash message set by login.php
$flash = $_SESSION['login_error'] ?? null;
unset($_SESSION['login_error']);

// Preserve old email input if login failed
$old_email = $_SESSION['old_email'] ?? '';
unset($_SESSION['old_email']);
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>CNO NutriMap — Login</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background: #fff;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }
    header {
      display: flex;
      align-items: center;
      gap: 8px;
      padding: 16px 24px;
    }
    header img {
      height: 28px;
    }
    header span {
      font-weight: bold;
      font-size: 16px;
    }
    header span b {
      color: #00AEEF; /* CNO in cyan/blue */
    }
    main {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .login-box {
      text-align: center;
      max-width: 360px;
      width: 100%;
    }
    .login-box img {
      height: 90px;
      margin-bottom: 16px;
    }
    .login-box h2 {
      margin: 0 0 20px;
      font-size: 22px;
      font-weight: bold;
    }
    form {
      display: flex;
      flex-direction: column;
      gap: 14px;
    }
    input {
      padding: 12px 14px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 14px;
      outline: none;
      transition: border .2s;
    }
    input:focus {
      border-color: #0B1C80;
    }
    .btn {
      background: #0B1C80; /* deep navy */
      color: #fff;
      font-size: 15px;
      font-weight: 600;
      padding: 12px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      transition: background .2s;
    }
    .btn:hover {
      background: #08145c;
    }
    .links {
      margin-top: 12px;
      display: flex;
      justify-content: space-between;
      font-size: 13px;
    }
    .links a {
      text-decoration: none;
      color: #00AEEF;
    }
    .alert {
      background: #fff5f5;
      border: 1px solid #ffd2d2;
      color: #7a0b0b;
      padding: 10px;
      border-radius: 6px;
      margin-bottom: 12px;
      font-size: 14px;
    }
  </style>
</head>
<body>
  <header>
    <img src="assets/logo.png" alt="CNO Logo">
    <span><b>CNO</b> NutriMap</span>
  </header>

  <main>
    <div class="login-box">
      <img src="assets/city-logo.png" alt="City Logo">

      <h2>LOGIN</h2>

      <?php if ($flash): ?>
        <div class="alert"><?= htmlspecialchars($flash) ?></div>
      <?php endif; ?>

      <form action="login.php" method="post" autocomplete="off">
        <input 
          type="email" 
          name="email" 
          placeholder="Enter Email or Username" 
          required 
          value="<?= htmlspecialchars($old_email) ?>">

        <input 
          type="password" 
          name="password" 
          placeholder="Enter Password" 
          required>

        <button type="submit" class="btn">Log in</button>
      </form>

      <div class="links">
        <a href="#">Forgot password?</a>
        <a href="#">Just visit!</a>
      </div>
    </div>
  </main>
</body>
</html>
