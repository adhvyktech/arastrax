<?php
session_start();
require_once 'config.php';
require_once 'utils.php';

auth_required();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $uid = $_SESSION['user_id'];
    $stmt = db()->prepare("SELECT id,email,name,plan_id,org_id,role,status FROM users WHERE id=?");
    $stmt->execute([$uid]);
    respond($stmt->fetch());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uid = $_SESSION['user_id'];
    $name = $_POST['name'] ?? '';
    $stmt = db()->prepare("UPDATE users SET name=? WHERE id=?");
    $stmt->execute([$name,$uid]);
    respond(['success'=>true]);
}
?>
