<?php
include 'navbar.php';

$id = $_GET['id'];
$query = "SELECT * From users where Id=$id";
$result = $conn->query($query);
$row = $result->fetch_assoc();
?>
<?php
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
        <h1 class="text-3xl text-purple-600 font-bold pb-6">Purple</h1>
        <h3 class="text-xl text-purple-600 font-semibold pb-6">Edit the user!</h3>
        
        <form method="post" action="userUpdating.php?id=<?php echo $row['Id']; ?>">

        <input type="hidden" name="id" value="<?php echo $row['Id']; ?>"> 

           <input type="text" name="Username" value="<?php echo $row['Username']; ?>"  placeholder="Username" class="w-full border border-gray-300 px-4 py-4">
           <input type="email" name="Email" value="<?php echo $row['Email']; ?>" placeholder="Email" class="w-full border border-gray-300 px-4 py-4 my-6">
           <select name="Role" class="w-full border border-gray-300 px-4 py-4 text-gray-500">
                <option selected class="text-gray-500">Select a role</option>
                <option value="Admin" <?php echo ($row['Role'] === 'Admin') ? 'selected' : ''; ?> class="text-gray-500">Admin</option>
                <option value="Manager" <?php echo ($row['Role'] === 'Manager') ? 'selected' : ''; ?> class="text-gray-500">Manager</option>
                <option value="User" <?php echo ($row['Role'] === 'User') ? 'selected' : ''; ?> class="text-gray-500">User</option>
            </select>
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