<?php
include 'config.php';

$id = $_GET['id'];

$sql = "DELETE FROM brand where Id=$id";
$result = $conn->query($sql);

if ($result) {
    header('location:brand.php');
}

?>