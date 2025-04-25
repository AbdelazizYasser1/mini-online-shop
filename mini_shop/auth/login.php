<?php
header("Content-Type: application/json");
require_once '../config/Database.php';
require_once '../classes/User.php';
require_once '../classes/Auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"));
    $email = $data->email ?? '';
    $password = $data->password ?? '';

    if (empty($email) || empty($password)) {
        echo json_encode(['message' => 'Both email and password are required']);
        exit;
    }

    $db = (new Database())->connect();
    $auth = new Auth($db, new User($db));

    $user = $auth->login($email, $password);
    if ($user) {
        echo json_encode(['message' => 'Login successful', 'user' => $user]);
    } else {
        echo json_encode(['message' => 'Invalid credentials']);
    }
}
?>
