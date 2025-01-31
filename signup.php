<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMDb Clone - Sign Up</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black flex justify-center items-center h-screen">
    <div class="bg-white p-6 rounded-lg shadow-md flex flex-col items-center">
        <img src="imdb.png" alt="Logo" class="w-25 h-16 mb-4">
        <div class="w-96">
            <h1 class="text-2xl mb-6 text-gray-800 text-center">Create Account</h1>
            <form action="signup_process.php" method="post">
                <label for="name" class="block mb-2 text-gray-600 font-bold">Your Name</label>
                <input type="text" id="name" name="name" required class="w-full p-2 mb-4 border border-gray-300 rounded">
                <label for="email" class="block mb-2 text-gray-600 font-bold">Email</label>
                <input type="email" id="email" name="email" required class="w-full p-2 mb-4 border border-gray-300 rounded">
                <label for="password" class="block mb-2 text-gray-600 font-bold">Password</label>
                <input type="password" id="password" name="password" required class="w-full p-2 mb-4 border border-gray-300 rounded" minlength="8">
                <p class="text-gray-600 mb-4">Passwords must be at least 8 characters.</p>
                <button type="submit" class="w-full p-2 bg-yellow-500 text-gray-800 rounded hover:bg-yellow-600 mb-4">Create Account</button>
                <a href="signin.php" class="w-full p-2 bg-yellow-500 text-gray-800 rounded hover:bg-yellow-600 text-center block">Sign In</a>
            </form>
        </div>
    </div>
</body>
</html>