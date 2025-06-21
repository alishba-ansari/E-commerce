<?php

include 'config.php';

$id = $_GET['id'];

$sql = "DELETE FROM categories where Id=$id";
$result = $conn->query($sql);

if ($result) {
    header('location:category.php');
}

?>