<?php 
include 'productnavbar.php';
include 'config.php';
include 'dashboard.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer_email = $_POST['Customer_email'];
    $customer_password = $_POST['Customer_password'];

    // Secure query with prepared statement
    $stmt = $conn->prepare("SELECT * FROM customer_login WHERE Customer_email = ?");
    $stmt->bind_param("s", $customer_email);
    $stmt->execute();
    $result = $stmt->get_result();
    $customer = $result->fetch_assoc();

    if ($customer && $customer_password === $customer['Customer_password']) {
        $_SESSION['flashed'] = ['type' => 'success', 'message' => 'Login successful!'];
        $_SESSION['customer'] = $customer;
    
        $redirectTo = isset($_SESSION['redirect_after_login']) ? $_SESSION['redirect_after_login'] : 'customers_login.php';
        unset($_SESSION['redirect_after_login']);
        header("Location: $redirectTo");
        exit;
    } else {
        $_SESSION['flashed'] = ['type' => 'error', 'message' => 'Invalid Email or Password'];
        header('Location: customers_register.php');
        exit;
    }
}
?>


<div class="grid justify-center md:mt-50 max-sm:mt-30">

<?php if (isset($_SESSION['flashed'])): ?>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
        Swal.fire({
            icon: '<?= $_SESSION['flashed']['type'] ?>',
            title: '<?= $_SESSION['flashed']['message'] ?>',
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true,
        });
        </script>
        <?php unset($_SESSION['flashed']); endif; ?>
    <div class="bg-white md:w-xl max-sm:w-max drop-shadow-lg rounded-md p-5 md:mb-32 max-sm:mb-5 max-sm:px-5">
        <h1 class="pt-2 md:text-3xl max-sm:text-xl text-purple-700 font-medium">Welcome</h1>
        <div class="flex max-sm:flex-colz justify-between mb-5 mt-2">
            <p class="md:text-xl max-sm:text-lg text-purple-600 font-medium pb-2">Login or Sign-up</p>
            <div class="flex gap-3">
                <a href="customers_login.php"><button class="md:px-10 max-sm:px-5 py-2 bg-gray-200 hover:bg-purple-600 hover:cursor-pointer hover:text-white transition hover:drop-shadow-lg rounded-md">Sign In</button></a>
                <a href="customer_register.php"><button class="md:px-10 max-sm:px-5 py-2 bg-gray-200 hover:bg-purple-600 hover:cursor-pointer hover:text-white transition hover:drop-shadow-lg rounded-md">Register</button></a>
            </div>
        </div>
        <hr class="text-gray-300 mb-10">

        <form method="post">
        <!-- Email Field -->
        <div class="relative mb-5">
            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-500"><i class="bi bi-envelope"></i></span>
            <input type="email" name="Customer_email" placeholder="Email Address" class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:border-purple-600"/>
        </div>

        <!-- Password Field -->
        <div class="relative mb-5">
            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-500"><i class="bi bi-lock-fill"></i></span>
            <input type="password" name="Customer_password" placeholder="Password" class="w-full pl-10 pr-10 py-3 border border-gray-300 rounded-md focus:outline-none focus:border-purple-600 password-input"/>
            <span class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-500 cursor-pointer toggle-password" onclick="togglePasswordVisibility()"><i class="bi bi-eye"></i></span>
        </div>
        <button type="submit" class="text-white bg-purple-500 hover:bg-purple-600 transition hover:cursor-pointer px-6 py-2 hover:drop-shadow-lg rounded-md">Submit</button>
        </form>
    </div>
</div>


<script>
  function togglePasswordVisibility() {
    const passwordInput = document.querySelector('.password-input');
    const icon = document.querySelector('.toggle-password i');
    const isPassword = passwordInput.type === 'password';

    passwordInput.type = isPassword ? 'text' : 'password';
    icon.classList.toggle('bi-eye');
    icon.classList.toggle('bi-eye-slash');
  }
</script>

<?php 
include 'footer.php';
?>