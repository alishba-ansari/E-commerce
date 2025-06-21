<?php
 include 'header.php';
 include 'inserting.php';
 ?>
 


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <title>Document</title>
</head>
<body class="bg-gray-200 grid justify-center">
    <div class="lg:ml-130 w-lg h-auto p-10 bg-white my-30 drop-shadow-lg">
    <h1 class="text-3xl text-purple-600 font-bold ">Purple</h1>
    <h3 class="text-xl font-semibold text-slate-900 py-5 underline">Customers Login</h3>
    <!-- Name -->

     <form action="inserting.php" method="post">
      <input type="text" name="FirstName" class="border border-gray-200 py-3 px-8 w-full focus:outline-none focus:ring-0 focus:border-purple-600 " placeholder="First Name">
      <input type="text" name="LastName" class="border border-gray-200 py-3 px-8 w-full my-6 focus:outline-none focus:ring-0 focus:border-purple-600" placeholder="Last Name">
      <input type="text" name="FathersName" class="border border-gray-200 py-3 px-8 w-full mb-6 focus:outline-none focus:ring-0 focus:border-purple-600" placeholder="Father's Name">
      <input type="text" name="PhoneNumber" class="border border-gray-200 py-3 px-8 w-full mb-6 focus:outline-none focus:ring-0 focus:border-purple-600" placeholder="Phone Number">

    <!-- Name -->

    <!-- Caste -->
      <select name="Caste" class="border border-gray-200 py-3 px-8 w-full mb-6 text-gray-500 focus:outline-none focus:ring-0 focus:border-purple-600">
       <option selected class="text-gray-500 ">Caste</option>
         <option value="Arain">Arain</option>
         <option value="Sheikh">Sheikh</option>
         <option value="Makhdoom">Makhdoom</option>
         <option value="Rajpoot">Rajpoot</option>
         <option value="Mughal">Mughal</option>
         <option value="Rana">Rana</option>
         <option value="Others">Others</option>
      </select>
    <!-- Caste  -->

     <input type="text" name="RegDate" class="border border-gray-200 py-3 px-8 w-full mb-6 focus:outline-none focus:ring-0 focus:border-purple-600" placeholder="Registration Date">

     <!-- Province -->
     <select name="Province" class="border border-gray-200 py-3 px-8 w-full mb-6 text-gray-500 focus:outline-none focus:ring-0 focus:border-purple-600">
        <option selected class="text-gray-500">Province</option>
        <option value="Punjab">Punjab</option>
        <option value="Sindh">Sindh</option>
        <option value="KPK">KPK</option>
        <option value="Gilgit Baltistan">Gilgit Baltistan</option>
        <option value="Azad Kashmir">Azad Kashmir</option>
     </select>
     <!-- Province -->
 
     <!-- Gender -->
      <div class="flex gap-2 mb-6">
        <input type="radio" name="Gender" value="Male" class="accent-purple-600 border-2 border-gray-400 rounded-sm py-4 px-5 scale-130 ocus:outline-none focus:ring-0 focus:border-purple-600 ">
        <label for="Female"> Male</label>

        <input type="radio" name="Gender" value="Female" class="ml-18 accent-purple-600 border-2 border-gray-400 rounded-sm py-4 px-5 scale-130 ocus:outline-none focus:ring-0 focus:border-purple-600 ">
        <label for="Female"> Female</label>

        <input type="radio" name="Gender" value="Others" class="ml-18 accent-purple-600 border-2 border-gray-400 rounded-sm py-4 px-5 scale-130 ocus:outline-none focus:ring-0 focus:border-purple-600 ">
        <label for="Others"> Others</label>
      </div>
     <!-- Gender  -->

     <!-- Education -->
      <div class="flex gap-8 mb-6">
         <div>
            <input type="checkbox" name="Studies[]" value="Matric" class="accent-purple-600 border-2 border-gray-400 rounded-sm py-4 px-5 scale-130 ocus:outline-none focus:ring-0 focus:border-purple-600 ">
               <label>Matric</label></label>
          </div>

          <div>
            <input type="checkbox" name="Studies[]" value="Intermediate" class="accent-purple-600 border-2 border-gray-400 rounded-sm py-4 px-5 scale-130 ocus:outline-none focus:ring-0 focus:border-purple-600 ">
               <label>Intermediate</label></label>
          </div>

          <div>
            <input type="checkbox" name="Studies[]" value="Graduate" class="accent-purple-600 border-2 border-gray-400 rounded-sm py-4 px-5 scale-130 ocus:outline-none focus:ring-0 focus:border-purple-600 ">
               <label>Graduate</label></label>
          </div>
      </div>

      <div class="flex gap-8 mb-6">
         <div>
            <input type="checkbox" name="Studies[]" value="Masters" class="accent-purple-600 border-2 border-gray-400 rounded-sm py-4 px-5 scale-130 ocus:outline-none focus:ring-0 focus:border-purple-600 ">
               <label>Masters</label></label>
          </div>

          <div>
            <input type="checkbox" name="Studies[]" value="Phd" class="accent-purple-600 border-2 border-gray-400 rounded-sm py-4 px-5 scale-130 ocus:outline-none focus:ring-0 focus:border-purple-600 ">
               <label>Phd</label></label>
          </div>
      </div>
     <!-- Education -->
        <div class="flex justify-between my-6">
            <button type="button" class="rounded-lg bg-red-500 hover:bg-red-600 transition py-2 px-8 text-white hover:cursor-pointer ">Cancel</button>
            <button type="submit" class="rounded-lg bg-purple-600 hover:bg-purple-700 transition py-2 px-8 text-white hover:cursor-pointer ">Submit</button>
        </div>
    </div>
    </form>
</body>
</html>