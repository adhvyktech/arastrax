<!-- public/login.php -->

<?php
session_start();
if (isset($_SESSION['user_id'])) header('Location: dashboard.php');
$error = '';
if ($_SERVER['REQUEST_METHOD']=='POST') {
  $c = curl_init('http://'.$_SERVER['HTTP_HOST'].'/api/auth.php?action=login');
  curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($c, CURLOPT_POSTFIELDS, http_build_query($_POST));
  $out = json_decode(curl_exec($c),true);
  if (isset($out['success']) && $out['success']) {
    header('Location: dashboard.php'); exit;
  } else {
    $error = $out['error'] ?? 'Login failed';
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login - Adhvyk AR Studio</title>
  <link rel="stylesheet" href="assets/styles/glass.css">
  <style>body {background: linear-gradient(120deg,#e0eafc,#cfdef3);} .glass {max-width:400px;margin:2em auto;}</style>
</head>
<body>
  <div class="glass">
    <h2>Login</h2>
    <?php if($error): ?><div style="color:red"><?=$error?></div><?php endif; ?>
    <form method="post">
      <input name="email" type="email" placeholder="Email" required class="glass"><br>
      <input name="password" type="password" placeholder="Password" required class="glass"><br>
      <button class="btn">Login</button>
    </form>
    <p><a href="signup.php">Create account</a> | <a href="resetpw.php">Forgot password?</a></p>
  </div>
</body>
</html>
