<?php
header("Content-Type: application/json");
require_once '../config/Database.php';
require_once '../classes/User.php';
require_once '../classes/Auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"));
    $username = $data->username ?? '';
    $email = $data->email ?? '';
    $password = $data->password ?? '';

    if (empty($username) || empty($email) || empty($password)) {
        echo json_encode(['message' => 'All fields are required']);
        exit;
    }

    $db = (new Database())->connect();
    $auth = new Auth($db, new User($db));

    if ($auth->register($username, $email, $password)) {
        echo json_encode(['message' => 'User registered successfully']);
    } else {
        echo json_encode(['message' => 'User registration failed']);
    }
}
?>
