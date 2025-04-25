<?php
header("Content-Type: application/json");
require_once '../config/Database.php';
require_once '../classes/Product.php';

$db = (new Database())->connect();
$product = new Product($db);

$products = $product->getAllProducts();
echo json_encode($products);
?>
