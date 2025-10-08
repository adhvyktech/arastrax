<!-- public/dashboard.php -->

<?php
session_start();
if (!isset($_SESSION['user_id'])) header('Location: login.php');
$projects = [];
$c = curl_init('http://'.$_SERVER['HTTP_HOST'].'/api/projects.php');
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
$projects = json_decode(curl_exec($c),true) ?: [];
?>
<!DOCTYPE html>
<html>
<head>
  <title>Dashboard - Adhvyk AR Studio</title>
  <link rel="stylesheet" href="assets/styles/glass.css">
  <style>
    body {background: linear-gradient(120deg,#e0eafc,#cfdef3);}
    .projects {display: flex; flex-wrap: wrap; gap:20px;}
    .project-card {width:220px;}
    .glass {margin:1.5em;}
    .topnav {margin-bottom:2em;}
  </style>
</head>
<body>
  <div class="topnav glass">
    <span>Welcome, User #<?=$_SESSION['user_id']?></span>
    <a href="project-create.php" class="btn">Create New Experience</a>
    <a href="logout.php" class="btn" style="background:#c23;">Logout</a>
  </div>
  <div class="glass">
    <h2>Your Projects</h2>
    <div class="projects">
      <?php foreach ($projects as $p): ?>
        <div class="glass project-card">
          <h3><?=$p['name']?></h3>
          <div>Status: <?=$p['status']?></div>
          <a href="project-view.php?id=<?=$p['id']?>" class="btn">Open</a>
        </div>
      <?php endforeach ?>
    </div>
  </div>
</body>
</html>
