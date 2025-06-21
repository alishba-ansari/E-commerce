<?php
include 'navbar.php';

$brandQuery = "select * from brand"; 
$brandResult = $conn->query($brandQuery) ;
?>
<?php include 'sidebar.php';?>

<div class="md:ml-75 md:mr-10 mx-auto px-4 py-6 mt-15">
    <div class="text-center mb-6">
        <h1 class="text-3xl md:text-4xl font-medium text-purple-600">Brand</h1>
        <a href="addBrand.php">
            <button class="mt-4 bg-purple-600 hover:bg-purple-700 hover:cursor-pointer text-white px-6 md:px-7 py-2 font-semibold rounded-lg transition">
                Add Brand
            </button>
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300 text-sm text-center mb-8">
            <thead>
                <tr class="bg-purple-700 text-white font-normal">
                    <th class="border px-4 md:px-8 py-2">Name</th>
                    <th class="border px-4 md:px-8 py-2">Description</th>
                    <th class="border px-4 md:px-8 py-2">Edit</th>
                    <th class="border px-4 md:px-8 py-2">Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($brandResult)) { ?>
                    <tr>
                        <td class="border border-gray-200 px-4 md:px-8 py-2"><?php echo $row['Brand']; ?></td>
                        <td class="border border-gray-200 px-4 md:px-8 py-2"><?php echo $row['Description']; ?></td>
                        <td class="border border-gray-200 px-4 md:px-8 py-2">
                            <a href="brandEdit.php?id=<?php echo $row['Id']; ?>">
                                <button class="bg-purple-600 hover:bg-purple-700 text-white px-4 md:px-8 py-1 rounded-lg font-medium transition hover:cursor-pointer">
                                    Edit
                                </button>
                            </a>
                        </td>
                        <td class="border border-gray-200 px-4 md:px-8 py-2">
                            <a href="brandDelete.php?id=<?php echo $row['Id']; ?>">
                                <button class="bg-red-500 hover:bg-red-600 text-white px-4 md:px-8 py-1 rounded-lg font-medium transition hover:cursor-pointer">
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
