<?php
include 'navbar.php';
$query = "SELECT brand.Brand AS brandname, 
                 categories.Category AS categoryname, 
                 size.Size AS sizenum, 
                 size.Color AS colorname, 
                 product.* 
          FROM product 
          INNER JOIN brand ON brand.id = product.Brand 
          INNER JOIN categories ON categories.id = product.Category 
          INNER JOIN size ON size.id = product.Size";
$result = $conn->query($query) ;
?>

<?php include 'sidebar.php';?>

<div class="mt-10 md:ml-69 md:mr-5 max-sm:mx-5 py-10 overflow-hidden">
  <div class="text-center ">
    <p class="text-3xl text-purple-600 font-medium my-4">Product Table</p>
    <button class="bg-purple-600 hover:bg-purple-700 text-white px-7 font-semibold py-2 transition hover:cursor-pointer mb-8 rounded-lg ">
      <a href="addProduct.php">Add Products</a>
    </button>
  </div>
  
  
  <div class="overflow-x-auto w-full mb-16">
    <table class="bg-white w-full text-center text-sm"> 
      <tr class="bg-purple-700 text-white font-normal">
        <th class="border px-5 py-2">Id</th>
        <th class="border px-8 py-2">Image</th>
        <th class="border px-5 py-2">Name</th>
        <th class="border px-5 py-2">Brand</th>
        <th class="border px-5 py-2">Category</th>
        <th class="border px-5 py-2">Description</th>
        <th class="border px-5 py-2">Size</th>
        <th class="border px-5 py-2">Color</th>
        <th class="border px-5 py-2">Price</th>
        <th class="border px-5 py-2">Status</th>
        <th class="border px-5 py-2">Stock</th>
        <th class="border px-30 py-2">Multiple Image</th>
        <th class="border px-5 py-2">Edit</th>
        <th class="border px-5 py-2">Delete</th>
      </tr>

      <?php while ($row = mysqli_fetch_assoc($result)) { ?>
      <tr>
        <td class="border border-gray-200 px-5 py-2"><?php echo $row['Id']; ?></td>
        <td class="border border-gray-200 px-2 py-2">
          <img src="<?php echo $row['Image'];?>" class="w-20 h-20 rounded-md object-cover">
        </td>
        <td class="border border-gray-200 px-5 py-2"><?php echo $row['Name']; ?></td>
        <td class="border border-gray-200 px-5 py-2"><?php echo $row['brandname']; ?></td>
        <td class="border border-gray-200 px-5 py-2"><?php echo $row['categoryname']; ?></td>
        <td class="border border-gray-200 px-5 py-2"><?php echo $row['Description']; ?></td>
        <td class="border border-gray-200 px-5 py-2"><?php echo $row['sizenum']; ?></td>
        <td class="border border-gray-200 px-5 py-2"><?php echo $row['colorname']; ?></td>
        <td class="border border-gray-200 px-5 py-2"><?php echo $row['Price']; ?></td>
        <td class="border border-gray-200 px-5 py-2"><?php echo $row['Status']; ?></td>
        <td class="border border-gray-200 px-5 py-2"><?php echo $row['Stock']; ?></td>
        <td class="border border-gray-200 px-4 py-2 flex gap-2">
          <?php foreach(json_decode($row["Multiple_img"]) as $image) : ?>
          <img src="Images/<?php echo $image;?>" class="w-20 h-20 rounded-md object-cover">
          <?php endforeach; ?>
        </td>
        <td class="border border-gray-200 px-4 py-2">
          <button class="text-white bg-purple-600 hover:bg-purple-700 transition px-4 py-1 rounded-lg font-medium">
            <a href="productEdit.php?id=<?php echo $row['Id']; ?>">Edit</a>
          </button>
        </td>
        <td class="border border-gray-200 px-4 py-2">
          <button class="text-white bg-red-500 hover:bg-red-600 transition px-4 py-1 rounded-lg font-medium">
            <a href="productDelete.php?id=<?php echo $row['Id']; ?>">Delete</a>
          </button>
        </td>
      </tr>
      <?php } ?>
    </table>
  </div>
</div>
