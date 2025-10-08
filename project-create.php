<!-- public/project-create.php -->

<?php
session_start();
if (!isset($_SESSION['user_id'])) header('Location: login.php');
if ($_SERVER['REQUEST_METHOD']=='POST') {
  $c = curl_init('http://'.$_SERVER['HTTP_HOST'].'/api/projects.php');
  curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($c, CURLOPT_POST, true);
  curl_setopt($c, CURLOPT_POSTFIELDS, http_build_query([
    'name' => $_POST['name'],
    'desc' => $_POST['desc'],
    'org_id' => 1, // adjust as needed
    'plan_id' => 1
  ]));
  $out = json_decode(curl_exec($c),true);
  if (isset($out['id'])) {
    header('Location: dashboard.php'); exit;
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Create Project - Adhvyk AR Studio</title>
  <link rel="stylesheet" href="assets/styles/glass.css">
  <style>.glass {max-width:400px;margin:2em auto;}</style>
</head>
<body>
  <div class="glass">
    <h2>Create New Experience</h2>
    <form method="post">
      <input name="name" placeholder="Project Name" required class="glass"><br>
      <textarea name="desc" placeholder="Description" required class="glass"></textarea><br>
      <button class="btn">Create</button>
    </form>
    <p><a href="dashboard.php">Back to dashboard</a></p>
  </div>
</body>
</html>
