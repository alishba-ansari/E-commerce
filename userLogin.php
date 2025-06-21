<?php
include 'header.php';
include 'insert.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
  <title>User Register</title>
</head>
<body class="bg-gray-200 min-h-screen flex items-center justify-center px-4 ">
  <div class="w-full max-w-lg bg-white p-6 md:p-10 rounded-lg shadow-md lg:ml-130 mt-30">
    <h1 class="text-3xl text-purple-600 font-bold mb-4">Purple</h1>
    <h3 class="text-xl font-semibold text-slate-900">User Register</h3>
    <p class="mb-6 text-sm text-gray-600">Add a new user below</p>

    <form action="insert.php" method="post" class="space-y-5">
      <input 
        type="text" 
        name="Username" 
        placeholder="Username" 
        required 
        class="w-full border border-gray-300 px-4 py-3 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500"
      />

      <input 
        type="email" 
        name="Email" 
        placeholder="Email" 
        required 
        class="w-full border border-gray-300 px-4 py-3 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500"
      />

      <input 
        type="password" 
        name="Password" 
        placeholder="Password" 
        required 
        class="w-full border border-gray-300 px-4 py-3 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500"
      />

      <select 
        name="Role" 
        required 
        class="w-full border border-gray-300 px-4 py-3 rounded-md text-gray-600 focus:outline-none focus:ring-2 focus:ring-purple-500"
      >
        <option disabled selected>Select a role</option>
        <option value="Admin">Admin</option>
        <option value="Manager">Manager</option>
        <option value="User">User</option>
      </select>

      <div class="flex flex-col sm:flex-row justify-between gap-4 pt-4">
        <button 
          type="button" 
          class="w-full sm:w-auto bg-gray-300 text-gray-700 hover:bg-gray-400 transition px-6 py-2 rounded-md"
        >
          Cancel
        </button>
        <input 
          type="submit" 
          value="Submit" 
          class="w-full sm:w-auto bg-purple-600 text-white hover:bg-purple-700 transition px-6 py-2 rounded-md cursor-pointer"
        />
      </div>
    </form>
  </div>
</body>
</html>
