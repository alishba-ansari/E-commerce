<?php
include 'navbar.php';
 $Username = $Email = $Password = $Role = "";

 if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Username = $_POST['Username'] ?? '';
    $Email = $_POST['Email'] ?? '';
    $Password = $_POST['Password'] ?? '';
    $Role = $_POST['Role'] ?? '';

    $stmt = $conn->prepare("INSERT INTO users (Username, Email , Password , Role) VALUES ( ?, ? , ? , ?) ");
    $stmt->bind_param("ssss" , $Username, $Email , $Password, $Role);

    if ($stmt->execute()) {
        header('Location: userTable.php');
        exit;
    } 
    else {
        echo "Error:" . $stmt->error;
    }
 }
?>
<?php
include 'dashboard.php';
include 'sidebar.php';
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
  <div class="lg:ml-80 lg:w-2xl max-lg:w-md max-lg:ml-70 max-sm:mx-5 max-sm:w-auto h-full p-10 bg-white mt-24 drop-shadow-lg">
    <h1 class="text-3xl text-purple-600 font-bold pb-2">Purple</h1>
    <h3 class="text-xl font-semibold text-slate-900">Add a user!</h3>

    <form method="post">
      <!-- Username and Email -->
      <div class="flex flex-col lg:flex-row lg:gap-6">
        <input type="text" name="Username" value="<?php echo $Username; ?>" placeholder="Username"
          class="w-full border border-gray-300 px-4 py-2 my-4"/>
        <input type="email" name="Email" placeholder="Email" value="<?php echo $Email; ?>"
          class="w-full border border-gray-300 px-4 py-2 lg:my-4" />
      </div>

      <!-- Password and Role -->
      <div class="flex flex-col lg:flex-row lg:gap-6">
        <input type="password" name="Password" placeholder="Password" value="<?php echo $Password; ?>"
          class="w-full border border-gray-300 px-4 py-2 my-4" />
        <select name="Role" class="w-full border border-gray-300 px-4 py-2 text-gray-500 lg:my-4">
          <option selected disabled>Select a role</option>
          <option value="Admin">Admin</option>
          <option value="Manager">Manager</option>
          <option value="User">User</option>
        </select>
      </div>

      <!-- Buttons -->
      <div class="flex justify-between flex-col sm:flex-row gap-4 mt-6">
        <a href="userTable.php"
          class="text-center rounded-lg bg-purple-600 hover:bg-purple-700 transition py-2 px-8 text-white">Cancel</a>
        <input type="submit"
          class="rounded-lg bg-purple-600 hover:bg-purple-700 transition py-2 px-8 text-white cursor-pointer" />
      </div>
    </form>
  </div>
</body>
</html>