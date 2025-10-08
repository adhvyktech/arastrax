<?php
session_start();
require_once 'config.php';
require_once 'utils.php';

auth_required();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $project_id = $_POST['project_id'] ?? 0;
    $org_id = $_POST['org_id'] ?? 0;
    $type = $_POST['type'] ?? 'image';
    if (!isset($_FILES['file'])) respond(['error'=>'No file']);
    $tmp = $_FILES['file']['tmp_name'];
    $name = basename($_FILES['file']['name']);
    $dest = '../public/uploads/' . uniqid() . '-' . $name;
    move_uploaded_file($tmp, $dest);
    $url = '/uploads/' . basename($dest);
    $stmt = db()->prepare("INSERT INTO assets (project_id,org_id,uploader_id,type,url) VALUES(?,?,?,?,?)");
    $stmt->execute([$project_id,$org_id,$_SESSION['user_id'],$type,$url]);
    respond(['url'=>$url]);
}
?>
