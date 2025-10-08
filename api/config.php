<?php
// api/config.php
const DB_HOST = 'localhost';
const DB_USER = 'your_user';
const DB_PASS = 'your_pass';
const DB_NAME = 'adhvyk_ar_studio';

function db() {
    static $pdo;
    if ($pdo) return $pdo;
    $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
    return $pdo;
}

function auth_required() {
    if (!isset($_SESSION['user_id'])) exit(json_encode(['error'=>'Login required']));
}
?>
