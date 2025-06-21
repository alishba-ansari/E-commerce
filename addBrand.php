<?php
include 'navbar.php';

$Brand = $Description = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $Brand = $_POST['Brand'] ?? '';
    $Description = $_POST['Description'] ?? '';

    $stmt = $conn->prepare("INSERT INTO brand (Brand , Description) VALUES ( '$Brand', '$Description')");

    if ($stmt->execute()) {

      header('location:brand.php');
    } else {
      echo "Error: " . $stmt->error;
    }
}

?>
<?php include 'sidebar.php';?>

<div class="flex justify-center mt-10 px-4 py-10 md:max-lg:ml-65">
  <div class="w-full max-w-md bg-white p-6 sm:p-10 mt-10 mb-10 text-sm hover:drop-shadow-lg transition rounded-lg">
    <h1 class="text-2xl sm:text-3xl text-purple-600 font-bold pb-2">Purple</h1>
    <h3 class="text-lg sm:text-xl font-semibold text-slate-900 mb-5">Add a Brand</h3>

    <form method="POST">
      <label for="Brand" class="text-gray-600 block">Brand</label>
      <input type="text" name="Brand" class="border border-gray-200 py-2 px-4 w-full text-gray-700 mb-5 mt-2 rounded" placeholder="Enter brand name">

      <label for="Description" class="text-gray-600 block">Add Description</label>
      <textarea name="Description" rows="3" class="border border-gray-200 py-2 px-4 w-full text-gray-700 mb-5 mt-2 rounded" placeholder="Enter brand description"></textarea>

      <input type="submit" class="w-full bg-purple-600 hover:bg-purple-700 transition py-2 px-4 text-white font-medium rounded-lg cursor-pointer" value="Submit">
    </form>
  </div>
</div>
