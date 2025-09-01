<?php
session_start();


$flash = $_SESSION['login_error'] ?? null;
unset($_SESSION['login_error']);


$old_email = $_SESSION['old_email'] ?? '';
unset($_SESSION['old_email']);
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>CNO — Login</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <main class="login-page">
    <div class="login-card">
      <h1>City Nutrition Office</h1>

      <?php if ($flash): ?>
        <div class="alert"><?= htmlspecialchars($flash) ?></div>
      <?php endif; ?>

      <form action="login.php" method="post" autocomplete="off">
        <label for="email">Email</label>
        <input 
          id="email" 
          name="email" 
          type="email" 
          required 
          value="<?= htmlspecialchars($old_email) ?>">

        <label for="password">Password</label>
        <div class="password-row">
          <input id="password" name="password" type="password" required>
          <button type="button" id="togglePw" class="pw-toggle">Show</button>
        </div>

        <button type="submit" class="btn">Sign in</button>
      </form>

      <p class="hint">Admin creates BNS accounts. No self-registration.</p>
    </div>
  </main>

  <script>

    document.getElementById('togglePw').addEventListener('click', function() {
      const pw = document.getElementById('password');
      if (pw.type === 'password') { 
        pw.type = 'text'; 
        this.textContent = 'Hide'; 
      } else { 
        pw.type = 'password'; 
        this.textContent = 'Show'; 
      }
    });
  </script>
</body>
</html>
