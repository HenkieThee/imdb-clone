<?php
session_start();

// Controleer of de gebruiker is ingelogd
if (!isset($_SESSION['user_id'])) {
    header("Location: signin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMDb Clone - Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black flex justify-center items-center h-screen">
    <div class="bg-white p-6 rounded-lg shadow-md text-center">
        <h1 class="text-2xl mb-6 text-gray-800">Welcome to IMDb Clone</h1>
        <p class="text-gray-600">Je bent succesvol ingelogd!</p>
        <div class="mt-4">
            <a href="index.php" class="inline-block p-2 bg-yellow-500 text-gray-800 rounded hover:bg-yellow-600 mr-2">Home</a>
            <a href="edit_account.php" class="inline-block p-2 bg-yellow-500 text-gray-800 rounded hover:bg-yellow-600 mr-2">Edit Account</a>
            <a href="logout.php" class="inline-block p-2 bg-yellow-500 text-gray-800 rounded hover:bg-yellow-600">Logout</a>
        </div>
    </div>
</body>
</html>