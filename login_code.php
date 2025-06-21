<?php
include 'config.php';
session_start();

$email=$_POST['Email'];
$password=$_POST['Password'];

$sql="SELECT * FROM users where email ='$email'";
$data=$conn->query($sql);
$user=$data->fetch_assoc();


if ($email == $user['Email'] && $password == $user['Password']) {
    $_SESSION['flash'] = ['type' => 'success', 'message' => 'Login successful!'];
    $_SESSION['user'] = $user;
    header('location:dash.php');
} else {
    $_SESSION['flash'] = ['type' => 'error', 'message' => 'Invalid Email or Password'];
    header('location:login.php');
}

?>
