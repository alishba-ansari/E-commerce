<?php
include 'config.php';
include 'productnavbar.php';
include 'dashboard.php';

$query = "select * from product";
$result = $conn->query($query);
?>

<div class="mx-4 md:mx-10 xl:mx-20 max-lg:mx-15 max-sm:mx-5">
  <div class="mt-30">
    <h1 class="text-5xl text-center text-purple-600 mb-5">Categories</h1>
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-2">
      <!-- Category Cards -->
      <div class="bg-white rounded-md mt-5 mx-1 hover:-translate-y-2 transition ease-in-out duration-200 delay-100 hover:cursor-pointer hover:drop-shadow-lg grid grid-cols-1 xl:px-12 py-5 max-sm:drop-shadow-md">
        <img src="download.jpg" class="w-30 h-30 object-cover pl-6">
        <p class="pt-3 text-center">Bags</p>
      </div>

      <div class="bg-white rounded-md mt-5 mx-1 hover:-translate-y-2 transition ease-in-out duration-200 delay-100 hover:cursor-pointer hover:drop-shadow-lg grid grid-cols-1 xl:px-8 max-xl:px-5 py-5 max-sm:drop-shadow-md">
        <img src="casual_shoes.webp" class="w-50 h-30 object-cover">
        <p class="pt-3 text-center">Shoes</p>
      </div>

      <div class="bg-white rounded-md mt-5 mx-1 hover:-translate-y-2 transition ease-in-out duration-200 delay-100 hover:cursor-pointer hover:drop-shadow-lg grid grid-cols-1 xl:px-6 py-5 max-sm:drop-shadow-md">
        <img src="mobile.webp" class="w-35 h-30 object-cover pl-6">
        <p class="pt-3 text-center">Mobiles</p>
      </div>

      <div class="bg-white rounded-md mt-5 mx-1 hover:-translate-y-2 transition ease-in-out duration-200 delay-100 hover:cursor-pointer hover:drop-shadow-lg grid grid-cols-1 xl:px-6 py-5 max-sm:drop-shadow-md">
        <img src="dress.webp" class="w-35 h-30 object-cover pl-7 ">
        <p class="pt-3 text-center">Dresses</p>
      </div>

      <div class="bg-white rounded-md mt-5 mx-1 hover:-translate-y-2 transition ease-in-out duration-200 delay-100 hover:cursor-pointer hover:drop-shadow-lg grid grid-cols-1 xl:px-6 py-5 max-sm:drop-shadow-md">
        <img src="tablet.jpg" class="w-35 h-30 object-cover pl-7 ">
        <p class="pt-3 text-center">Tablets</p>
      </div>

      <div class="bg-white rounded-md mt-5 mx-1 hover:-translate-y-2 transition ease-in-out duration-200 delay-100 hover:cursor-pointer hover:drop-shadow-lg grid grid-cols-1 xl:px-6 py-5 max-sm:drop-shadow-md">
        <img src="starter_kit.webp" class="w-35 h-30 object-cover pl-7">
        <p class="pt-3 text-center">Starter Kits</p>
      </div>

      <div class="bg-white rounded-md mt-5 mx-1 hover:-translate-y-2 transition ease-in-out duration-200 delay-100 hover:cursor-pointer hover:drop-shadow-lg grid grid-cols-1 xl:px-6 py-5 max-sm:drop-shadow-md">
        <img src="lego.jpg" class="w-35 h-30 object-cover pl-7">
        <p class="pt-3 text-center">Building Blocks</p>
      </div>

      <div class="bg-white rounded-md mt-5 mx-1 hover:-translate-y-2 transition ease-in-out duration-200 delay-100 hover:cursor-pointer hover:drop-shadow-lg grid grid-cols-1 xl:px-6 py-5 max-sm:drop-shadow-md">
        <img src="microphone.jpg" class="w-35 h-30 object-cover pl-7">
        <p class="pt-3 text-center">Microphones</p>
      </div>

      <div class="bg-white rounded-md mt-5 mx-1 hover:-translate-y-2 transition ease-in-out duration-200 delay-100 hover:cursor-pointer hover:drop-shadow-lg grid grid-cols-1 xl:px-6 py-5 max-sm:drop-shadow-md">
        <img src="towel.jpg" class="w-35 h-30 object-cover pl-7">
        <p class="pt-3 text-center">Towels , Rails & Warmers</p>
      </div>

      <div class="bg-white rounded-md mt-5 mx-1 hover:-translate-y-2 transition ease-in-out duration-200 delay-100 hover:cursor-pointer hover:drop-shadow-lg grid grid-cols-1 xl:px-6 py-5 max-sm:drop-shadow-md">
        <img src="cookware.jpg" class="w-35 h-30 object-cover pl-7">
        <p class="pt-3 text-center">Cookware</p>
      </div>

      <div class="bg-white rounded-md mt-5 mx-1 hover:-translate-y-2 transition ease-in-out duration-200 delay-100 hover:cursor-pointer hover:drop-shadow-lg grid grid-cols-1 xl:px-6 py-5 max-sm:drop-shadow-md">
        <img src="sunglass.jpg" class="w-35 h-30 object-cover pl-7">
        <p class="pt-3 text-center">Sunglasses</p>
      </div>

      <div class="bg-white rounded-md mt-5 mx-1 hover:-translate-y-2 transition ease-in-out duration-200 delay-100 hover:cursor-pointer hover:drop-shadow-lg grid grid-cols-1 xl:px-6 py-5 max-sm:drop-shadow-md">
        <img src="caps.jpg" class="w-35 h-30 object-cover pl-7">
        <p class="pt-3 text-center">Caps</p>
      </div>

      <div class="bg-white rounded-md mx-1 mt-5 hover:-translate-y-2 transition ease-in-out duration-200 delay-100 hover:cursor-pointer hover:drop-shadow-lg grid grid-cols-1 xl:px-6 py-5 max-sm:drop-shadow-md">
        <img src="snacks.jpg" class="w-35 h-30 object-cover pl-7">
        <p class="pt-3 text-center">Snacks</p>
      </div>

      <div class="bg-white rounded-md mt-5 mx-1 hover:-translate-y-2 transition ease-in-out duration-200 delay-100 hover:cursor-pointer hover:drop-shadow-lg grid grid-cols-1 xl:px-6 py-5 max-sm:drop-shadow-md">
        <img src="Earrings.jpg" class="w-35 h-30 object-cover pl-7">
        <p class="pt-3 text-center">Earrings</p>
      </div>
    </div>
  </div>

  <!-- All Products Section -->
  <form>
    <h1 class="text-5xl text-center text-purple-600 my-10">All Products</h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:max-lg:grid-cols-2 xl:grid-cols-4 max-xl:lg:grid-cols-3">
      <?php while ($row = mysqli_fetch_assoc($result)) { ?>
      <div class="bg-gray-50 hover:bg-white m-3 hover:-translate-y-2 transition ease-in-out duration-200 delay-100 hover:cursor-pointer hover:drop-shadow-lg grid grid-cols-1 gap-2 rounded-lg max-sm:drop-shadow-md">
        <a href="productDetails.php?id=<?php echo $row['Id']; ?>">
          <div class="p-5 ">
            <img src="<?php echo $row['Image']; ?>" class="object-cover w-60 h-60 max-sm:w-80">
          </div>
          <div class="pb-5 px-5">
            <h3 class="text-xl"><?php echo $row['Description']; ?></h3>
            <p class="py-1"><?php echo $row['Name']; ?></p>
            <div class="flex justify-between">
              <h3 class="text-lg text-purple-600 font-medium"><?php echo $row['Price']; ?></h3>
              <button class="bg-purple-500 hover:bg-purple-600 text-white hover:cursor-pointer px-3 py-1.5 rounded-full transition">
                <a href="addToCart.php?id=<?php echo $row['Id']; ?>">Add to Cart <i class="bi bi-cart"></i></a>
              </button>
            </div>
          </div>
        </a>
      </div>
      <?php } ?>
    </div>
  </form>
</div>


<?php
include 'footer.php';
?>

<script src="dash.js"></script>

<?php if (isset($_SESSION['message'])): ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let messageType = "<?php echo $_SESSION['message']['type']; ?>";
        let messageText = "<?php echo $_SESSION['message']['message']; ?>";
        
        let iconColor = messageType === "success" ? "text-green-500 border-green-500" : "text-yellow-500 border-yellow-500";
        let bgColor = messageType === "success" ? "bg-green-100" : "bg-yellow-100";
        let textColor = messageType === "success" ? "text-green-700" : "text-yellow-700";

        Swal.fire({
            icon: messageType,
            position: "center",
            showConfirmButton: false,
            timerProgressBar: true,
            timer: 1500,
            customClass: {
                popup: "flex items-center px-6 py-4 " + bgColor
            },
            html: `
                <div class="flex items-center gap-3 p-3 rounded-lg ${bgColor}">
                    <svg class="w-6 h-6 ${iconColor} border rounded-full p-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        ${messageType === "success"
                            ? '<path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>'
                            : '<path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01"></path>'
                        }
                    </svg>
                    <p class="text-lg ${textColor}">${messageText}</p>
                </div>
            `
        });
    });
</script>
<?php unset($_SESSION['message']); ?>
<?php endif; ?>
