<?php
include 'navbar.php';
include 'sidebar.php';
include 'dashboard.php';

$customerQuery = "SELECT COUNT(*) AS total_customers FROM customers";
$customerResult = $conn->query($customerQuery);
$totalCustomers = ($customerResult && $row = $customerResult->fetch_assoc()) ? $row['total_customers'] : 0;

$productQuery = "SELECT COUNT(*) AS total_products FROM product";
$productResult = $conn->query($productQuery);
$totalProducts = ($productResult && $row = $productResult->fetch_assoc()) ? $row['total_products'] : 0;

$brandQuery = "SELECT COUNT(*) AS total_brands FROM brand";
$brandResult = $conn->query($brandQuery);
$totalBrands = ($brandResult && $row = $brandResult->fetch_assoc()) ? $row['total_brands'] : 0;

$orderQuery = "SELECT COUNT(*) AS total_orders FROM orders";
$orderResult = $conn->query($orderQuery);
$totalOrders = ($orderResult && $row = $orderResult->fetch_assoc()) ? $row['total_orders'] : 0;

$approvedQuery = "SELECT COUNT(*) AS total_approved FROM orders WHERE status = 'Completed'";
$approvedResult = $conn->query($approvedQuery);
$totalApproved = $approvedResult->fetch_assoc()['total_approved'] ?? 0;

$rejectedQuery = "SELECT COUNT(*) AS total_rejected FROM orders WHERE status = 'Rejected'";
$rejectedResult = $conn->query($rejectedQuery);
$totalRejected = $rejectedResult->fetch_assoc()['total_rejected'] ?? 0;

$pendingQuery = "SELECT COUNT(*) AS total_pending FROM orders WHERE status = 'Pending'";
$pendingResult = $conn->query($pendingQuery);
$totalPending = $pendingResult->fetch_assoc()['total_pending'] ?? 0;

$totalSalesQuery = "SELECT SUM(total) AS total_sales FROM orders WHERE status = 'Completed'";
$totalSalesResult = $conn->query($totalSalesQuery);
$totalSales = $totalSalesResult->fetch_assoc()['total_sales'] ?? 0;
$formattedTotalSales = number_format($totalSales, 2);

$monthlySalesQuery = "SELECT SUM(total) AS monthly_sales  FROM orders WHERE status = 'Completed' 
                        AND MONTH(`date`) = MONTH(CURRENT_DATE()) 
                        AND YEAR(`date`) = YEAR(CURRENT_DATE())";
$monthlySalesResult = $conn->query($monthlySalesQuery);
$monthlySales = $monthlySalesResult->fetch_assoc()['monthly_sales'] ?? 0;
$formattedMonthlySales = number_format($monthlySales, 2);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <title>Dashboard</title>
</head>
<body class="bg-gray-50">
  <div class="md:ml-64 mt-5 px-4 sm:px-8">
    <?php
      if (isset($_SESSION['flash'])) {
        $flash = $_SESSION['flash'];
        echo "<script>
          Swal.fire({
            icon: '{$flash['type']}',
            title: '{$flash['message']}',
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true
          });
        </script>";
        unset($_SESSION['flash']);
      }
    ?>

    <div class="flex items-center justify-between mt-25">
      <div class="flex items-center gap-3">
        <button class="bg-gradient-to-l from-purple-600 to-purple-400 text-white px-5 py-2 rounded-sm text-lg drop-shadow-md">
          <i class="bi bi-house-door-fill"></i>
        </button>
        <p class="font-medium md:text-xl max-sm:text-lg text-slate-800">Dashboard</p>
      </div>
      <p class="md:text-lg max-sm:text-normal flex items-center gap-2">Overview <i class="bi bi-exclamation-circle text-purple-600"></i></p>
    </div>

    <!-- Cards -->
    <div class="grid grid-cols-1 lg:max-xl:grid-cols-2 xl:grid-cols-3 xl:gap-6 md:max-xl:gap-4 mt-5 mb-5 ">
      <div class="bg-gradient-to-l from-pink-400 to-pink-300 drop-shadow-lg rounded-md max-sm:mb-5">
        <div class="xl:p-6 md:max-xl:p-4 text-white font-medium max-sm:p-6">
          <p class="md:text-xl max-sm:text-xl drop-shadow-sm">Total Customers<i class="bi bi-graph-up float-right"></i></p>
          <h1 class="md:max-xl:text-2xl text-3xl max-sm:text-xl pt-6 drop-shadow-sm"><?php echo $totalCustomers; ?></h1>
        </div>
      </div>

      <div class="bg-gradient-to-l from-blue-500 to-blue-300 drop-shadow-lg rounded-md max-sm:mb-5">
        <div class="xl:p-6 md:max-xl:p-4 text-white font-medium max-sm:p-6">
          <p class="md:text-xl max-sm:text-xl drop-shadow-sm">Total Products <i class="bi bi-bookmark float-right"></i></p>
          <h1 class="md:max-xl:text-2xl text-3xl max-sm:text-xl pt-6 drop-shadow-sm"><?php echo $totalProducts; ?></h1>
        </div>
      </div>

      <div class="bg-gradient-to-l from-teal-500 to-teal-300 drop-shadow-lg rounded-md max-sm:mb-5">
        <div class="xl:p-6 md:max-xl:p-4 text-white font-medium max-sm:p-6">
          <p class="md:text-xl max-sm:text-xl drop-shadow-sm">Brands<i class="bi bi-gem float-right"></i></p>
          <h1 class="md:max-xl:text-2xl text-3xl max-sm:text-xl pt-6 drop-shadow-sm"><?php echo $totalBrands; ?></h1>
        </div>
      </div>

      <div class="bg-gradient-to-l from-yellow-400 to-yellow-200 drop-shadow-lg rounded-md max-sm:mb-5">
        <div class="xl:p-6 md:max-xl:p-4 text-white font-medium max-sm:p-6">
          <p class="md:text-xl max-sm:text-xl drop-shadow-sm">Total Orders<i class="bi bi-box float-right"></i></p>
          <h1 class="md:max-xl:text-2xl text-3xl max-sm:text-xl pt-6 drop-shadow-sm"><?php echo $totalOrders; ?></h1>
        </div>
      </div>

      <div class="bg-gradient-to-l from-fuchsia-500 to-fuchsia-300 drop-shadow-lg rounded-md max-sm:mb-5">
        <div class="xl:p-6 md:max-xl:p-4 text-white font-medium max-sm:p-6">
          <p class="md:text-xl max-sm:text-xl drop-shadow-sm">Approved<i class="bi bi-columns-gap float-right"></i></p>
          <h1 class="md:max-xl:text-2xl text-3xl max-sm:text-xl pt-6 drop-shadow-sm"><?php echo $totalApproved; ?></h1>
        </div>
      </div>

      <div class="bg-gradient-to-l from-rose-500 to-rose-300 drop-shadow-lg rounded-md max-sm:mb-5">
        <div class="xl:p-6 md:max-xl:p-4 text-white font-medium max-sm:p-6">
          <p class="md:text-xl max-sm:text-xl drop-shadow-sm">Rejected <i class="bi bi-flower3 float-right"></i></p>
          <h1 class="md:max-xl:text-2xl text-3xl max-sm:text-xl pt-6 drop-shadow-sm"><?php echo $totalRejected; ?></h1>
        </div>
      </div>

      <div class="bg-gradient-to-l from-orange-500 to-orange-300 drop-shadow-lg rounded-md max-sm:mb-5">
        <div class="xl:p-6 md:max-xl:p-4 text-white font-medium max-sm:p-6">
          <p class="md:text-xl max-sm:text-xl drop-shadow-sm">Pending<i class="bi bi-feather float-right"></i></p>
          <h1 class="md:max-xl:text-2xl text-3xl max-sm:text-xl pt-6 drop-shadow-sm"><?php echo $totalPending; ?></h1>
        </div>
      </div>

      <div class="bg-gradient-to-l from-lime-500 to-lime-300 drop-shadow-lg rounded-md max-sm:mb-5">
        <div class="xl:p-6 md:max-xl:p-4 text-white font-medium max-sm:p-6">
          <p class="md:text-xl max-sm:text-xl drop-shadow-sm">Total Sales<i class="bi bi-award float-right"></i></p>
          <h1 class="md:max-xl:text-2xl text-3xl max-sm:text-xl pt-6 drop-shadow-sm">Rs/- <?php echo $formattedTotalSales; ?></h1>
        </div>
      </div>

      <div class="bg-gradient-to-l from-cyan-500 to-cyan-300 drop-shadow-lg rounded-md max-sm:mb-5">
        <div class="xl:p-6 md:max-xl:p-4 text-white font-medium max-sm:p-6">
          <p class="md:text-xl max-sm:text-xl drop-shadow-sm">Monthly Sales <i class="bi bi-cash-stack float-right"></i></p>
          <h1 class="md:max-xl:text-2xl text-3xl max-sm:text-xl pt-6 drop-shadow-sm">Rs/- <?php echo $formattedMonthlySales; ?></h1>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
