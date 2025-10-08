<!-- public/project-view.php -->

<?php
session_start();
if (!isset($_SESSION['user_id'])) header('Location: login.php');
$pid = $_GET['id'] ?? '0';
$c = curl_init('http://'.$_SERVER['HTTP_HOST'].'/api/projects.php?org_id=1'); // get all projects for org
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
$projects = json_decode(curl_exec($c),true) ?: [];
$project = null;
foreach ($projects as $p) if ($p['id']==$pid) $project = $p;
if (!$project) die('Not found');
?>
<!DOCTYPE html>
<html>
<head>
  <title><?=$project['name']?> - Adhvyk AR Studio</title>
  <link rel="stylesheet" href="assets/styles/glass.css">
  <style>.glass {margin:2em auto;max-width:650px;}</style>
</head>
<body>
  <div class="glass">
    <h2><?=$project['name']?></h2>
    <p><?=$project['description']?></p>
    <a href="dashboard.php" class="btn">Back</a>
    <a href="builder.php?project=<?=$pid?>" class="btn">Open Builder</a>
  </div>
</body>
</html>
