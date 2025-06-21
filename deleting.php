<?php
include 'config.php';

  $id=$_GET['id'];

  $sql="DELETE From customers where Id=$id";
  $result = $conn->query($sql);

  if ($result){
    header('location:customerTable.php');
  }
?>