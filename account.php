<?php
include 'productnavbar.php';
include 'dashboard.php';
if (!isset($_SESSION['customer'])) {
    header('Location: customers_login.php');
    exit;
}
?>

<div class="mt-30 overflow-x-hidden md:mx-20 mb-10 max-sm:mx-5">
    <div class="bg-white drop-shadow-xl mx-4 sm:mx-auto w-full py-10">
        <h1 class="text-2xl sm:text-3xl text-purple-600 font-medium mb-6 text-center">My Account</h1>

        <div class="max-sm:mr-7 max-sm:ml-3 md:mx-6">
            <!-- Personal Info -->
            <div class="border border-gray-300 pl-5 pb-5 pt-5 rounded-md">
                <h2 class="text-purple-600 text-xl sm:text-2xl font-medium mb-4">Personal Information :</h2>

                <p class="pb-2"><strong>Name</strong>: <?php echo $_SESSION['customer']['Customer_name']; ?></p>
                <p class="pb-2"><strong>Email</strong>: <?php echo $_SESSION['customer']['Customer_email']; ?></p>
                <p class="pb-2"><strong>Phone</strong>: <?php echo $_SESSION['customer']['Phone']; ?></p>
            </div>
        </div>
    </div>
</div>
