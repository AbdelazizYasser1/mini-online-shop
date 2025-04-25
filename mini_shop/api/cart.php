<?php
header("Content-Type: application/json");
require_once '../config/Database.php';
require_once '../classes/Cart.php';

$db = (new Database())->connect();
$cart = new Cart($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"));
    $user_id = $data->user_id ?? '';
    $product_id = $data->product_id ?? '';
    $quantity = $data->quantity ?? '';

    if ($cart->addToCart($user_id, $product_id, $quantity)) {
        echo json_encode(['message' => 'Product added to cart successfully.']);
    } else {
        echo json_encode(['message' => 'Failed to add product to cart.']);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $user_id = $_GET['user_id'];
    $cartItems = $cart->getCartItems($user_id);
    echo json_encode($cartItems);
}
?>
