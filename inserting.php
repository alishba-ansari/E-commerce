<?php
  include 'config.php';

  if (isset($_POST['FirstName'])) {
    
    $FirstName = isset($_POST['FirstName']) ? $_POST['FirstName'] : null;
    $LastName = isset($_POST['LastName']) ? $_POST['LastName'] : null;
    $FathersName = isset($_POST['FathersName']) ? $_POST['FathersName'] : null;
    $PhoneNumber = isset($_POST['PhoneNumber']) ? $_POST['PhoneNumber'] : null;
    $Caste = isset($_POST['Caste']) ? $_POST['Caste'] : null;
    $RegDate = isset($_POST['RegDate']) ? $_POST['RegDate'] : null;
    $Province = isset($_POST['Province']) ? $_POST['Province'] : null;
    $Gender = isset($_POST['Gender']) ? $_POST['Gender'] : null;
    $Studies = isset($_POST['Studies']) ? $_POST['Studies'] : null;

    $Study = implode(", ",$Studies);

    $stmt = "INSERT INTO customers (FirstName, LastName, FathersName, PhoneNumber, Caste, RegDate, Province, Gender, Studies) VALUES ('$FirstName', '$LastName', '$FathersName', '$PhoneNumber', '$Caste', '$RegDate', '$Province', '$Gender', '$Study')";

    $run = mysqli_query($conn,$stmt);

    if($stmt) {
        if ($run){
            header('location:checkout.php');
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "Error preparing statement:" . $conn->error;
    }
  }

?>