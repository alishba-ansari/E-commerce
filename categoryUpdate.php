<?php
include 'config.php';

$id = $_GET['id'];

$Category = $_POST['Category'];
$Description = $_POST['Description'];

$sql = "UPDATE categories SET Category = ? , Description = ? WHERE Id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss" , $Category, $Description, $id);

if ($stmt->execute()) {
    header("location:category.php");
} else {
    echo "Error Updating record" . $conn->error ;
}
?>