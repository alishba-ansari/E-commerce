<?php
include 'navbar.php';

$id = $_GET['id'];
$query = "SELECT * FROM orders WHERE Id=$id";
$result = $conn->query($query);
$row = $result->fetch_assoc();
?>
<?php include 'sidebar.php';?>

<div class="md:ml-72 mt-15">
     <h1 class="text-3xl text-purple-600 text-center font-medium py-10">Order Details</h1>

     <!-- Row 1 -->
      <div class="grid lg:grid-cols-2 max-sm:grid-cols-1 max-sm:mx-5 lg:gap-10 md:max-lg:gap-5 xl:mx-20 md:max-xl:mr-7 sm:max-lg:text-sm ">
          <div class="border border-gray-400 rounded-md py-6 px-5 mb-10 bg-white drop-shadow-lg">
               <h1 class="text-xl font-medium text-purple-600 pb-5">Invoice Details</h1>
               <p class="py-3"><strong>Invoice</strong>: INV-OS-0324</p>
               <p class="pb-3"><strong>Delivery Method</strong>: <?php echo $row['Delivery'];?></p>
               <p class="pb-3"><strong>Order Status</strong>: <span><?php echo $row['status'];?></span></p>
               <p class="pb-3"><strong>Date</strong>: <?php echo $row['date'];?></p>
          </div>

          <div class="border border-gray-400 rounded-md py-6 px-5 mb-10 bg-white drop-shadow-lg">
               <h1 class="text-xl font-medium text-purple-600 pb-5">Customer Details</h1>
               <p class="py-3"><strong>Name</strong>: <?php echo $row['FirstName'] . '   ' . $row['LastName'] ;?></p>
               <p class="pb-3"><strong>Email</strong>: <?php echo $row['Email'];?></p>
               <p class="pb-3"><strong>Phone</strong>: <?php echo $row['Phone']?></p>
          </div>
      </div>

      <!-- Row 2 -->
      <div class="grid lg:grid-cols-2 max-sm:grid-cols-1 max-sm:mx-5 lg:gap-10 md:max-lg:gap-5 xl:mx-20 md:max-xl:mr-7 sm:max-lg:text-sm ">
          <div class="border border-gray-400 rounded-md py-6 px-5 mb-10 bg-white drop-shadow-lg">
               <h1 class="text-xl font-medium text-purple-600 pb-5">Shipping Details</h1>
               <p class="py-3"><strong>Address</strong>: <?php echo $row['House'] . '   ' . $row['Apartment'];?></p>
          </div>

          <div class="border border-gray-400 rounded-md py-6 px-5 mb-10 bg-white drop-shadow-lg">
               <h1 class="text-xl font-medium text-purple-600 pb-5">Payment Details</h1>
               <p class="py-3"><strong>Payment Method</strong>: Card</p>
               <p class="pb-3"><strong>Payment Status</strong>: 
               <?php
                    $status = $row['status'];
                    $bgClass = '';

                    switch ($status) {
                    case 'Pending':
                         $bgClass = 'text-white bg-gradient-to-l from-purple-600 to-purple-400 px-5 py-3 rounded-lg';
                         break;
                    case 'In_Progress':
                         $bgClass = 'text-white bg-gradient-to-l from-yellow-500 to-yellow-300 px-5 py-3 rounded-lg';
                         break;
                    case 'Completed':
                         $bgClass = 'text-white bg-gradient-to-l from-green-600 to-green-400 px-5 py-3 rounded-lg';
                         break;
                    case 'Rejected':
                         $bgClass = 'text-white bg-gradient-to-l from-red-600 to-red-400 px-5 py-3 rounded-lg';
                         break;
                    }

                    ?>
               <p class="<?php echo $bgClass; ?>">
               <?php echo ucfirst(str_replace('_', ' ', $status)); ?>
               </p>

          </div>
      </div>

      <!-- Table -->
      <div class="xl:mx-20 border border-gray-400 rounded-md py-6 px-5 mb-10 bg-white drop-shadow-lg md:max-xl:mr-7 max-sm:mx-5">
    <h1 class="text-xl font-medium text-purple-600 pb-5">Ordered Items</h1>

    <div class="overflow-x-auto">
        <table class="w-full text-xs sm:text-sm">
            <thead>
                <tr>
                    <th class="py-3 font-medium border-b-2 border-gray-400 whitespace-nowrap">Product Id</th>
                    <th class="py-3 font-medium border-b-2 border-gray-400 whitespace-nowrap">Product Name</th>
                    <th class="py-3 font-medium border-b-2 border-gray-400 whitespace-nowrap">Price</th>
                    <th class="py-3 font-medium border-b-2 border-gray-400 whitespace-nowrap">Quantity</th>
                    <th class="py-3 font-medium border-b-2 border-gray-400 whitespace-nowrap">Item Total</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $orderItemsQuery = "SELECT * FROM order_items WHERE order_id = $id";
                $orderItemsResult = $conn->query($orderItemsQuery);

                if ($orderItemsResult->num_rows > 0) {
                    while ($orderItem = $orderItemsResult->fetch_assoc()) { ?>
                        <tr>
                            <td class="border-b-2 border-gray-400 py-5 text-center whitespace-nowrap"><?php echo $orderItem['product_id']; ?></td>
                            <td class="border-b-2 border-gray-400 py-5 text-center whitespace-nowrap"><?php echo $orderItem['product_name']; ?></td>
                            <td class="border-b-2 border-gray-400 py-5 text-center whitespace-nowrap">Rs/-<?php echo number_format($orderItem['price'], 2); ?></td>
                            <td class="border-b-2 border-gray-400 py-5 text-center whitespace-nowrap"><?php echo $orderItem['quantity']; ?></td>
                            <td class="border-b-2 border-gray-400 py-5 text-center whitespace-nowrap">Rs/-<?php echo number_format($orderItem['price'] * $orderItem['quantity'], 2); ?></td>
                        </tr>
                <?php }
                } else { ?>
                    <tr>
                        <td colspan="5" class="text-center py-5">No ordered items found.</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

       <!-- Row 3 -->

       <div class="xl:mx-20 md:max-xl:mr-7 max-sm:mx-5">
          <div class="border border-gray-400 rounded-md py-6 px-5 mb-10 bg-white drop-shadow-lg">
               <h1 class="text-xl font-medium text-purple-600 pb-5">Total Amount</h1>
               <p class="py-3"><strong>Subtotal</strong>: <?php echo $row['subtotal'];?></p>
               <p class="py-3"><strong>Shipping fee</strong>: </p>
               <p class="py-3"><strong>Total</strong>: <?php echo $row['total'];?></p>
          </div>
      </div>
     
</div>