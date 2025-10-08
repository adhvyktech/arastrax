<?php
session_start();
require_once 'config.php';
require_once 'utils.php';

auth_required();

$uid = $_SESSION['user_id'];

// GET: List projects by org/user
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $org = $_GET['org_id'] ?? null;
    $sql = "SELECT * FROM projects WHERE (org_id=? OR creator_id=?) AND status != 'deleted'";
    $stmt = db()->prepare($sql);
    $stmt->execute([$org, $uid]);
    respond($stmt->fetchAll());
}

// POST: Create
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $org = $_POST['org_id'] ?? 0;
    $name = $_POST['name'] ?? '';
    $desc = $_POST['desc'] ?? '';
    $plan = $_POST['plan_id'] ?? 1;
    $stmt = db()->prepare("INSERT INTO projects (org_id,creator_id,name,description,plan_id) VALUES (?,?,?,?,?)");
    $stmt->execute([$org,$uid,$name,$desc,$plan]);
    respond(['id' => db()->lastInsertId()]);
}
?>
