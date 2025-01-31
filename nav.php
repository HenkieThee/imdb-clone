<nav class="bg-custom text-white p-4">
    <div class="container mx-auto flex justify-between items-center">
        <a href="index.php" class="flex items-center">
            <img src="images/logo.png" alt="Logo" class="h-8 mr-3">
            <span class="text-lg font-bold">IMDB Clone</span>
        </a>
        <form class="w-full max-w-2xl mx-auto flex relative">
            <div class="relative w-full">
                <form action="browse.php" method="GET">
                    <input type="search" name="query" id="search-dropdown" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-white rounded-l-lg rounded-e-lg border-s-gray-50 border-s-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Search movies..." required />
                    <button type="submit" class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-gray-900 bg-white rounded-e-lg border border-gray-300 hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100">
                        <i class="fas fa-search"></i>
                        <span class="sr-only">Search</span>
                    </button>
                </form>
            </div>
        </form>
        <div class="flex items-center">
            <a href="watchlist.php" class="mx-2 flex items-center">
                <i class="fas fa-bookmark mr-1"></i> Watchlist
            </a>
            <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="account.php" class="mx-2 flex items-center">
                        <i class="fas fa-user mr-1"></i> <?php echo htmlspecialchars($name); ?>
                    </a>
                <?php else: ?>
                    <a href="signin.php" class="mx-2 flex items-center">
                        <i class="fas fa-sign-in-alt mr-1"></i> Sign In
                    </a>
                <?php endif; ?>
        </div>
    </div>
</nav>