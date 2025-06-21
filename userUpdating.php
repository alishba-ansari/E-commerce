<?php
 include 'config.php';

 $id = $_GET['id'];

 $Username = $_POST['Username'];
 $Email = $_POST['Email'];
 $Role =  $_POST['Role'];

 $sql = "UPDATE users SET Username = ? , Email = ? , Role = ? Where Id = ?";
 $stmt = $conn->prepare($sql);
 $stmt->bind_param("sssi", $Username, $Email, $Role, $id);

 if ($stmt->execute()) {
    header("location:userTable.php");
 } else {
    echo "Error Updating record:" . $conn->error;
 }

?>