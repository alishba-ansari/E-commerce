<?php
include 'navbar.php';

$id = $_GET['id'];
$query = "SELECT * FROM categories WHERE Id=$id";
$categoryResult = $conn->query($query);
$row = $categoryResult->fetch_assoc();
?>
<?php include 'sidebar.php';?>

<div class="flex justify-center md:max-lg:ml-65 px-4 pt-15 text-sm pb-10">
  <div class="w-full max-w-md bg-white p-6 sm:p-10 my-10 hover:drop-shadow-lg transition rounded-lg">
    <h1 class="text-2xl sm:text-3xl text-purple-600 font-bold pb-3">Purple</h1>
    <h3 class="text-lg sm:text-xl text-purple-600 font-semibold pb-4">Edit the Category!</h3>

    <form method="post" action="categoryUpdate.php?id=<?php echo htmlspecialchars($row['Id'] ?? ''); ?>">
      <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['Id'] ?? ''); ?>">

      <label for="Category" class="text-gray-600 block">Category</label>
      <input type="text" id="Category" name="Category" value="<?php echo htmlspecialchars($row['Category'] ?? ''); ?>" placeholder="Enter category name" class="w-full border border-gray-300 px-4 py-2 text-gray-700 mt-2 mb-5 rounded">

      <label for="Description" class="text-gray-600 block">Add Description</label>
      <textarea id="Description" name="Description" rows="3" placeholder="Enter description" class="mt-2 mb-5 border border-gray-200 py-3 px-4 w-full text-gray-700 rounded"><?php echo htmlspecialchars($row['Description'] ?? ''); ?></textarea>

      <input type="submit" value="Update" class="w-full bg-purple-600 hover:bg-purple-700 transition py-2 px-4 text-white font-medium rounded-lg cursor-pointer">
    </form>
  </div>
</div>
