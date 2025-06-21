<?php
include 'navbar.php';

$Category = $Description = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $Category = $_POST['Category'] ?? '';
    $Description = $_POST['Description'] ?? '';

    $stmt = $conn->prepare("INSERT INTO categories (Category , Description) VALUES (?, ?)");
    $stmt->bind_param("ss" , $Category , $Description);

    if ($stmt->execute()) {

      header('location:category.php');
    } else {
      echo "Error: " . $stmt->error;
    }
}

?>
<?php include 'sidebar.php';?>

<div class="md:max-lg:ml-65 flex justify-center px-4 pt-15 pb-10 text-sm">
  <div class="w-full max-w-md bg-white p-6 sm:p-10 my-10 hover:drop-shadow-lg transition rounded-lg">
    <h1 class="text-2xl sm:text-3xl text-purple-600 font-bold pb-3">Purple</h1>
    <h3 class="text-lg sm:text-xl font-semibold text-slate-900 mb-5">Add a Category</h3>

    <form method="POST">
      <label for="Category" class="text-gray-600 block">Category</label>
      <input type="text" name="Category" id="Category" placeholder="Enter category name" class="border border-gray-200 py-2 px-4 w-full text-gray-700 mb-5 mt-2 rounded">

      <label for="Description" class="text-gray-600 block">Add Description</label>
      <textarea name="Description" id="Description" rows="3" placeholder="Enter description" class="border border-gray-200 py-2 px-4 w-full text-gray-700 mb-5 mt-2 rounded"></textarea>

      <input type="submit" value="Submit" class="w-full bg-purple-600 hover:bg-purple-700 transition py-2 px-4 text-white font-medium rounded-lg cursor-pointer">
    </form>
  </div>
</div>
