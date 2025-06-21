<?php

include 'config.php';

$id = $_GET['id'];

$sql = "DELETE FROM product where Id=$id";
$result = $conn->query($sql);

if ($result) {
    header('location:products.php');
}

?>