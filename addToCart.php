<?php
session_start();
include 'config.php';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    $query = "SELECT * FROM product WHERE Id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['message'] = [
                'type' => 'warning',
                'message' => 'Product already exists in the cart!'
            ];
        } else {
            $_SESSION['cart'][$product_id] = [
                'id' => $row['Id'],
                'name' => $row['Name'],
                'description' => $row['Description'],
                'price' => $row['Price'],
                'image' => $row['Image'],
                'quantity' => 1
            ];
            $_SESSION['message'] = [
                'type' => 'success',
                'message' => 'Product added to cart successfully!'
            ];
        }
    }
    $stmt->close();
}

if (isset($_SERVER['HTTP_REFERER'])) {
    header("Location: " . $_SERVER['HTTP_REFERER']);
} else {
    header("Location: index.php");
}
exit();

?>
