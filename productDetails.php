<?php
include 'config.php';
include 'productnavbar.php';
include 'dashboard.php';

$id = $_GET['id'];
$query = "SELECT 
            product.*, 
            brand.Brand AS brandname, 
            categories.Category AS categoryname, 
            size.Size AS sizenum, 
            size.Color AS colorname
          FROM product
          INNER JOIN brand ON brand.id = product.Brand
          INNER JOIN categories ON categories.id = product.Category
          INNER JOIN size ON size.id = product.Size
          WHERE product.Id = $id";
$result = $conn->query($query);
$row = $result->fetch_assoc();

?>

<!-- Sidebar info start-->
<div class="mt-25 grid justify-center font-medium">
    <h1 class="text-3xl text-purple-600">Product Details</h1>
</div>
<div class="flex flex-col lg:flex-row mt-10 gap-8 xl:px-10 max-xl:px-5 max-sm:px-5 mb-20">

  <!-- Sidebar -->
  <div class="w-full xl:w-1/4 max-xl:w-1/6 max-lg:hidden">
    <hr class="text-gray-300">
    <p class="pt-2 text-xl">Category :</p>
    <p class="py-2 text-purple-600 font-normal text-lg"><?php echo $row['categoryname'];?></p>

    <hr class="text-gray-300">
    <p class="pt-3 text-xl ">Price :</p>
    <div class="flex mb-6 mt-4 items-center">
      <input type="text" placeholder="Min" class="py-2 px-4 border w-1/2 border-gray-400 bg-gray-50 mr-2 rounded-md">
      -
      <input type="text" placeholder="Max" class="py-2 px-4 border w-1/2 border-gray-400 bg-gray-50 ml-2 rounded-md">
    </div>

    <hr class="text-gray-300">
    <p class="pt-3 text-xl">Rating :</p>
    <!-- Ratings -->
    <?php
      for ($i = 5; $i >= 2; $i--) {
          echo '<div class="flex gap-1 items-center mb-2">';
          for ($j = 1; $j <= 5; $j++) {
              if ($j <= $i) {
                  echo '<i class="bi bi-star-fill text-yellow-400"></i>';
              } else {
                  echo '<i class="bi bi-star text-gray-500"></i>';
              }
          }
          if ($i < 5) echo '<span class="text-gray-500 ml-2">And Up</span>';
          echo '</div>';
      }
    ?>
    <hr class="text-gray-300">
  </div>

  <!-- Product Card -->
  <div class="w-full min-h-fit lg:w-2/4 bg-white drop-shadow-lg rounded-lg p-5">
    <div class="flex flex-col md:flex-row gap-6">
      <div class="md:w-1/2">
        <img src="<?php echo $row['Image'];?>" class="w-full h-full object-cover rounded-md">
      </div>
      <div class="md:w-1/2">
        <p class="text-2xl md:text-3xl pb-2"><?php echo $row['Description'];?></p>
        <p class="pb-2"><?php echo $row['Name'];?></p>
        <p class="pb-2">Brand: <?php echo $row['brandname'];?></p>
        <p class="pb-2">Category: <?php echo $row['categoryname'];?></p>
        <p class="pb-2">Size: <?php echo $row['sizenum'];?></p>
        <p class="pb-2">Color: <?php echo $row['colorname'];?></p>
        <p class="pb-2 text-xl text-purple-600 font-semibold"><?php echo $row['Price'];?></p>
        <p class="pb-2">Stock: <?php echo $row['Stock']?></p>
      </div>
    </div>
    <div class="flex justify-between items-center mt-4 flex-wrap gap-4">
  
  <!-- Thumbnails -->
  <div class="flex items-center gap-2 overflow-x-auto max-w-full">
    <span class="text-xl hover:text-purple-700 cursor-pointer"><i class="bi bi-chevron-left"></i></span>
    <?php foreach(json_decode($row["Multiple_img"]) as $image) : ?>
      <img src="Images/<?php echo $image;?>" class="w-16 h-16 rounded-md object-cover border-2 border-gray-400 hover:border-purple-500 transition duration-200 cursor-pointer">
    <?php endforeach; ?>
    <span class="text-xl hover:text-purple-700 cursor-pointer"><i class="bi bi-chevron-right"></i></span>
  </div>

  <!-- Buttons -->
  <div class="flex gap-3">
    <button class="text-white bg-yellow-400 hover:bg-yellow-500 font-medium xl:px-4 py-2 max-xl:px-2 rounded-lg transition hover:cursor-pointer">Buy Now</button>
    <a href="addToCart.php?id=<?php echo $row['Id'];?>">
      <button class="bg-purple-500 hover:bg-purple-600 text-white font-medium xl:px-4 py-2 max-xl:px-2 rounded-lg transition hover:cursor-pointer">
        Add to Cart <i class="bi bi-cart"></i>
      </button>
    </a>
  </div>

</div>

  </div>

  <!-- Delivery Details -->
  <div class="w-full min-h-fit lg:w-1/4 bg-white drop-shadow-lg rounded-lg p-6">
    <div class="flex justify-between items-center mb-4">
      <p class="font-medium text-lg">Delivery Details</p>
      <i class="bi bi-info-circle text-purple-600"></i>
    </div>

    <div class="flex items-start gap-2 mb-4">
      <i class="bi bi-geo-alt text-purple-600 text-xl"></i>
      <div>
        <p class="text-base">Sindh, Karachi - Gulshan-e-Iqbal Block 15</p>
        <p class="text-purple-500 text-sm mt-1">CHANGE</p>
      </div>
    </div>
    <hr class="text-gray-300 mb-4">

    <div class="flex justify-between mb-4">
      <div class="flex items-start gap-3">
        <i class="bi bi-truck text-xl text-purple-600"></i>
        <div>
          <p class="text-base font-medium">Standard Delivery</p>
          <p class="text-gray-400 text-sm">Get by 24-27 Feb</p>
        </div>
      </div>
      <p class="text-base font-medium">Rs. 299</p>
    </div>

    <div class="flex items-center gap-3 mb-4">
      <i class="bi bi-cash-stack text-purple-600"></i>
      <p>Cash On Delivery Available</p>
    </div>
    <hr class="text-gray-300 mb-4">

    <div class="flex justify-between items-center mb-2">
      <p class="text-base font-medium">Return & Warranty</p>
      <i class="bi bi-info-circle text-purple-600"></i>
    </div>
    <p class="text-base mb-2"><i class="fa-solid fa-rotate-left text-purple-600"></i> 14 Days easy return</p>
    <p class="text-base mb-4"><i class="bi bi-shield text-purple-600"></i> 1 Year Brand Warranty</p>
    <hr class="text-gray-300 mb-6">

    <div class="text-center">
      <button class="text-white bg-purple-600 px-6 py-3 rounded-lg hover:bg-purple-700 transition">
        Go to Store <i class="bi bi-shop pl-2"></i>
      </button>
    </div>
  </div>
</div>



<script src="dash.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php

if (isset($_SESSION['message'])) {
    $messageType = $_SESSION['message']['type'];
    $messageText = $_SESSION['message']['message'];
    unset($_SESSION['message']); 
?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    Swal.fire({
    position: "center",
    showConfirmButton: false,
    timerProgressBar: true,
    timer: 1500, 
    customClass: {
        popup: "flex items-center px-6 py-4",
        title: "flex items-center gap-2 text-lg", 
    },
    html: `
        <div class="flex items-center gap-2">
            <svg class="w-6 h-6 text-green-500 border border-green-500 rounded-full" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
            </svg>
            <p class="text-lg"><?php echo $messageText; ?></p>
        </div>
    `
});
</script>
<?php
}
?>