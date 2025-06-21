<?php 
include 'productnavbar.php';
include 'config.php';
include 'dashboard.php';

if(!$_SESSION['customer']){
  header('Location:customers_login.php');
}

function cleanPrice($price) {
    $price = preg_replace('/[^0-9.]/', '', $price);
    return floatval($price);
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$cart_subtotal = 0;

foreach ($_SESSION['cart'] as $product_id => $item) {
    if (is_array($item) && isset($item['price']) && isset($item['quantity'])) {
        $price = cleanPrice($item['price']);
        $quantity = intval($item['quantity']);
        $cart_subtotal += $price * $quantity;
    }
}

$shipping_fee = $cart_subtotal * 0.05;
$cart_total = $cart_subtotal + $shipping_fee;

$FirstName = $LastName = $Company = $Country = $House = $Apartment = $Suburb = $City = $Zip = $State = $Phone = $Email = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $FirstName = $_POST['FirstName'] ?? '';
    $LastName = $_POST['LastName'] ?? '' ;
    $Company = $_POST['Company'] ?? '' ; 
    $Country = $_POST['Country'] ?? '' ;
    $House = $_POST['House'] ?? '' ;
    $Apartment = $_POST['Apartment'] ?? '' ;
    $Suburb = $_POST['Suburb'] ?? '' ;
    $City = $_POST['City'] ?? '' ;
    $Zip = $_POST['Zip'] ?? '' ;
    $State = $_POST['State'] ?? '' ;
    $Phone = $_POST['Phone'] ?? '' ;
    $Email = $_POST['Email'] ?? '' ;
    $status = "Pending";
    $Delivery = $_POST['Delivery'] ?? '';
    $date=date('y-d-m');
    $total_quantity = 0;
    foreach ($_SESSION['cart'] as $product_id => $item) {
        if (is_array($item) && isset($item['quantity'])) {
            $total_quantity += intval($item['quantity']);
        }
    }
 
    $stmt = $conn->prepare("INSERT INTO orders
    (FirstName, LastName, Company, Country, House, Apartment, Suburb, City, Zip, State, Phone, Email, quantity, subtotal, total, status, Delivery,date) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? , ? , ?, ?)");
 
    $stmt->bind_param("sssssssssssssddsss", 
    $FirstName, $LastName, $Company, $Country, $House, $Apartment, 
    $Suburb, $City, $Zip, $State, $Phone, $Email, 
    $total_quantity, $cart_subtotal, $cart_total, $status, $Delivery,$date);

        if ($stmt->execute()) {
        $order_id = $conn->insert_id;

    foreach ($_SESSION['cart'] as $product_id => $item) {
        if (is_array($item) && isset($item['price']) && isset($item['quantity']) && isset($item['name'])) {
            $price = cleanPrice($item['price']);
            $quantity = intval($item['quantity']);
            $total_price = $price * $quantity;
            $product_name = $item['name'];

            $item_stmt = $conn->prepare("INSERT INTO order_items (order_id, product_id, product_name, quantity, price, total_price) VALUES (?, ?, ?, ?, ?, ?)");
            $product_id = intval($product_id);
            $item_stmt->bind_param("iisiid", $order_id, $product_id, $product_name, $quantity, $price, $total_price);
            $item_stmt->execute();
            $item_stmt->close();
        }
    }

    $_SESSION['last_order_id'] = $order_id;
    $_SESSION['cart'] = [];
    header('Location: thankyou.php');
    exit();
}
}
?>

<form method="Post">
  <div class="mt-20 grid grid-cols-1 lg:grid-cols-2 gap-7 px-4 md:px-8 xl:px-20">
    <div>
      <h1 class="text-xl font-semibold text-purple-700 pb-5">BILLING DETAILS</h1>

      <div class="flex flex-col md:flex-row gap-4">
        <input type="text" name="FirstName" class="bg-white border border-gray-400 rounded-sm py-2 px-5 focus:outline-none focus:ring-0 focus:border-purple-600 drop-shadow-md flex-1" placeholder="First Name" required>
        <input type="text" name="LastName" class="bg-white border border-gray-400 rounded-sm py-2 px-5 focus:outline-none focus:ring-0 focus:border-purple-600 drop-shadow-md flex-1" placeholder="Last Name" required>
      </div>

      <div class="flex flex-col md:flex-row gap-4 mt-4">
        <input type="text" name="Company" class="bg-white border border-gray-400 rounded-sm py-2 px-5 focus:outline-none focus:ring-0 focus:border-purple-600 drop-shadow-md flex-1" placeholder="Company Name (Optional)">
        <input type="text" name="Country" class="bg-white border border-gray-400 rounded-sm py-2 px-5 focus:outline-none focus:ring-0 focus:border-purple-600 drop-shadow-md flex-1" placeholder="Country (Optional)">
      </div>

      <input type="text" name="House" class="bg-white border border-gray-400 rounded-sm py-2 px-5 focus:outline-none focus:ring-0 focus:border-purple-600 drop-shadow-md w-full mt-4" placeholder="House number & Street name" required>
      <input type="text" name="Apartment" class="bg-white border border-gray-400 rounded-sm py-2 px-5 focus:outline-none focus:ring-0 focus:border-purple-600 drop-shadow-md w-full mt-4" placeholder="Apartment, suite, unit etc. (Optional)">

      <div class="flex flex-col md:flex-row gap-4 mt-4">
        <input type="text" name="Suburb" class="bg-white border border-gray-400 rounded-sm py-2 px-5 focus:outline-none focus:ring-0 focus:border-purple-600 drop-shadow-md flex-1" placeholder="Suburb" required>
        <input type="text" name="City" class="bg-white border border-gray-400 rounded-sm py-2 px-5 focus:outline-none focus:ring-0 focus:border-purple-600 drop-shadow-md flex-1" placeholder="City" required>
      </div>

      <div class="flex flex-col md:flex-row gap-4 mt-4">
        <input type="text" name="Zip" class="bg-white border border-gray-400 rounded-sm py-2 px-5 focus:outline-none focus:ring-0 focus:border-purple-600 drop-shadow-md flex-1" placeholder="ZIP/Postal Code" required>
        <input type="text" name="State" class="bg-white border border-gray-400 rounded-sm py-2 px-5 focus:outline-none focus:ring-0 focus:border-purple-600 drop-shadow-md flex-1" placeholder="State" required>
      </div>

      <div class="flex flex-col md:flex-row gap-4 mt-4">
        <input type="text" name="Phone" class="bg-white border border-gray-400 rounded-sm py-2 px-5 focus:outline-none focus:ring-0 focus:border-purple-600 drop-shadow-md flex-1" placeholder="Phone" required>
        <input type="text" name="Email" class="bg-white border border-gray-400 rounded-sm py-2 px-5 focus:outline-none focus:ring-0 focus:border-purple-600 drop-shadow-md flex-1" placeholder="Email" required>
      </div>
    </div>

    <div>
      <h1 class="text-xl font-semibold text-purple-700 pb-5 mt-10 lg:mt-0">ADDITIONAL INFORMATION</h1>
      <textarea name="Notes" rows="5" class="bg-white border border-gray-400 rounded-sm py-2 px-5 focus:outline-none focus:ring-0 focus:border-purple-600 drop-shadow-md w-full" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
    </div>
  </div>

  <hr class="my-8 border-gray-300 mx-4 md:mx-8 xl:mx-20">

  <div class="px-4 md:px-8 xl:px-20">
    <h1 class="text-xl font-semibold text-purple-700">DELIVERY METHOD</h1>

    <div class="flex flex-col sm:flex-row gap-4 mt-4">
      <label class="flex items-center gap-2 text-gray-700">
        <input type="radio" name="Delivery" value="Home Delivery" class="accent-purple-600">
        Home Delivery
      </label>

      <label class="flex items-center gap-2 text-gray-700">
        <input type="radio" name="Delivery" value="Pickup" class="accent-purple-600">
        Pickup
      </label>
    </div>
  </div>

  <div class="px-4 md:px-8 xl:px-20 mt-10">
    <h1 class="text-xl font-semibold text-purple-700 pb-5">YOUR ORDER</h1>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
      <div class="overflow-x-auto">
        <table class="w-full min-w-[400px] text-sm">
          <thead>
            <tr class="border border-x-0 border-gray-400">
              <th class="font-medium text-gray-800 py-3 text-left">PRODUCT</th>
              <th class="font-medium text-gray-800 py-3 text-right">SUBTOTAL</th>
            </tr>
          </thead>
          <tbody>
            <?php if (empty($_SESSION['cart'])): ?>
              <tr>
                <td colspan="2" class="text-center py-4">Your cart is empty</td>
              </tr>
            <?php else: ?>
              <?php foreach ($_SESSION['cart'] as $product_id => $item): ?>
                <?php if (is_array($item) && isset($item['price']) && isset($item['quantity'])): ?>
                  <tr>
                    <td class="py-3">
                      <?php echo $item['name']; ?> × <?php echo $item['quantity']; ?>
                    </td>
                    <td class="text-right py-3">
                      Rs/- <?php echo number_format(cleanPrice($item['price']) * $item['quantity'], 2); ?>
                    </td>
                  </tr>
                <?php endif; ?>
              <?php endforeach; ?>
            <?php endif; ?>

            <tr>
              <td class="text-left py-3 font-medium">Subtotal</td>
              <td class="text-right py-3">Rs/- <?php echo number_format($cart_subtotal, 2); ?></td>
            </tr>

            <tr>
              <td class="text-left py-3 font-medium">Shipping Fee</td>
              <td class="text-right py-3">Rs/- <?php echo number_format($shipping_fee, 2); ?></td>
            </tr>

            <tr class="border-b-2 border-gray-400">
              <td class="text-left py-3 font-medium">Total</td>
              <td class="text-right py-3 font-bold text-purple-700">Rs/- <?php echo number_format($cart_total, 2); ?></td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="bg-white drop-shadow-lg p-5">
        <h1 class="text-xl font-medium text-purple-600">PAYMENT DETAILS</h1>
        <p class="pt-2 pb-3 text-sm">Pay securely with your card via Stripe.</p>
        <h3 class="text-lg font-medium text-purple-600">Card Information</h3>

        <input type="text" name="bank" class="bg-white border border-gray-400 rounded-sm py-2 px-5 focus:outline-none focus:ring-0 focus:border-purple-600 drop-shadow-md w-full mt-3" placeholder="Bank Name">

        <div class="flex flex-col md:flex-row gap-4 my-4">
          <input type="text" name="card_expiry" class="bg-white border border-gray-400 rounded-sm py-2 px-5 focus:outline-none focus:ring-0 focus:border-purple-600 drop-shadow-md flex-1" placeholder="Account">
          <input type="text" name="card_cvc" class="bg-white border border-gray-400 rounded-sm py-2 px-5 focus:outline-none focus:ring-0 focus:border-purple-600 drop-shadow-md flex-1" placeholder="CVC">
        </div>

        <p class="pb-3 text-sm">Your personal data will be used to process your order and support your experience on this website.</p>

        <button type="submit" class="bg-purple-500 hover:bg-purple-600 text-white w-full py-3 rounded-sm mt-4">Place your order</button>
      </div>
    </div>
  </div>
</form>
<?php
include 'footer.php';
?>