<?php
include 'productnavbar.php';
include 'config.php';
include 'dashboard.php';

if (isset($_POST['Customer_name'])) {
   
    $Customer_name = isset($_POST['Customer_name']) ? $_POST['Customer_name'] : null;
    $Customer_email = isset($_POST['Customer_email']) ? $_POST['Customer_email'] : null;
    $Customer_password = isset($_POST['Customer_password']) ? $_POST['Customer_password'] : null;
    $Phone = isset($_POST['Phone']) ? $_POST['Phone'] : null;

    $stmt = "INSERT INTO customer_login (Customer_name , Customer_email , Customer_password , Phone) VALUES ('$Customer_name' , '$Customer_email' , '$Customer_password' , '$Phone')";

    $run = mysqli_query($conn,$stmt);

    if ($stmt) {
       
        if($run){
            header('location:checkout.php');
        } 
        else{
            echo "Error:" . $stmt->error;
        }
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
}
?>

<div class="grid justify-center mt-30">

            <!-- toaster -->
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

            <!-- toaster -->
    <div class="bg-white md:w-xl max-sm:w-max drop-shadow-lg rounded-md p-5 mb-10">
        <h1 class="pt-2 text-3xl text-purple-700 font-medium">Welcome</h1>
        <div class="flex gap-5 mb-5 mt-2">
            <p class="text-xl text-purple-600 font-medium pb-2">Sign-up</p>
        </div>
        <hr class="text-gray-300 mb-5">

        <p class="text-3xl text-purple-600 mb-5 font-medium">Personal Details</p>

        <!-- Name Field -->
        <form method="post">
        <div class="relative mb-5">
            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-500"><i class="bi bi-person-fill"></i></span>
            <input name="Customer_name" placeholder="Customer_name" class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:border-purple-600"/>
        </div>

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

        <!-- Phone -->
        <div class="relative mb-5">
            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-500"><i class="bi bi-telephone-fill"></i></span>
            <input name="Phone" placeholder="Phone" class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:border-purple-600"/>
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