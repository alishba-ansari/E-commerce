<?php
include 'config.php';

$id = $_GET['id'];

$Brand = $_POST['Brand'];
$Description = $_POST['Description'];

$sql = "UPDATE brand SET  Brand = ? , Description = ? WHERE Id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss" , $Brand, $Description, $id);

if ($stmt->execute()) {
    header("location:brand.php");
} else {
    echo "Error Updating record" . $conn->error ;
}
?>
