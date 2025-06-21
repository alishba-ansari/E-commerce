<?php
  include 'config.php';

  $id=$_GET['id'];

  $sql="DELETE From users where Id=$id";
  $result = $conn->query($sql);

  if ($result){
    header('location:userTable.php');
  }
?>

