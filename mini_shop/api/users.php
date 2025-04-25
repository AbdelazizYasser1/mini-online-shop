<?php
header("Content-Type: application/json");
require_once '../config/Database.php';
require_once '../classes/User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"));
    $username = $data->username ?? '';
    $email = $data->email ?? '';
    $password = $data->password ?? '';

    $db = (new Database())->connect();
    $user = new User($db);
    
    if ($user->register($username, $email, $password)) {
        echo json_encode(['message' => 'User registered successfully.']);
    } else {
        echo json_encode(['message' => 'User registration failed.']);
    }
}
?>
