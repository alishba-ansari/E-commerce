<?php
include 'navbar.php';

$Size = $Color = $Description = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $Size = $_POST['Size'] ?? '';
    $Color = $_POST['Color'] ?? '';
    $Description = $_POST['Description'] ?? '';

    $stmt = $conn->prepare("INSERT INTO size (Size , Color , Description) VALUES (?, ?, ?)");
    $stmt->bind_param("sss" , $Size,  $Color , $Description);

    if ($stmt->execute()) {
      header('location:size.php');
    } else {
      echo "Error: " . $stmt->error;
    }
}
?>
<?php include 'sidebar.php';?>

<div class="flex justify-center px-4 pb-10 pt-15 md:max-lg:ml-65 text-sm">
  <div class="w-full max-w-md bg-white p-6 sm:p-10 my-10 hover:drop-shadow-lg transition rounded-lg">
    <h1 class="text-2xl sm:text-3xl text-purple-600 font-bold pb-3">Purple</h1>
    <h3 class="text-lg sm:text-xl font-semibold text-slate-900 mb-5">Add Size and Color!</h3>

    <form method="POST">
      <label for="Size" class="text-gray-600 block">Size</label>
      <input type="text" name="Size" id="Size" placeholder="Enter size" class="border border-gray-200 py-2 px-4 w-full text-gray-700 mb-5 mt-2 rounded">

      <label for="Color" class="text-gray-600 block">Color</label>
      <input type="text" name="Color" id="Color" placeholder="Enter color" class="border border-gray-200 py-2 px-4 w-full text-gray-700 mb-5 mt-2 rounded">

      <label for="Description" class="text-gray-600 block">Add Description</label>
      <textarea name="Description" id="Description" rows="3" placeholder="Enter description" class="border border-gray-200 py-2 px-4 w-full text-gray-700 mb-5 mt-2 rounded"><?php echo htmlspecialchars($Description ?? ''); ?></textarea>

      <input type="submit" value="Submit" class="w-full bg-purple-600 hover:bg-purple-700 transition py-2 px-4 text-white font-medium rounded-lg cursor-pointer">
    </form>
  </div>
</div>
