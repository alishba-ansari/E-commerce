<?php
include 'navbar.php';
$id = $_GET['id'];
$query = "SELECT * FROM product WHERE Id=$id";
$result = $conn->query($query);
$row = $result->fetch_assoc();

$existingImages = json_decode($row['Multiple_img']);

$brandQuery = "select * from brand"; 
$result = $conn->query($brandQuery) ;

$categoryQuery = "select * from categories"; 
$categoryResult = $conn->query($categoryQuery) ;

$SizeQuery = "select * from size"; 
$SizeResult = $conn->query($SizeQuery) ;
?>
<?php include 'sidebar.php';?>

<div class="xl:ml-80 md:max-xl:ml-65 mt-25 px-4 sm:px-6 lg:px-8">
  <div class="max-w-3xl mx-auto bg-white p-6 sm:p-10 my-10 rounded-lg shadow-md text-sm hover:drop-shadow-lg transition">
    <h1 class="text-3xl text-purple-600 font-bold pb-3">Edit Product</h1>
    <h3 class="text-xl font-semibold text-slate-900 mb-5">Edit Product Information</h3>

    <form method="POST" action="productUpdate.php?id=<?php echo $row['Id']; ?>" enctype="multipart/form-data" class="space-y-6">
      <input type="hidden" name="id" value="<?php echo $row['Id']; ?>">

      <!-- Name & Price -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div>
          <label class="text-gray-600">Product Name</label>
          <input type="text" name="Name" value="<?php echo $row['Name']; ?>" placeholder="Name"
            class="w-full border border-gray-300 px-4 py-2 text-gray-800 mt-2">
        </div>
        <div>
          <label class="text-gray-600">Price</label>
          <input type="text" name="Price" value="<?php echo $row['Price']; ?>"
            class="w-full border border-gray-300 px-4 py-2 text-gray-900 mt-2" placeholder="Price">
        </div>
      </div>

      <!-- Brand & Category -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div>
          <label class="text-gray-600">Brand</label>
          <select name="Brand" class="w-full border border-gray-300 px-4 py-2 text-gray-500 mt-2">
            <option value="">Select a brand</option>
            <?php while ($bRow = $result->fetch_assoc()) {
              $selected = ($bRow['Id'] == $row['Brand']) ? 'selected' : '';
              echo "<option value=\"{$bRow['Id']}\" $selected>{$bRow['Brand']}</option>";
            } ?>
          </select>
        </div>
        <div>
          <label class="text-gray-600">Category</label>
          <select name="Category" class="w-full border border-gray-300 px-4 py-2 text-gray-500 mt-2">
            <option value="">Select a category</option>
            <?php while ($cRow = $categoryResult->fetch_assoc()) {
              $selected = ($row['Category'] == $cRow['Id']) ? 'selected' : '';
              echo "<option value=\"{$cRow['Id']}\" $selected>{$cRow['Category']}</option>";
            } ?>
          </select>
        </div>
      </div>

      <!-- Description -->
      <div>
        <label class="text-gray-600">Description</label>
        <textarea name="Description" rows="3"
          class="mt-2 border border-gray-200 py-3 px-8 w-full text-gray-900"><?php echo htmlspecialchars($row['Description']); ?></textarea>
      </div>

      <!-- Size & Color -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div>
          <label class="text-gray-600">Size</label>
          <select name="Size" class="w-full border border-gray-300 px-4 py-2 text-gray-500 mt-2">
            <option value="">Pick a Size</option>
            <?php while ($sRow = $SizeResult->fetch_assoc()) {
              $selected = ($row['Size'] == $sRow['Id']) ? 'selected' : '';
              echo "<option value=\"{$sRow['Id']}\" $selected>{$sRow['Size']}</option>";
            } ?>
          </select>
        </div>

        <?php $SizeResult->data_seek(0); ?>

        <div>
          <label class="text-gray-600">Color</label>
          <select name="Color" class="w-full border border-gray-300 px-4 py-2 text-gray-500 mt-2">
            <option value="">Pick a color</option>
            <?php while ($sRow = $SizeResult->fetch_assoc()) {
              $selected = ($row['Color'] == $sRow['Id']) ? 'selected' : '';
              echo "<option value=\"{$sRow['Id']}\" $selected>{$sRow['Color']}</option>";
            } ?>
          </select>
        </div>
      </div>

      <!-- Single & Multiple Images -->
      <div class="grid grid-cols-1 gap-5">
        <div>
          <label class="text-gray-700">Single Image</label>
          <input type="file" name="newImage" class="w-full border border-gray-300 px-4 py-2 mt-2">
          <input type="hidden" name="uploadFile" value="<?php echo $row['Image']; ?>">
          <img src="<?php echo $row['Image']; ?>" class="w-24 h-24 object-cover rounded-md mt-3">
        </div>
        <div>
          <label class="text-gray-700">New Multiple Images</label>
          <input type="file" name="fileImg[]" multiple class="w-full border border-gray-300 px-4 py-2 mt-2">
        </div>
      </div>

      <!-- Existing Images with Delete Option -->
      <div class="flex flex-wrap gap-4">
        <?php foreach ($existingImages as $image) : ?>
          <div class="relative text-center">
            <img src="Images/<?php echo $image; ?>" class="w-20 h-20 rounded-md object-cover">
            <div class="mt-1">
              <input type="checkbox" name="deleteImages[]" value="<?php echo $image; ?>"> Delete
            </div>
          </div>
        <?php endforeach; ?>
      </div>

      <!-- Status & Stock -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div>
          <label class="text-gray-600">Stock</label>
          <input type="number" name="Stock" value="<?php echo $row['Stock']; ?>"
            class="w-full border border-gray-300 px-4 py-2 text-gray-900 mt-2">
        </div>
        <div class="flex items-center gap-6 pt-6">
          <label class="inline-flex items-center">
            <input type="radio" name="Status" value="Published" <?php echo ($row['Status'] === 'Published') ? 'checked' : ''; ?>>
            <span class="ml-2">Published</span>
          </label>
          <label class="inline-flex items-center">
            <input type="radio" name="Status" value="Drafted" <?php echo ($row['Status'] === 'Drafted') ? 'checked' : ''; ?>>
            <span class="ml-2">Drafted</span>
          </label>
        </div>
      </div>

      <input type="submit" value="Update"
        class="rounded-lg bg-purple-600 hover:bg-purple-700 transition py-2 px-8 text-white hover:cursor-pointer">
    </form>
  </div>
</div>
