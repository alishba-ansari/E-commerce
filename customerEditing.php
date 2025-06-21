<?php
include 'navbar.php';

 $id = $_GET['id'];
 $query = "SELECT * From customers WHERE Id=$id";
 $result = $conn->query($query);
 $row = $result->fetch_assoc();
 $selectedStudy = explode(",", $row['Studies']);
 ?>
<?php include 'sidebar.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <title>Document</title>
</head>
<body class="bg-gray-200">
  <div class="lg:ml-80 lg:w-2xl max-lg:w-md max-lg:ml-70 max-sm:mx-5 max-sm:w-auto h-full p-10 bg-white mt-24 drop-shadow-lg">
    <h1 class="text-3xl text-purple-600 font-bold pb-2">Purple</h1>
    <h3 class="text-xl font-semibold text-slate-900 mb-6">Customer Editing</h3>

    <form action="customerUpdating.php?id=<?php echo $row['Id']; ?>" method="post">
      <input type="hidden" name="id" value="<?php echo $row['Id']; ?>">

      <!-- Name -->
      <div class="flex flex-col md:flex-row gap-3">
        <input type="text" name="FirstName" value="<?php echo $row['FirstName']; ?>" class="border border-gray-200 py-2 px-4 w-full" placeholder="First Name" />
        <input type="text" name="LastName" value="<?php echo $row['LastName']; ?>" class="border border-gray-200 py-2 px-4 w-full mb-3" placeholder="Last Name" />
      </div>

      <div class="flex flex-col md:flex-row gap-3">
        <input type="text" name="FathersName" value="<?php echo $row['FathersName']; ?>" class="border border-gray-200 py-2 px-4 w-full" placeholder="Father's Name" />
        <input type="text" name="PhoneNumber" value="<?php echo $row['PhoneNumber']; ?>" class="border border-gray-200 py-2 px-4 w-full mb-3" placeholder="Phone Number" />
      </div>

      <!-- Caste and Province -->
      <div class="flex flex-col md:flex-row gap-3">
        <select name="Caste" class="border border-gray-200 py-2 px-4 w-full  text-gray-500">
          <option disabled>Caste</option>
          <?php
          $castes = ["Arain", "Sheikh", "Makhdoom", "Rajpoot", "Mughal", "Rana", "Others"];
          foreach ($castes as $caste) {
              $selected = ($row['Caste'] === $caste) ? 'selected' : '';
              echo "<option value='$caste' $selected>$caste</option>";
          }
          ?>
        </select>

        <select name="Province" class="border border-gray-200 py-2 px-4 w-full mb-2 text-gray-500">
          <option disabled>Province</option>
          <?php
          $provinces = ["Punjab", "Sindh", "KPK", "Gilgit Baltistan", "Azad Kashmir"];
          foreach ($provinces as $province) {
              $selected = ($row['Province'] === $province) ? 'selected' : '';
              echo "<option value='$province' $selected>$province</option>";
          }
          ?>
        </select>
      </div>

      <!-- Registration Date -->
      <input type="text" name="RegDate" value="<?php echo $row['RegDate']; ?>" class="border border-gray-200 py-2 px-4 w-full my-2" placeholder="Registration Date" />

      <!-- Gender -->
      <div class="flex flex-col sm:flex-row gap-4 my-4">
        <?php
        $genders = ["Male", "Female", "Others"];
        foreach ($genders as $gender) {
            $checked = ($row['Gender'] === $gender) ? 'checked' : '';
            echo "<label class='flex items-center gap-2'><input type='radio' name='Gender' value='$gender' $checked class='accent-purple-600' /> $gender</label>";
        }
        ?>
      </div>

      <!-- Education -->
      <div class="flex flex-wrap gap-4 mb-6">
        <?php
        $educations = ["Matric", "Intermediate", "Graduate", "Masters", "Phd"];
        foreach ($educations as $edu) {
            $checked = in_array($edu, $selectedStudy) ? 'checked' : '';
            echo "<label class='flex items-center gap-2'><input type='checkbox' name='Studies[]' value='$edu' $checked class='accent-purple-600' /> $edu</label>";
        }
        ?>
      </div>

      <!-- Buttons -->
      <div class="flex flex-col sm:flex-row justify-between gap-4">
        <a href="customerTable.php" class="text-center rounded-lg bg-purple-600 hover:bg-purple-700 transition py-2 px-8 text-white">Cancel</a>
        <button type="submit" class="rounded-lg bg-purple-600 hover:bg-purple-700 transition py-2 px-8 text-white">Submit</button>
      </div>
    </form>
  </div>
</body>
