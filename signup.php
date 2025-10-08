<!-- public/signup.php -->

<?php
$error = '';
if ($_SERVER['REQUEST_METHOD']==='POST') {
  $c = curl_init('http://'.$_SERVER['HTTP_HOST'].'/api/auth.php?action=signup');
  curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($c, CURLOPT_POSTFIELDS, http_build_query($_POST));
  $out = json_decode(curl_exec($c),true);
  if (isset($out['success']) && $out['success']) {
    header('Location: login.php'); exit;
  } else {
    $error = $out['error'] ?? 'Sign up error';
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Sign Up - Adhvyk AR Studio</title>
  <link rel="stylesheet" href="assets/styles/glass.css">
  <style>body {background: linear-gradient(120deg,#e0eafc,#cfdef3);} .glass {max-width:400px;margin:2em auto;}</style>
</head>
<body>
  <div class="glass">
    <h2>Sign Up</h2>
    <?php if($error): ?><div style="color:red"><?=$error?></div><?php endif; ?>
    <form method="post">
      <input name="email" type="email" placeholder="Email" required class="glass"><br>
      <input name="name" placeholder="Name" required class="glass"><br>
      <input name="password" type="password" placeholder="Password" required class="glass"><br>
      <select name="plan_id" class="glass">
        <option value="1">Free</option>
        <option value="2">Pro</option>
        <option value="3">Enterprise</option>
      </select><br>
      <button class="btn">Create Account</button>
    </form>
    <p><a href="login.php">Back to login</a></p>
  </div>
</body>
</html>
