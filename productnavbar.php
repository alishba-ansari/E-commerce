<?php
session_start();

function getCartItemCount() {
    if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
        return 0;
    }
    
    $count = 0;
    foreach ($_SESSION['cart'] as $item) {
        if (!is_array($item) || !isset($item['quantity'])) {
            continue; 
        }
        $count += (int)$item['quantity']; 
    }
    return $count;
}

$cartCount = getCartItemCount();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <title>Document</title>
</head>
<body>
<style>
    [x-cloak] {
        display: none !important;
    }
</style>
<nav class="bg-white fixed top-0 z-10 md:py-5 md:px-6 w-full shadow-md">
  <div class="flex items-center justify-between max-sm:px-5 max-sm:py-5">

    <!-- Hamburger Menu -->
    <button id="mobile-menu-toggle" class="md:hidden text-2xl text-purple-700 focus:outline-none">
      <i class="bi bi-list"></i>
    </button>

    <!-- Desktop Nav -->
    <ul class="hidden md:flex gap-8" id="nav-links">
      <li class="hover:text-purple-600 transition line"><a href="index.php">HOME</a></li>
      <li class="hover:text-purple-600 transition line"><a href="#">ABOUT US</a></li>
      <li class="hover:text-purple-600 transition line"><a href="#">CONTACT US</a></li>
    </ul>

    <!-- Right side -->
    <div class="flex items-center gap-6">
      <!-- Cart Icon -->
      <a href="Cart.php" class="relative hover:text-purple-600 transition">
        <i class="bi bi-cart text-xl"></i>
        <?php if ($cartCount > 0): ?>
        <span class="absolute -top-2 -right-2 bg-purple-600 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs">
          <?php echo $cartCount; ?>
        </span>
        <?php endif; ?>
      </a>

      <!-- Customer Login -->
      <?php if (isset($_SESSION['customer'])): ?>
      <div x-data="{ open: false }" class="relative hidden md:block">
        <button @click="open = !open" class="flex items-center gap-2 hover:text-purple-600 transition focus:outline-none">
          <i class="bi bi-person text-2xl"></i>
          <span><?php echo $_SESSION['customer']['Customer_name']; ?></span>
        </button>

        <!-- Dropdown -->
        <div x-show="open" x-cloak @click.away="open = false" x-transition class="absolute right-0 mt-2 w-40 bg-white border border-gray-200 rounded-md shadow-lg py-2 z-20">
          <a href="account.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-purple-50">My Account</a>
          <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-purple-50">Settings</a>
          <a href="customer_logout.php" class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50">Log Out</a>
        </div>
      </div>
      <?php else: ?>
      <a href="customers_login.php" class="hover:text-purple-600 transition hidden md:block">
        <i class="bi bi-person text-2xl"></i>
      </a>
      <?php endif; ?>
    </div>
  </div>

  <!-- Mobile Menu -->
  <ul id="mobile-nav" class="md:hidden hidden mt-4 space-y-2 bg-gray-100 p-5">
    <li class="hover:text-purple-600 transition"><a href="index.php">HOME</a></li>
    <li class="hover:text-purple-600 transition"><a href="#">ABOUT US</a></li>
    <li class="hover:text-purple-600 transition"><a href="#">CONTACT US</a></li>
    <?php if (!isset($_SESSION['customer'])): ?>
    <li>
      <a href="customers_login.php" class="hover:text-purple-600 transition block">
        <i class="bi bi-person text-xl"></i> Login
      </a>
    </li>
    <?php endif; ?>
  </ul>
</nav>

    <script>
    const toggle = document.getElementById('mobile-menu-toggle');
    const mobileNav = document.getElementById('mobile-nav');

    toggle.addEventListener('click', () => {
        mobileNav.classList.toggle('hidden');
    });
    </script>
    <script src="dash.js"></script>
</body>
</html>


