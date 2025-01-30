<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMDb Clone - Sign In</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black flex justify-center items-center h-screen">
    <div class="bg-white p-6 rounded-lg shadow-md flex">
        <div class="w-96 mr-6">
            <img src="imdb.png" alt="Logo" class="w-25 h-16 mb-4 ml-auto mr-auto">
            <h1 class="text-2xl mb-6 text-gray-800">Sign In</h1>
            <?php if (isset($_GET['error'])): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                    <?php if ($_GET['error'] == 'invalid_password'): ?>
                        <span class="block sm:inline">Invalid password. Please try again.</span>
                    <?php elseif ($_GET['error'] == 'no_user'): ?>
                        <span class="block sm:inline">No user found with that email.</span>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <form action="signin_process.php" method="post">
                <label for="email" class="block mb-2 text-gray-600">Email</label>
                <input type="email" id="email" name="email" required class="w-full p-2 mb-4 border border-gray-300 rounded">
                <label for="password" class="block mb-2 text-gray-600">Password</label>
                <input type="password" id="password" name="password" required class="w-full p-2 mb-4 border border-gray-300 rounded">
                <button type="submit" class="w-full p-2 bg-yellow-500 text-gray-800 rounded hover:bg-yellow-600 mb-4">Sign In</button>
                <a href="signup.php" class="w-full p-2 bg-yellow-500 text-gray-800 rounded hover:bg-blue-600 text-center block mb-4">Sign Up</a>
                <a href="index.php" class="w-full p-2 bg-yellow-500 text-gray-800 rounded hover:bg-blue-600 text-center block">Back to Home</a>
            </form>
        </div>
        <div class="max-w-md">
            <h2 class="text-xl mb-4 text-gray-800">Benefits of your IMDb account</h2>
            <p class="mb-4 text-gray-600"><strong>Personalized Recommendations</strong><br>Discover shows you'll love.</p>
            <p class="mb-4 text-gray-600"><strong>Your Watchlist</strong><br>Track everything you want to watch and receive e-mail when movies open in theaters.</p>
            <p class="mb-4 text-gray-600"><strong>Your Ratings</strong><br>Rate and remember everything you've seen.</p>
            <p class="mb-4 text-gray-600"><strong>Contribute to IMDb</strong><br>Add data that will be seen by millions of people and get cool badges.</p>
        </div>
    </div>
</body>
</html>