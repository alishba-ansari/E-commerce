<?php
include 'navbar.php';

$id = $_GET['id'] ?? null;

$brandQuery = "SELECT * FROM brand WHERE Id=?";
$stmt = $conn->prepare($brandQuery);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc(); 

$brandListQuery = "SELECT * FROM brand";
$brandListResult = $conn->query($brandListQuery);
?>
<?php include 'sidebar.php';?>

<div class="flex justify-center px-4 pt-15 pb-10 md:max-lg:ml-65 text-sm">
  <div class="w-full max-w-md bg-white p-6 sm:p-10 my-10 hover:drop-shadow-lg transition rounded-lg">
    <h1 class="text-2xl sm:text-3xl text-purple-600 font-bold pb-3">Purple</h1>
    <h3 class="text-lg sm:text-xl text-purple-600 font-semibold pb-4">Edit the Brand!</h3>

    <form method="post" action="brandUpdate.php?id=<?php echo htmlspecialchars($row['Id'] ?? ''); ?>">
      <input type="hidden" name="id" value="<?php echo $row['Id'] ?? ''; ?>">

      <label for="Brand" class="text-gray-600 block">Brand</label>
      <input type="text" name="Brand" value="<?php echo htmlspecialchars($row['Brand'] ?? ''); ?>" placeholder="Brand name" class="w-full border border-gray-300 px-4 py-2 text-gray-700 mt-2 mb-5 rounded">

      <label for="Description" class="text-gray-600 block">Add Description</label>
      <textarea name="Description" rows="3" class="mt-2 mb-5 border border-gray-200 py-3 px-4 w-full text-gray-700 rounded" placeholder="Enter description"><?php echo htmlspecialchars($row['Description'] ?? ''); ?></textarea>

      <input type="submit" value="Update" class="w-full bg-purple-600 hover:bg-purple-700 transition py-2 px-4 text-white font-medium rounded-lg cursor-pointer">
    </form>
  </div>
</div>

