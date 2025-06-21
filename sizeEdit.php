<?php
include 'navbar.php';

$id = $_GET['id'];
$SizeQuery = "SELECT * FROM size WHERE Id=$id";

$SizeResult = $conn->query($SizeQuery);
$row = $SizeResult->fetch_assoc();
?>
<?php include 'sidebar.php';?>

<div class="flex justify-center px-4 pb-10 pt-15 md:max-lg:ml-65 text-sm">
  <div class="w-full max-w-md bg-white p-6 sm:p-10 my-10 hover:drop-shadow-lg transition rounded-lg">
    <h1 class="text-2xl sm:text-3xl text-purple-600 font-bold pb-3">Purple</h1>
    <h3 class="text-lg sm:text-xl text-purple-600 font-semibold pb-5">Edit Size and Color!</h3>
    
    <form method="post" action="sizeUpdate.php?id=<?php echo htmlspecialchars($row['Id']); ?>">
      <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['Id']); ?>">

      <label for="Size" class="text-gray-600 block">Size</label>
      <input type="text" name="Size" id="Size" value="<?php echo htmlspecialchars($row['Size']); ?>"  placeholder="Enter size" class="w-full border border-gray-300 px-4 py-2 text-gray-700 mt-2 mb-5 rounded">

      <label for="Color" class="text-gray-600 block">Color</label>
      <input type="text" name="Color" id="Color" value="<?php echo htmlspecialchars($row['Color']); ?>"  placeholder="Enter color" class="w-full border border-gray-300 px-4 py-2 text-gray-700 mt-2 mb-5 rounded">

      <label for="Description" class="text-gray-600 block">Description</label>
      <textarea name="Description" id="Description" rows="3" class="w-full border border-gray-200 px-4 py-2 text-gray-700 mt-2 mb-5 rounded"><?php echo htmlspecialchars($row['Description']); ?></textarea>

      <input type="submit" value="Update" class="w-full rounded-lg bg-purple-600 hover:bg-purple-700 transition py-2 px-4 text-white font-medium cursor-pointer">
    </form>
  </div>
</div>
