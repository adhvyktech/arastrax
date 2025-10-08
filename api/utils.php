<?php
// api/utils.php
require_once 'config.php';

function respond($data) {
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}

function hash_pass($pass) {
    return password_hash($pass, PASSWORD_BCRYPT);
}

function check_pass($pass, $hash) {
    return password_verify($pass, $hash);
}
?>
