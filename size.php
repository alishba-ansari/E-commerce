<?php
include 'navbar.php';

$SizeQuery = "select * from size"; 
$SizeResult = $conn->query($SizeQuery) ;
?>

<?php include 'sidebar.php';?>

<div class="md:ml-70 md:mr-10 mt-15 mx-auto px-4 py-6 text-sm">
    <div class="text-center mb-6">
        <h1 class="text-3xl md:text-4xl font-medium text-purple-600">Size and Color</h1>
        <a href="addSize.php">
            <button class="hover:cursor-pointer mt-4 bg-purple-600 hover:bg-purple-700 text-white px-6 md:px-7 py-2 font-semibold rounded-lg transition">
                Add Size & Color
            </button>
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300 text-center mb-8">
            <thead>
                <tr class="bg-purple-700 text-white font-normal">
                    <th class="border px-4 md:px-8 py-2">Size</th>
                    <th class="border px-4 md:px-8 py-2">Color</th>
                    <th class="border px-4 md:px-8 py-2">Description</th>
                    <th class="border px-4 md:px-8 py-2">Edit</th>
                    <th class="border px-4 md:px-8 py-2">Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($SizeResult)) { ?>
                    <tr>
                        <td class="border border-gray-200 px-4 md:px-8 py-2"><?php echo $row['Size']; ?></td>
                        <td class="border border-gray-200 px-4 md:px-8 py-2"><?php echo $row['Color']; ?></td>
                        <td class="border border-gray-200 px-4 md:px-8 py-2"><?php echo $row['Description']; ?></td>
                        <td class="border border-gray-200 px-4 md:px-8 py-2">
                            <a href="sizeEdit.php?id=<?php echo $row['Id']; ?>">
                                <button class="hover:cursor-pointer bg-purple-600 hover:bg-purple-700 text-white px-4 md:px-8 py-1 rounded-lg font-medium transition">
                                    Edit
                                </button>
                            </a>
                        </td>
                        <td class="border border-gray-200 px-4 md:px-8 py-2">
                            <a href="sizeDelete.php?id=<?php echo $row['Id']; ?>">
                                <button class="hover:cursor-pointer bg-red-500 hover:bg-red-600 text-white px-4 md:px-8 py-1 rounded-lg font-medium transition">
                                    Delete
                                </button>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
