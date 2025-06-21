<?php
include 'navbar.php';

$query = "SELECT * from orders";
$result = $conn->query($query);
?>

<?php 
include 'sidebar.php';
include 'dashboard.php';
?>

<div class="md:ml-70 md:mr-10 max-sm:mx-5 mt-25 text-sm mb-10">
    <h1 class="text-center text-purple-600 text-3xl mb-5 font-medium">Orders</h1>

    <div class="overflow-x-auto">
    <table class="min-w-full w-[1200px] drop-shadow-md">
        <thead>
            <tr class="bg-purple-600 text-white">
                <th class="py-2 font-medium border">Order ID</th>
                <th class="py-2 font-medium border">Customer</th>
                <th class="py-2 font-medium border">Quantity</th>
                <th class="py-2 font-medium border">Subtotal</th>
                <th class="py-2 font-medium border">Total</th>
                <th class="py-2 font-medium border">Order Status</th>
                <th class="py-2 font-medium border">View Details</th>
                <th class="py-2 font-medium border">Delete</th>
            </tr>
        </thead>
        <tbody class="bg-white">

        <?php while ($row = mysqli_fetch_assoc($result)) {    ?>

            <tr>
                <td class="border border-gray-200 py-2 text-center"><?php echo $row['Id']; ?></td>
                <td class="border border-gray-200 py-2 text-center"><?php echo $row['FirstName'] . '   ' . $row['LastName'] ;?></td>
                <td class="border border-gray-200 py-2 text-center"><?php echo $row['quantity']?></td>
                <td class="border border-gray-200 py-2 text-center"><?php echo $row['subtotal']?></td>
                <td class="border border-gray-200 py-2 text-center"><?php echo $row['total']?></td>
                <td class="border border-gray-200 py-2 text-center">
                <form action="update_order.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $row['Id']; ?>">
                    <select name="status" id="statusSelect<?php echo $row['Id']; ?>" class="px-3 py-2 rounded-md text-gray-700 bg-gray-100 border border-gray-300" onchange="changeSelectedOptionColor(this); this.form.submit();">
                        <option value="Pending" data-color="text-purple-600" <?php if ($row['status'] == 'ending') echo 'selected'; ?>>Pending</option>
                        <option value="In_Progress" data-color="text-yellow-600" <?php if ($row['status'] == 'In_Progress') echo 'selected'; ?>>In Progress</option>
                        <option value="Completed" data-color="text-green-600" <?php if ($row['status'] == 'Completed') echo 'selected'; ?>>Completed</option>
                        <option value="Rejected" data-color="text-red-600" <?php if ($row['status'] == 'Rejected') echo 'selected'; ?>>Rejected</option>
                    </select>
                </form>
                </td>
                <td class="border border-gray-200 py-2 text-center"><button class="bg-purple-500 hover:bg-purple-600 hover:drop-shadow-md transition px-3 py-2 rounded-full text-white hover:cursor-pointer"><a href="view_meta.php?id=<?php echo $row['Id']?>"><i class="bi bi-eye-fill"></i></a></button></td>
                <td class="border border-gray-200 py-2 text-center"><button class="bg-red-500 hover:bg-red-600 hover:drop-shadow-md transition px-3 py-2 rounded-full text-white hover:cursor-pointer"><a href="orderDel.php?id=<?php echo $row['Id']?>"><i class="bi bi-trash3-fill"></i></a></button></td>
            </tr>

            <?php } ?>

        </tbody>
    </table>
   </div>
</div>

<script>
    function changeSelectedOptionColor(selectElement) {
        selectElement.classList.remove("text-purple-600", "text-yellow-600", "text-green-600", "text-red-600");

        let selectedOption = selectElement.options[selectElement.selectedIndex];

        let colorClass = selectedOption.getAttribute("data-color");

        selectElement.classList.add(colorClass);
    }


    document.querySelectorAll('select').forEach(select => {
        changeSelectedOptionColor(select);
    });
</script>