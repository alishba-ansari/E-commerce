<?php
session_start();
include 'config.php';
include 'insert.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <title>Document</title>
</head>

<body class="bg-gray-200 min-h-screen flex items-center justify-center px-4">
    <div class="w-full max-w-md md:max-w-lg lg:max-w-xl p-8 md:p-10 bg-white rounded-xl shadow-lg">
        <h1 class="text-3xl text-purple-600 font-bold pb-4 text-center">Purple</h1>
        <h3 class="text-xl font-semibold text-slate-900 text-center">Dashboard Login</h3>
        <p class="pb-6 text-center text-sm text-gray-500">Enter your information to access the Dashboard.</p>

        <form action="login_code.php" method="post" class="space-y-4">
            <input type="email" name="Email" placeholder="Email"
                class="w-full border border-gray-300 px-4 py-3 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-400">
            <input type="password" name="Password" placeholder="Password"
                class="w-full border border-gray-300 px-4 py-3 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-400">

            <div class="flex justify-between items-center mt-4">
                <input type="submit" value="Login"
                    class="w-full rounded-lg bg-purple-600 hover:bg-purple-700 transition py-3 text-white font-medium cursor-pointer">
            </div>
        </form>
    </div>
</body>

</html>