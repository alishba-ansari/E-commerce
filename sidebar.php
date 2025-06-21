<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- sidebar.php -->
<div id="sidebar" class="bg-white fixed top-0 left-0 h-full w-64 transform -translate-x-full md:translate-x-0 transition-transform duration-300 z-50 shadow-md">
  <div class="pt-5">
    <h2 class="text-3xl font-bold text-purple-500 pl-8">Purple</h2>
    <div class="flex items-center py-5 pl-8 hover:bg-gray-50 cursor-pointer transition">
      <img src="face1.jpg" class="w-12 h-12 rounded-full object-cover" />
      <div class="ml-4">
        <p class="text-gray-800 font-medium">David Grey. H</p>
        <p class="text-gray-400 text-sm">Project Manager</p>
      </div>
      <div class="ml-auto pe-8">
        <i class="bi bi-bookmark-check-fill text-teal-500"></i>
      </div>
    </div>

    <ul>
    <li class="text-gray-600 hover:text-purple-700 py-3 hover:bg-gray-50 px-8 transition">
        <a href="dash.php" class="flex justify-between">Dashboard <i class="bi bi-house-door-fill"></i></a>
      </li>
      <li>
        <button id="dropdown-btn" class="w-full text-left hover:bg-gray-50 flex justify-between items-center text-gray-700 hover:text-purple-700 py-3 hover:bg-gray-50 px-8 transition hover:cursor-pointer">
          <span>User</span>
          <i id="chevron-icon" class="bi bi-chevron-down"></i>
        </button>
        <div id="dropdown-content" class="max-h-0 overflow-hidden transition-all bg-gray-100">
          <a href="userTable.php " class="block text-gray-700 hover:text-purple-700 py-3 hover:bg-gray-50 px-8 transition">User Table</a>
          <a href="customerTable.php" class="block text-gray-700 hover:text-purple-700 py-3 hover:bg-gray-50 px-8 transition">Customer Table</a>
        </div>
      </li>
      <li class="text-gray-600 hover:text-purple-700 py-3 hover:bg-gray-50 px-8 transition"><a href="products.php" class="flex justify-between">Products <i class="bi bi-layout-sidebar"></i></a></li>
      <li class="text-gray-600 hover:text-purple-700 py-3 hover:bg-gray-50 px-8 transition"><a href="brand.php" class="flex justify-between">Brand <i class="bi bi-crosshair2"></i></a></li>
      <li class="text-gray-600 hover:text-purple-700 py-3 hover:bg-gray-50 px-8 transition"><a href="category.php" class="flex justify-between">Category <i class="bi bi-wallet2"></i></a></li>
      <li class="text-gray-600 hover:text-purple-700 py-3 hover:bg-gray-50 px-8 transition"><a href="size.php" class="flex justify-between">Size <i class="bi bi-box2-fill"></i></a></li>
      <li class="text-gray-600 hover:text-purple-700 py-3 hover:bg-gray-50 px-8 transition"><a href="orderTable.php" class="flex justify-between">Orders <i class="bi bi-person-rolodex"></i></a></li>
    </ul>
  </div>
</div>

<!-- Mobile backdrop -->
<div id="backdrop" class="fixed inset-0 bg-gray-400/40 hidden z-40 md:hidden"></div>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const sidebar = document.getElementById('sidebar');
    const sidebarToggle = document.getElementById('sidebarToggle');
    const backdrop = document.getElementById('backdrop');

    sidebarToggle?.addEventListener('click', () => {
      sidebar.classList.toggle('-translate-x-full');
      backdrop.classList.toggle('hidden');
    });

    backdrop?.addEventListener('click', () => {
      sidebar.classList.add('-translate-x-full');
      backdrop.classList.add('hidden');
    });

    const dropdownBtn = document.getElementById('dropdown-btn');
    const dropdownContent = document.getElementById('dropdown-content');
    const chevronIcon = document.getElementById('chevron-icon');

    dropdownBtn?.addEventListener('click', () => {
      if (dropdownContent.style.maxHeight) {
        dropdownContent.style.maxHeight = null;
        chevronIcon.classList.replace('bi-chevron-up', 'bi-chevron-down');
      } else {
        dropdownContent.style.maxHeight = dropdownContent.scrollHeight + "px";
        chevronIcon.classList.replace('bi-chevron-down', 'bi-chevron-up');
      }
    });

    const profileBtn = document.getElementById('profile-btn');
    const profileDropdown = document.getElementById('profile-dropdown');
    const profileContainer = document.getElementById('profile-dropdown-container');

    profileBtn?.addEventListener('click', (e) => {
      e.stopPropagation();
      profileDropdown.classList.toggle('hidden');
    });

    document.addEventListener('click', (e) => {
      if (!profileContainer.contains(e.target)) {
        profileDropdown.classList.add('hidden');
      }
    });
  });
</script>
</body>
</html>









