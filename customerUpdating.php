<?php
include 'config.php';

$id = $_GET['id'];

$FirstName = $_POST['FirstName'];
$LastName = $_POST['LastName'];
$FathersName = $_POST['FathersName'];
$PhoneNumber = $_POST['PhoneNumber'];
$Caste = $_POST['Caste'];
$RegDate = $_POST['RegDate'];
$Province = $_POST['Province'];
$Gender = $_POST['Gender'];
$Study = implode(",", $_POST['Studies']);


$sql = "UPDATE customers SET FirstName = ? , LastName = ? , FathersName = ? , PhoneNumber = ? , Caste = ? , RegDate = ? , Province = ? , Gender = ? , Studies = ? WHERE Id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssssssi" , $FirstName, $LastName, $FathersName, $PhoneNumber, $Caste, $RegDate, $Province, $Gender, $Study, $id);

if ($stmt->execute()) {
    header("location:customerTable.php");
}
 else {
      echo "Error Updating record." . $conn->error;
}
?>