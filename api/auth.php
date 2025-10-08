<?php
session_start();
require_once "config.php";
require_once "utils.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $endpoint = $_GET['action'] ?? '';
    if ($endpoint == 'signup') {
        $email = $_POST['email'] ?? '';
        $pass = $_POST['password'] ?? '';
        $name = $_POST['name'] ?? '';
        $plan = $_POST['plan_id'] ?? 1;
        // Check exists
        $stmt = db()->prepare("SELECT id FROM users WHERE email=?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) respond(['error'=>'Email taken']);
        // Create
        $hash = hash_pass($pass);
        $stmt = db()->prepare("INSERT INTO users (email,password_hash,name,plan_id) VALUES (?,?,?,?)");
        $stmt->execute([$email,$hash,$name,$plan]);
        respond(['success'=>true]);
    }
    if ($endpoint == 'login') {
        $email = $_POST['email'] ?? '';
        $pass = $_POST['password'] ?? '';
        $stmt = db()->prepare("SELECT id,password_hash FROM users WHERE email=?");
        $stmt->execute([$email]);
        $u = $stmt->fetch();
        if (!$u || !check_pass($pass, $u['password_hash'])) respond(['error'=>'Invalid login']);
        $_SESSION['user_id'] = $u['id'];
        respond(['success'=>true]);
    }
    if ($endpoint == 'logout') {
        session_destroy();
        respond(['success'=>true]);
    }
}
respond(['error'=>'Invalid method']);
?>
