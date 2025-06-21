<?php
include 'navbar.php';

  $FirstName = $LastName = $FathersName = $PhoneNumber = $Caste = $RegDate = $Province = $Gender = "";
  $Studies = [];

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
       $FirstName = $_POST['FirstName'] ?? '';
       $LastName = $_POST['LastName'] ?? '';
       $FathersName = $_POST['FathersName'] ?? '';
       $PhoneNumber = $_POST['PhoneNumber'] ?? '';
       $Caste = $_POST['Caste'] ?? '';
       $RegDate = $_POST['RegDate'] ?? '';
       $Province = $_POST['Province'] ?? '';
       $Gender = $_POST['Gender'] ?? '';
       $Studies = $_POST['Studies'] ?? '';
    
       $Study = implode(", ", $Studies);


       $stmt =  $conn->prepare("INSERT INTO customers (FirstName, LastName, FathersName, PhoneNumber , Caste, RegDate, Province, Gender, Studies) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

       $stmt->bind_param("sssssssss" , $FirstName, $LastName, $FathersName, $PhoneNumber, $Caste , $RegDate, $Province, $Gender, $Study );

       if ($stmt->execute()) {
           header('location: customerTable.php');
       } 
       else {
          echo "Error" . $stmt->error;
       }
  }
 ?>
<?php
include 'sidebar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
  <title>Document</title>
</head>
<body class="bg-gray-200 ">
  <div class="lg:ml-80 lg:w-2xl max-lg:w-md max-lg:ml-70 max-sm:mx-5 max-sm:w-auto h-full sm:p-10 max-sm:p-6 bg-white mt-24 drop-shadow-lg">
    <h1 class="text-3xl text-purple-600 font-bold pb-2">Purple</h1>
    <h3 class="text-xl font-semibold text-slate-900 mb-6">Add a customer.</h3>

    <form method="post">
      <!-- Name -->
      <div class="flex flex-col md:flex-row sm:gap-4 max-sm:gap-2">
        <input type="text" name="FirstName" value="<?php echo $FirstName; ?>" class="border border-gray-200 py-2 px-4 w-full sm:my-2 max-sm:my-0" placeholder="First Name" />
        <input type="text" name="LastName" value="<?php echo $LastName; ?>" class="border border-gray-200 py-2 px-4 w-full sm:my-2 max-sm:my-2" placeholder="Last Name" />
      </div>

      <div class="flex flex-col md:flex-row sm:gap-4 max-sm:gap-2">
        <input type="text" name="FathersName" value="<?php echo $FathersName; ?>" class="border border-gray-200 py-2 px-4 w-full my-2" placeholder="Father's Name" />
        <input type="text" name="PhoneNumber" value="<?php echo $PhoneNumber; ?>" class="border border-gray-200 py-2 px-4 w-full sm:my-2 max-sm:my-0" placeholder="Phone Number" />
      </div>

      <!-- Caste and Province -->
      <div class="flex flex-col md:flex-row sm:gap-4 max-sm:gap-2">
        <select name="Caste" class="border border-gray-200 py-2 px-4 w-full my-2 text-gray-500">
          <option selected disabled>Caste</option>
          <option value="Arain">Arain</option>
          <option value="Sheikh">Sheikh</option>
          <option value="Makhdoom">Makhdoom</option>
          <option value="Rajpoot">Rajpoot</option>
          <option value="Mughal">Mughal</option>
          <option value="Rana">Rana</option>
          <option value="Others">Others</option>
        </select>

        <select name="Province" class="border border-gray-200 py-2 px-4 w-full sm:my-2 max-sm:my-0 text-gray-500">
          <option selected disabled>Province</option>
          <option value="Punjab">Punjab</option>
          <option value="Sindh">Sindh</option>
          <option value="KPK">KPK</option>
          <option value="Gilgit Baltistan">Gilgit Baltistan</option>
          <option value="Azad Kashmir">Azad Kashmir</option>
        </select>
      </div>

      <!-- Registration Date -->
      <input type="text" name="RegDate" class="border border-gray-200 py-2 px-4 w-full my-4" placeholder="Registration Date" />

      <!-- Gender -->
      <div class="flex flex-col sm:flex-row gap-4 my-4">
        <label class="flex items-center gap-2">
          <input type="radio" name="Gender" value="Male" class="accent-purple-600" /> Male
        </label>
        <label class="flex items-center gap-2">
          <input type="radio" name="Gender" value="Female" class="accent-purple-600" /> Female
        </label>
        <label class="flex items-center gap-2">
          <input type="radio" name="Gender" value="Others" class="accent-purple-600" /> Others
        </label>
      </div>

      <!-- Education -->
      <div class="flex flex-wrap gap-4 mb-6">
        <label class="flex items-center gap-2">
          <input type="checkbox" name="Studies[]" value="Matric" class="accent-purple-600" /> Matric
        </label>
        <label class="flex items-center gap-2">
          <input type="checkbox" name="Studies[]" value="Intermediate" class="accent-purple-600" /> Intermediate
        </label>
        <label class="flex items-center gap-2">
          <input type="checkbox" name="Studies[]" value="Graduate" class="accent-purple-600" /> Graduate
        </label>
        <label class="flex items-center gap-2">
          <input type="checkbox" name="Studies[]" value="Masters" class="accent-purple-600" /> Masters
        </label>
        <label class="flex items-center gap-2">
          <input type="checkbox" name="Studies[]" value="Phd" class="accent-purple-600" /> PhD
        </label>
      </div>

      <!-- Buttons -->
      <div class="flex flex-col sm:flex-row justify-between gap-4">
        <a href="customerTable.php" class="text-center rounded-lg bg-purple-600 hover:bg-purple-700 transition py-2 px-8 text-white">Cancel</a>
        <button type="submit" class="rounded-lg bg-purple-600 hover:bg-purple-700 transition py-2 px-8 text-white">Submit</button>
      </div>
    </form>
  </div>
</body>
</html>