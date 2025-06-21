<?php
include 'config.php';

$id = $_GET['id'];

$sql = "DELETE FROM size where Id=$id";
$result = $conn->query($sql);

if ($result) {
    header('location:size.php');
}

?>