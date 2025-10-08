<!-- public/resetpw.php -->

<!DOCTYPE html>
<html>
<head>
  <title>Reset Password - Adhvyk AR Studio</title>
  <link rel="stylesheet" href="assets/styles/glass.css">
  <style>.glass {max-width:400px;margin:2em auto;}</style>
</head>
<body>
  <div class="glass">
    <h2>Reset Password</h2>
    <form method="post" action="api/auth.php?action=forgot">
      <input name="email" type="email" placeholder="Email" required class="glass"><br>
      <button class="btn">Send Reset Link</button>
    </form>
    <p><a href="login.php">Back to login</a></p>
  </div>
</body>
</html>
