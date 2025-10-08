<!-- public/builder.php -->

<?php
session_start();
if (!isset($_SESSION['user_id'])) header('Location: login.php');
$pid = $_GET['project'] ?? '0';
?>
<!DOCTYPE html>
<html>
<head>
  <title>Experience Builder - Adhvyk AR Studio</title>
  <link rel="stylesheet" href="assets/styles/glass.css">
  <style>
    body {background: linear-gradient(120deg,#e0eafc,#cfdef3);}
    .layout {display:flex;gap:18px;}
    .glass {margin-top:2em;}
    #preview {width:330px;height:390px;background:white;border-radius:12px;}
    .side {width:220px;}
  </style>
</head>
<body>
  <div class="glass layout">
    <!-- Scene Graph Left -->
    <div class="side glass">
      <h3>Scene Graph</h3>
      <ul>
        <li>Marker Image</li>
        <li>Asset 1</li>
        <li>Asset 2</li>
      </ul>
    </div>
    <!-- Center AR Preview -->
    <div>
      <h3>AR Preview</h3>
      <div id="preview"></div>
      <button class="btn" onclick="takeScreenshot()">Screenshot</button>
    </div>
    <!-- Asset Panel Right -->
    <div class="side glass">
      <h3>Assets</h3>
      <input type="file" id="uploadAsset"><br>
      <input type="color" id="chromaColor" value="#00ff00"><br>
      <input type="range" id="chromaThreshold" min="10" max="100" value="60"><br>
      <button class="btn" onclick="applyChroma()">Chroma Key</button>
    </div>
  </div>
  <script src="assets/js/chroma-key.js"></script>
  <script>
    function takeScreenshot() {alert('Screenshot taken!');}
    function applyChroma() {alert('Applied chroma key!');}
    document.getElementById('uploadAsset').onchange = function(evt){
      // Demo upload: extend with AJAX to api/assets.php
      alert('Upload triggered: real upload via AJAX needed');
    };
  </script>
</body>
</html>
