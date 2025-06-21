<?php
include 'config.php'; 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $status = $_POST['status'];

   
    $sql = "UPDATE orders SET status = ? WHERE Id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $id);

    if ($stmt->execute()) {
        header("location:orderTable.php");
    } else {
        echo "Error Updating record" . $conn->error ;
    }
}
?>