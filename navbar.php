<?php 
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
  <title>Document</title>
</head>
<body class="bg-gray-100">

<nav class="md:ml-64 py-4 px-4 md:px-8 bg-white flex justify-between items-center fixed top-0 left-0 right-0 z-40 shadow">
  <div class="flex items-center space-x-4">
    <button id="sidebarToggle" class="md:hidden p-2 rounded-md bg-white shadow-md">
      <i class="bi bi-list text-2xl text-purple-700"></i>
    </button>

    <div class="relative hidden sm:block">
      <div class="absolute inset-y-0 left-2 flex items-center text-gray-500">
        <i class="fa fa-search text-purple-600"></i>
      </div>
      <input type="text" placeholder="Search projects" class="pl-8 pr-2 py-1.5 rounded-md text-sm bg-gray-100 focus:outline-none" />
    </div>
  </div>

  <div class="relative" id="profile-dropdown-container">
    <div class="flex items-center gap-2 cursor-pointer" id="profile-btn">
      <img src="face1.jpg" class="w-9 h-9 rounded-full object-cover" />
      <i class="bi bi-chevron-down text-gray-500 text-sm"></i>
    </div>
    <div id="profile-dropdown" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow hidden z-50">
      <a href="#" class="block px-4 py-2 hover:bg-gray-100">Profile</a>
      <a href="#" class="block px-4 py-2 hover:bg-gray-100">Settings</a>
      <a href="customer_logout.php" class="block px-4 py-2 hover:bg-gray-100">Logout</a>
    </div>
  </div>
</nav>
</body>
</html>
