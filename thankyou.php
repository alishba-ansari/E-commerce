<?php
include 'productnavbar.php';
include 'config.php';
include 'dashboard.php';

if (!isset($_SESSION['customer']) || !isset($_SESSION['last_order_id'])) {
    header('Location: customers_login.php');
    exit();
}

$order_id = $_SESSION['last_order_id'];

$order_stmt = $conn->prepare("SELECT * FROM orders WHERE id = ?");
$order_stmt->bind_param("i", $order_id);
$order_stmt->execute();
$order_result = $order_stmt->get_result();

if ($order_result->num_rows === 0) {
    echo "Order not found.";
    exit();
}

$order = $order_result->fetch_assoc();


$item_stmt = $conn->prepare("SELECT * FROM order_items WHERE order_id = ?");
$item_stmt->bind_param("i", $order_id);
$item_stmt->execute();
$items_result = $item_stmt->get_result();
?>

<div class="mt-25 mx-4 sm:mx-6 lg:mx-10">
    <div class="bg-white max-w-4xl mx-auto px-4 sm:px-8 py-6 sm:py-8 drop-shadow-xl rounded-sm">
        <h3 class="text-xl sm:text-2xl text-purple-600 font-medium">Thank you. Your order has been received.</h3>

        <!-- Invoice Number, Date, and Total -->
        <p class="text-base sm:text-xl pt-4 sm:pt-6">Invoice Number: <span class="text-purple-600 font-medium">INV-OS-3498</span></p>
        <p class="text-base sm:text-xl py-2">Date: <span class="text-purple-600 font-medium"><?php echo date('Y-m-d', strtotime($order['date'])); ?></span></p>
        <p class="text-base sm:text-xl pb-2">Total: <span class="text-purple-600 font-medium">Rs/-<?php echo number_format($order['total'], 2); ?></span></p>
        <p class="text-base sm:text-xl pb-2">Payment Method: <span class="text-purple-600 font-medium">Card</span></p>
        <p class="text-base sm:text-xl pb-2">Delivery Method: <span class="text-purple-600 font-medium"><?php echo $order['Delivery']; ?></span></p>
    </div>

    <div class="max-w-4xl mx-auto pt-8">
        <h1 class="text-purple-600 text-xl sm:text-2xl font-medium pb-4">ORDER DETAILS</h1>

        <div class="overflow-x-auto">
            <table class="w-full text-sm sm:text-base">
                <thead>
                    <tr class="border border-gray-400">
                        <th class="text-left px-4 sm:px-5 py-4 sm:py-5 border-r border-gray-400 font-medium">PRODUCT</th>
                        <th class="text-right px-4 sm:px-5 py-4 sm:py-5 font-medium">TOTAL</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($item = $items_result->fetch_assoc()): ?>
                        <?php echo "<pre>"; print_r($item); echo "</pre>"; ?>
                    <?php endwhile; ?>
                        <?php while ($item = $items_result->fetch_assoc()): ?>
                            <tr class="border border-gray-400">
                                <td class="text-left px-4 sm:px-5 py-4 sm:py-5 border-r border-gray-400 font-normal">
                                    <?php echo htmlspecialchars($item['product_name']); ?> 
                                    <span class="font-bold text-purple-600">x <?php echo (int)$item['quantity']; ?></span>
                                </td>
                                <td class="text-right px-4 sm:px-5 py-4 sm:py-5 font-normal">
                                    Rs/- <?php echo number_format((float)$item['total_price'], 2); ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>

                    
                    <!-- Subtotal, Shipping, and Total -->
                    <tr class="border border-gray-400">
                        <td class="text-left px-4 sm:px-5 py-4 sm:py-5 border-r border-gray-400 font-medium">Subtotal:</td>
                        <td class="text-right px-4 sm:px-5 py-4 sm:py-5 font-medium">Rs/- <?php echo number_format($order['subtotal'], 2); ?></td>
                    </tr>
                    <tr class="border border-gray-400">
                        <td class="text-left px-4 sm:px-5 py-4 sm:py-5 border-r border-gray-400 font-medium">Total:</td>
                        <td class="text-right px-4 sm:px-5 py-4 sm:py-5 font-medium text-purple-600">Rs/- <?php echo number_format($order['total'], 2); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
include 'footer.php';
?>
