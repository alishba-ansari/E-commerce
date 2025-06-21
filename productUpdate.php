<?php
include 'config.php';

$id = $_GET['id']; 

$Name = $_POST['Name'] ?? '';
$Brand = $_POST['Brand'] ?? '';
$Category = $_POST['Category'] ?? '';
$Description = $_POST['Description'] ?? '';
$Size = $_POST['Size'] ?? '';
$Color = $_POST['Color'] ?? '';
$Price = $_POST['Price'] ?? '';
$Status = $_POST['Status'] ?? '';
$Stock = $_POST['Stock'] ?? '';

$deleteImages = $_POST['deleteImages'] ?? [];
$existingImages = json_decode($_POST['existingImages'], true) ?? []; 

$oldImage = "";  

$imagePath = $oldImage;

if (!empty($_FILES["newImage"]["name"])) { 
    $Filename = $_FILES["newImage"]["name"]; 
    $temp_name = $_FILES["newImage"]["tmp_name"]; 
    $folder = "Images/" . basename($Filename);  

    if (move_uploaded_file($temp_name, $folder)) { 
        $imagePath = $folder; 
        if (!empty($oldImage) && file_exists($oldImage)) {
            unlink($oldImage);
        }
    } else { 
        $imagePath = $oldImage; 
    }
} 

$updatedImages = array_diff($existingImages, $deleteImages);

if (!empty($_FILES['fileImg']['name'][0])) {
    $totalFiles = count($_FILES['fileImg']['name']);

    for ($i=0; $i < $totalFiles; $i++) { 
        $ImageName = $_FILES["fileImg"]["name"][$i];
        $tmp_name = $_FILES["fileImg"]["tmp_name"][$i];

        $ImageExtension = strtolower(pathinfo($ImageName, PATHINFO_EXTENSION));
        $newImageName = uniqid() . '.' . $ImageExtension;

        move_uploaded_file($tmp_name, "Images/" . $newImageName);
        $updatedImages[] = $newImageName;
    }
}
 
$updatedImagesJSON = json_encode(array_values($updatedImages));

$sql = "UPDATE product SET Name = ?, Brand = ?, Category = ?, Description = ?, Size = ?, Color = ?, Price = ?, Status = ?, Stock = ?, Image = ?, Multiple_img = ? WHERE Id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssssssssi", $Name, $Brand, $Category, $Description, $Size, $Color, $Price, $Status, $Stock, $imagePath, $updatedImagesJSON, $id);

if ($stmt->execute()) {
    header("Location: products.php"); 
    exit;
} else {
    echo "Error Updating record: " . $stmt->error;
}
?>
