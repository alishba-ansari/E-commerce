<?php
include 'config.php';

$id = $_GET['id'];

$Size = $_POST['Size'];
$Color = $_POST['Color'];
$Description = $_POST['Description'];

$sql = "UPDATE size SET Size = ? , Color = ? , Description = ? WHERE Id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss" ,$Size,  $Color, $Description, $id);

if ($stmt->execute()) {
    header("location:size.php");
} else {
    echo "Error Updating record" . $conn->error ;
}
?>
