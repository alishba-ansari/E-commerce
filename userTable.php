<?php
include 'navbar.php';
include 'sidebar.php';
include 'insert.php';
 $query = "select * from users ";
 $result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Document</title>
</head>
<body> 
<div class="mt-16 ml-0 md:ml-70 px-4 mb-10">
    <div class="text-center">
        <h1 class="text-2xl font-bold text-purple-500 mt-25">Welcome to User Table!</h1>

        <!-- Fixing the button layout -->
        <div class="my-6 flex justify-center">
            <a href="addUser.php" class="bg-purple-600 hover:bg-purple-700 text-white font-semibold px-4 py-2 rounded-lg transition-all">
                Add a User
            </a>
        </div>

        <!-- Responsive Table -->
        <div class="overflow-x-auto w-full">
            <table class="min-w-max w-full bg-white border-2 border-gray-300 text-sm text-center">
                <thead>
                    <tr class="bg-purple-700 text-white font-normal">
                        <th class="border border-gray-300 px-5 py-2">Id</th>
                        <th class="border border-gray-300 px-5 py-2">Name</th>
                        <th class="border border-gray-300 px-5 py-2">Email</th>
                        <th class="border border-gray-300 px-5 py-2">Password</th>
                        <th class="border border-gray-300 px-5 py-2">Role</th>
                        <th class="border border-gray-300 px-5 py-2">Edit</th>
                        <th class="border border-gray-300 px-5 py-2">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td class="border border-gray-300 px-5 py-2"><?php echo $row['Id']; ?></td>
                        <td class="border border-gray-300 px-5 py-2"><?php echo $row['Username']; ?></td>
                        <td class="border border-gray-300 px-5 py-2"><?php echo $row['Email']; ?></td>
                        <td class="border border-gray-300 px-5 py-2"><?php echo $row['Password']; ?></td>
                        <td class="border border-gray-300 px-5 py-2"><?php echo $row['Role']; ?></td>
                        <td class="border border-gray-300 px-5 py-2">
                            <a href="userEditing.php?id=<?php echo $row['Id']; ?>" class="bg-purple-600 hover:bg-purple-700 text-white font-medium px-4 py-1 rounded-lg transition">
                                Edit
                            </a>
                        </td>
                        <td class="border border-gray-300 px-5 py-2">
                            <a href="delete.php?id=<?php echo $row['Id']; ?>" class="bg-red-500 hover:bg-red-600 text-white font-medium px-4 py-1 rounded-lg transition">
                                Delete
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>