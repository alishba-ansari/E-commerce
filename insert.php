<?php
include 'config.php';

if (isset($_POST['Username'])) {
   
    $Username = isset($_POST['Username']) ? $_POST['Username'] : null;
    $Email = isset($_POST['Email']) ? $_POST['Email'] : null;
    $Password = isset($_POST['Password']) ? $_POST['Password'] : null;
    $Role = isset($_POST['Role']) ? $_POST['Role'] : null;

    $stmt = "INSERT INTO users (Username , Email , Password , Role) VALUES ('$Username' , '$Email' , '$Password' , '$Role')";

    $run = mysqli_query($conn,$stmt);

    if ($stmt) {
       
        if($run){
            header('location:dash.php');
        } 
        else{
            echo "Error:" . $stmt->error;
        }
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
}

?>

