<?php
  include 'config.php';

  $id=$_GET['id'];

  $sql="DELETE From orders where Id=$id";
  $result = $conn->query($sql);

  if ($result){
    header('location:orderTable.php');
  }
?>