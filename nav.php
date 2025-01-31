<nav class="bg-custom text-white p-4">
    <div class="container mx-auto flex justify-between items-center">
        <a href="index.php" class="flex items-center">
            <img src="images/logo.png" alt="Logo" class="h-8 mr-3">
            <span class="text-lg font-bold">IMDB Clone</span>
        </a>
        <form class="w-full max-w-2xl mx-auto flex relative">
            <button id="dropdown-button" data-dropdown-toggle="dropdown" class="shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-900 bg-white border border-gray-300 rounded-s-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100" type="button">
                All <i class="fas fa-chevron-down ml-2.5"></i>
            </button>
            <div id="dropdown" class="z-10 hidden bg-black text-[#f4c519] divide-y divide-gray-100 rounded-lg shadow-sm w-44 absolute left-20 mt-12">
                <ul class="py-2 text-sm" aria-labelledby="dropdown-button">
                    <li>
                        <button type="button" class="inline-flex w-full px-4 py-2 hover:bg-gray-700">
                            <i class="fas fa-film mr-2"></i> Titles
                        </button>
                    </li>
                    <li>
                        <button type="button" class="inline-flex w-full px-4 py-2 hover:bg-gray-700">
                            <i class="fas fa-tv mr-2"></i> TV Episodes
                        </button>
                    </li>
                    <li>
                        <button type="button" class="inline-flex w-full px-4 py-2 hover:bg-gray-700">
                            <i class="fas fa-user mr-2"></i> Celebs
                        </button>
                    </li>
                    <li>
                        <button type="button" class="inline-flex w-full px-4 py-2 hover:bg-gray-700">
                            <i class="fas fa-building mr-2"></i> Companies
                        </button>
                    </li>
                </ul>
            </div>
            <div class="relative w-full">
                <input type="search" id="search-dropdown" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-white rounded-e-lg border-s-gray-50 border-s-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Search movies..." required />
                <button type="submit" class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-gray-900 bg-white rounded-e-lg border border-gray-300 hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100">
                    <i class="fas fa-search"></i>
                    <span class="sr-only">Search</span>
                </button>
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