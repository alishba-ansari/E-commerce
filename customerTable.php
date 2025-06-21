<?php
 include 'navbar.php';
 include 'inserting.php';
 $query = "select * from customers";
 $result = $conn->query($query);
?>

<?php include 'sidebar.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
  <title>Customer Table</title>
</head>
<body class="bg-gray-50 ">

  <div class="mt-18 md:ml-69 md:mr-5 max-sm:mx-5 py-10">
    <h1 class="text-purple-600 text-3xl font-bold text-center">Welcome to Customers Table!</h1>

    <div class="text-center mt-6 mb-8">
      <a href="addCustomer.php" class="bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 px-6 rounded-lg inline-block transition">Add a Customer</a>
    </div>

    <!-- Responsive Table Wrapper with Always-Visible Scrollbar -->
<div class="overflow-x-scroll bg-white rounded-lg shadow-md w-full">
  <table class="w-max text-center border-collapse">
    <thead>
      <tr class="bg-purple-700 text-white text-sm">
        <th class="border px-3 py-2">Id</th>
        <th class="border px-3 py-2">First Name</th>
        <th class="border px-3 py-2">Last Name</th>
        <th class="border px-3 py-2">Father's Name</th>
        <th class="border px-3 py-2">Phone Number</th>
        <th class="border px-3 py-2">Caste</th>
        <th class="border px-3 py-2">Registration Date</th>
        <th class="border px-3 py-2">Province</th>
        <th class="border px-3 py-2">Gender</th>
        <th class="border px-3 py-2">Studies</th>
        <th class="border px-3 py-2">Edit</th>
        <th class="border px-3 py-2">Delete</th>
      </tr>
    </thead>
    <tbody class="text-sm">
      <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr class="border border-gray-300">
          <td class="border border-gray-300 px-3 py-2"><?php echo $row['Id']; ?></td>
          <td class="border border-gray-300 px-3 py-2"><?php echo $row['FirstName']; ?></td>
          <td class="border border-gray-300 px-3 py-2"><?php echo $row['LastName']; ?></td>
          <td class="border border-gray-300 px-3 py-2"><?php echo $row['FathersName']; ?></td>
          <td class="border border-gray-300 px-3 py-2"><?php echo $row['PhoneNumber']; ?></td>
          <td class="border border-gray-300 px-3 py-2"><?php echo $row['Caste']; ?></td>
          <td class="border border-gray-300 px-3 py-2"><?php echo $row['RegDate']; ?></td>
          <td class="border border-gray-300 px-3 py-2"><?php echo $row['Province']; ?></td>
          <td class="border border-gray-300 px-3 py-2"><?php echo $row['Gender']; ?></td>
          <td class="border border-gray-300 px-3 py-2"><?php echo $row['Studies']; ?></td>
          <td class="border border-gray-300 px-3 py-2">
            <a href="customerEditing.php?id=<?php echo $row['Id']; ?>" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-1 rounded transition">Edit</a>
          </td>
          <td class="border border-gray-300 px-3 py-2">
            <a href="deleting.php?id=<?php echo $row['Id']; ?>" class="bg-red-500 hover:bg-red-600 text-white px-4 py-1 rounded transition">Delete</a>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

  </div>

</body>
</html>
