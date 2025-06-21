<?php 
include 'config.php';
include 'productnavbar.php';
include 'dashboard.php';

function cleanPrice($price) {
    
    $price = preg_replace('/[^0-9.]/', '', $price);
    return floatval($price);
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
    // Updating the Cart

    if (isset($_POST['update_cart'])) {
        foreach ($_POST['quantity'] as $product_id => $quantity) {
            if ($quantity > 0) {
                $_SESSION['cart'][$product_id]['quantity'] = intval($quantity);
            } else {
                unset($_SESSION['cart'][$product_id]);
            }
        }
        $_SESSION['message'] = "Cart updated successfully!";
    }

    // Removing Items from the Cart

    if (isset($_POST['remove_item'])) {
        $product_id = $_POST['remove_item'];
        unset($_SESSION['cart'][$product_id]);
        $_SESSION['message'] = "Item removed from cart!";
    }

    // Clearing Cart

    if (isset($_POST['clear_cart'])) {
        $_SESSION['cart'] = [];
        $_SESSION['message'] = "Cart cleared!";
    }
    
    header("Location: Cart.php");
    exit();
}

// Calculating Total

$cart_total = 0;
foreach ($_SESSION['cart'] as $product_id => $item) {

    if (is_array($item) && isset($item['price']) && isset($item['quantity'])) {
        $price = cleanPrice($item['price']);
        $quantity = intval($item['quantity']);
        $cart_total += $price * $quantity;
    } else {
    
        unset($_SESSION['cart'][$product_id]);

        if (!isset($_SESSION['message'])) {
            $_SESSION['message'] = "An invalid item was found and removed from your cart.";
        }
    }
}
?>

<div class="xl:mx-20 md:max-xl:mx-10 max-sm:mx-5 mt-30 mb-78.5">
    <h1 class="text-2xl text-center text-purple-600 mb-10 font-medium">Your Shopping Cart</h1>
    
    <?php if (isset($_SESSION['message'])): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-5" role="alert">
            <span class="block sm:inline"><?php echo $_SESSION['message']; ?></span>
        </div>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>
    
    <?php if (empty($_SESSION['cart'])): ?>
        <div class="text-center py-10 bg-gray-50 rounded-lg mb-30 text-sm">
            <p class="text-2xl mb-5">Your cart is empty</p>
            <a href="index.php" class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">
                Continue Shopping
            </a>
        </div>
    <?php else: ?>
        <form method="post">
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white rounded-lg overflow-hidden text-sm">
                    <thead class="bg-purple-600 text-white">
                        <tr>
                            <th class="py-3 px-4 text-left">Product</th>
                            <th class="py-3 px-4 text-left">Name</th>
                            <th class="py-3 px-4 text-left">Price</th>
                            <th class="py-3 px-4 text-left">Quantity</th>
                            <th class="py-3 px-4 text-left">Subtotal</th>
                            <th class="py-3 px-4 text-left">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($_SESSION['cart'] as $product_id => $item): ?>
                            <?php if (is_array($item) && isset($item['price']) && isset($item['quantity'])): ?>
                            <tr class="border-b border-gray-600">
                                <td class="py-5 px-4">
                                    <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>" class="w-20 h-20 object-cover">
                                </td>
                                <td class="py-5 px-4">
                                    <div class="font-medium"><?php echo $item['name']; ?></div>
                                    <?php if (isset($item['description'])): ?>
                                        <div class="text-sm text-gray-500"><?php echo $item['description']; ?></div>
                                    <?php endif; ?>
                                </td>
                                <td class="py-5 px-4 text-purple-600 font-medium">
                                    <?php echo $item['price']; ?>
                                </td>
                                <td class="py-5 px-4 ">
                                    <div class="flex items-center gap-4">
                                        <button type="button" class="decrement bg-gray-200 hover:bg-purple-500 hover:cursor-pointer transition hover:text-white px-4 py-2 rounded-full" data-product-id="<?php echo $product_id; ?>">-</button>
                                        <input type="text" name="quantity[<?php echo $product_id; ?>]" value="<?php echo $item['quantity']; ?>" min="1" class="w-16 px-2 py-1 border rounded-sm text-center quantity-input" data-product-id="<?php echo $product_id; ?>">
                                        <button type="button" class="increment bg-gray-200 hover:bg-purple-500 hover:cursor-pointer transition hover:text-white px-4 py-2 rounded-full" data-product-id="<?php echo $product_id; ?>">+</button>
                                    </div>
                                </td>
                                <td class="py-5 px-4 font-medium">
                                    <?php echo 'Rs/-' . number_format(cleanPrice($item['price']) * $item['quantity'], 2); ?>
                                </td>
                                <td class="py-5 px-4">
                                    <button type="submit" name="remove_item" value="<?php echo $product_id; ?>" class="text-red-500 hover:text-red-600 text-lg transition hover:cursor-pointer">
                                        <i class="bi bi-trash"></i> Remove
                                    </button>
                                </td>
                            </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <tr class="bg-gray-50">
                            <td colspan="4" class="py-3 px-4 text-right font-bold">Total:</td>
                            <td class="py-3 px-4 text-purple-600 font-bold"><?php echo 'Rs/-' . number_format($cart_total, 2); ?></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row sm:justify-between mt-6 gap-4">
                <button type="submit" name="update_cart" class="bg-purple-600 hover:bg-purple-700 transition text-white py-2 px-6 rounded-md">
                    Update Cart
                </button>
                <div class="flex flex-col sm:flex-row gap-4 sm:gap-2">
                    <a href="checkout.php" class="bg-purple-600 hover:bg-purple-700 transition text-white py-2 px-6 rounded-md text-center">
                        Checkout
                    </a>
                    <button type="submit" name="clear_cart" class="bg-red-500 hover:bg-red-600 text-white py-2 px-6 rounded-md transition">
                        Clear Cart
                    </button>
                </div>
            </div>
        </form>
    <?php endif; ?>
</div>
 
 <script>
        document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".increment").forEach(button => {
            button.addEventListener("click", function () {
                let productId = this.getAttribute("data-product-id");
                let inputField = document.querySelector(`input[data-product-id='${productId}']`);
                inputField.value = parseInt(inputField.value) + 1;
            });
        });

        document.querySelectorAll(".decrement").forEach(button => {
            button.addEventListener("click", function () {
                let productId = this.getAttribute("data-product-id");
                let inputField = document.querySelector(`input[data-product-id='${productId}']`);
                if (parseInt(inputField.value) > 1) {
                    inputField.value = parseInt(inputField.value) - 1;
                }
            });
        });
    });
</script>
<?php
include 'footer.php';
?>