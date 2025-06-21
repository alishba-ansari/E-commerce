<?php
include 'navbar.php';

$Name = $Brand = $Category = $Description = $Size = $Color = $Price = $Status = $Stock = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (!empty($_FILES["uploadFile"]["name"])) {
    $Filename = $_FILES["uploadFile"]["name"];
    $temp_name = $_FILES["uploadFile"]["tmp_name"];
    $folder = "Images/" . basename($Filename);

    if (move_uploaded_file($temp_name, $folder)) {
        $imageName = basename($Filename); 
    }
    }

    $totalFiles = count($_FILES['fileImg']['name']);
    $filesArray = array();

    for ($i=0; $i < $totalFiles ; $i++) { 
     $ImageName = $_FILES["fileImg"]["name"][$i];
     $tmpName = $_FILES["fileImg"]["tmp_name"][$i];

     $ImageExtension = explode('.' , $ImageName);
     $ImageExtension = strtolower(end($ImageExtension));

     $newImageName = uniqid() . '.' . $ImageExtension;

     move_uploaded_file($tmpName , "Images/" . $newImageName);
     $filesArray[] = $newImageName; 
    }
    
    $filesArray = json_encode($filesArray);

    $Name = $_POST['Name'] ?? '';
    $Brand = $_POST['Brand'] ?? '';
    $Category = $_POST['Category'] ?? '';
    $Description = $_POST['Description'] ?? '';
    $Size = $_POST['Size'] ?? '';
    $Color = $_POST['Color'] ?? '';
    $Price = $_POST['Price'] ?? '';
    $Status = $_POST['Status'] ?? '';
    $Stock = $_POST['Stock'] ?? '';
    
    $stmt = $conn->prepare("INSERT INTO product (Image, Name , Brand , Category , Description, Size, Color, Price, Status, Stock, Multiple_img) VALUES ('$folder', '$Name', '$Brand', '$Category' ,'$Description' , '$Size' , '$Color' , '$Price' , '$Status' , '$Stock' , '$filesArray')");

    if ($stmt->execute()) {
      header('location:products.php');
    } else {
      echo "Error: " . $stmt->error;
    }
}

$brandQuery = "select * from brand"; 
$brandResult = $conn->query($brandQuery) ;

$categoryQuery = "select * from categories"; 
$categoryResult = $conn->query($categoryQuery) ;

$SizeQuery = "select * from size"; 
$SizeResult = $conn->query($SizeQuery) ;
?>

<?php
include 'sidebar.php';
?>
<div class="xl:ml-80 md:max-xl:ml-65 mt-25 px-4 sm:px-6 lg:px-8">
  <div class="max-w-3xl bg-white p-6 sm:p-10 my-10 rounded-lg shadow-md">
    <h1 class="text-3xl text-purple-600 font-bold pb-3">Add Product</h1>
    <h3 class="text-xl font-semibold text-slate-900 mb-5">Provide Product Information</h3>

    <form method="POST" enctype="multipart/form-data" class="space-y-6">

      <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
        <input type="text" name="Name" value="<?php echo $Name; ?>" placeholder="Name"
          class="w-full border border-gray-300 px-4 py-3 text-gray-500">
        <input type="text" name="Price" value="<?php echo $Price; ?>" placeholder="Price"
          class="w-full border border-gray-300 px-4 py-3 text-gray-500">
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
        <div>
          <label class="text-gray-600">Brand</label>
          <select name="Brand" class="w-full border border-gray-300 px-4 py-3 text-gray-500">
            <option value="">Select a brand</option>
            <?php while ($row = $brandResult->fetch_assoc()) { ?>
              <option value="<?php echo $row['Id']; ?>"><?php echo $row['Brand']; ?></option>
            <?php } ?>
          </select>
        </div>

        <div>
          <label class="text-gray-600">Category</label>
          <select name="Category" class="w-full border border-gray-300 px-4 py-3 text-gray-500">
            <option value="">Select a category</option>
            <?php while ($row = $categoryResult->fetch_assoc()) { ?>
              <option value="<?php echo $row['Id']; ?>"><?php echo $row['Category']; ?></option>
            <?php } ?>
          </select>
        </div>
      </div>

      <div>
        <label class="text-gray-600">Description</label>
        <textarea name="Description" rows="3"
          class="w-full border border-gray-300 px-4 py-3 text-gray-500"></textarea>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
        <div>
          <label class="text-gray-600">Size</label>
          <select name="Size" class="w-full border border-gray-300 px-4 py-3 text-gray-500">
            <option value="">Pick a size</option>
            <?php while ($row = $SizeResult->fetch_assoc()) { ?>
              <option value="<?php echo $row['Id']; ?>"><?php echo $row['Size']; ?></option>
            <?php } ?>
          </select>
        </div>

        <?php $SizeResult->data_seek(0); ?>

        <div>
          <label class="text-gray-600">Color</label>
          <select name="Color" class="w-full border border-gray-300 px-4 py-3 text-gray-500">
            <option value="">Pick a color</option>
            <?php while ($row = $SizeResult->fetch_assoc()) { ?>
              <option value="<?php echo $row['Id']; ?>"><?php echo $row['Color']; ?></option>
            <?php } ?>
          </select>
        </div>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
        <div>
          <label class="text-gray-600">One Image</label>
          <input type="file" name="uploadFile" class="w-full border border-gray-300 px-4 py-3">
        </div>

        <div>
          <label class="text-gray-600">Multiple Images</label>
          <input type="file" name="fileImg[]" multiple required
            class="w-full border border-gray-300 px-4 py-3">
        </div>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
        <div>
          <label class="text-gray-600">Stock</label>
          <input type="number" name="Stock" value="<?php echo $Stock; ?>"
            class="w-full border border-gray-300 px-4 py-3 text-gray-500">
        </div>

        <div class="flex items-center space-x-6 pt-7">
          <label class="inline-flex items-center">
            <input type="radio" name="Status" value="Published" class="text-purple-600">
            <span class="ml-2 text-gray-700">Published</span>
          </label>

          <label class="inline-flex items-center">
            <input type="radio" name="Status" value="Drafted" class="text-purple-600">
            <span class="ml-2 text-gray-700">Drafted</span>
          </label>
        </div>
      </div>

      <input type="submit" value="Submit"
        class="w-full md:w-auto hover:cursor-pointer bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 px-8 rounded-lg transition">
    </form>
  </div>
</div>
