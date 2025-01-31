
<?php
session_start();
?>


<!DOCTYPE html>
<html lang='en'>
<head>
   <meta charset='UTF-8'>
   <meta http-equiv='X-UA-Compatible' content='IE=edge'>
   <meta name='viewport' content='width=device-width, initial-scale=1.0'>
   <title>IMDB Clone</title>
   <script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>
   <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.2/css/all.css">
   <script src="https://cdn.jsdelivr.net/npm/flowbite@3.0.0/dist/flowbite.min.js"></script>
   <script src="https://cdn.tailwindcss.com"></script>
   <style>
       .bg-custom {
           background-color: #121212;
       }
       .category-custom {
            background-color: #1f1f1f;
       }
       .video-bg {
           position: relative;
           width: 100%;
           height: 200px;
           overflow: hidden;
           border-radius: 0.5rem;
       }
       .video-bg video {
           position: absolute;
           top: 0;
           left: 0;
           width: 100%;
           height: 100%;
           object-fit: cover;
       }
       .card-content {
           position: relative;
           z-index: 1;
           background: rgba(0, 0, 0, 0.5);
           padding: 1rem;
           border-radius: 0.5rem;
       }
   </style>
</head>

<body class="bg-black text-white">
  
    <?php include 'nav.php'; ?>

<?php if (isset($_SESSION['success_message'])): ?>
    <div id="success-message" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4 container mx-auto mt-4">
        <?php echo $_SESSION['success_message']; unset($_SESSION['success_message']); ?>
    </div>
    <script>
        setTimeout(function() {
            document.getElementById('success-message').style.display = 'none';
        }, 5000); 
    </script>
<?php endif; ?>

   <!-- Hero Section -->
   <section class="relative bg-gray-900 text-white py-20 overflow-hidden">
        <!-- Background Video -->
        <video autoplay loop muted class="absolute inset-0 w-full h-full object-cover z-0">
            <source src="images/trailer1.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <!-- Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-b from-black/50 to-black/90 z-0"></div>
        <!-- Hero Content -->
        <div class="container mx-auto text-center relative z-10">
            <h1 class="text-5xl font-extrabold mb-6 drop-shadow-lg">Welcome to IMDB Clone</h1>
            <p class="text-xl mb-8 text-gray-300 drop-shadow-md">
                Discover the latest movies, TV shows, and celebrities.
            </p>
            <a href="#" class="bg-yellow-500 text-black py-3 px-6 text-lg font-semibold rounded-lg shadow-md hover:bg-yellow-600 transition-all duration-300">
                Browse Now
            </a>
        </div>
    </section>


   <!-- Trending Movies Section -->
   <section class="py-10">
        <div class="container mx-auto">
            <h2 class="text-2xl font-bold mb-6">Trending Movies</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <!-- Movie Card -->
                <div class="relative bg-gray-800 rounded-xl shadow-lg overflow-hidden group cursor-pointer h-96">
                    <div class="aspect-w-2 aspect-h-3"> <!-- Enforces a 2:3 aspect ratio -->
                        <img src="images/moviePicture1.jpg" alt="Movie 1" class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                    </div>
                    <!-- Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-b from-transparent via-black/20 to-black/80 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <!-- Movie Title -->
                    <div class="relative z-10 flex items-end justify-center h-full p-4">
                        <h3 class="text-lg font-bold text-white drop-shadow-md group-hover:text-yellow-500 transition-colors duration-300">
                            Mufasa
                        </h3>
                    </div>
                </div>
                <!-- Repeat Movie Cards -->
                <div class="relative bg-gray-800 rounded-xl shadow-lg overflow-hidden group cursor-pointer">
                    <div class="aspect-w-2 aspect-h-3">
                        <img src="images/moviePicture1.jpg" alt="Movie 2" class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-b from-transparent via-black/20 to-black/80 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative z-10 flex items-end justify-center h-full p-4">
                        <h3 class="text-lg font-bold text-white drop-shadow-md group-hover:text-yellow-500 transition-colors duration-300">
                            Mufasa
                        </h3>
                    </div>
                </div>
                <!-- Add more cards as needed -->
            </div>
        </div>
    </section>



   <!-- Popular TV Shows Section -->
   <section class="py-10">
        <div class="container mx-auto">
            <h2 class="text-2xl font-bold mb-6">Trending Movies</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <!-- Movie Card -->
                <div class="relative bg-gray-800 rounded-xl shadow-lg overflow-hidden group cursor-pointer h-96">
                    <div class="aspect-w-2 aspect-h-3"> <!-- Enforces a 2:3 aspect ratio -->
                        <img src="images/tvShow1.jpg" alt="Movie 1" class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                    </div>
                    <!-- Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-b from-transparent via-black/20 to-black/80 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <!-- Movie Title -->
                    <div class="relative z-10 flex items-end justify-center h-full p-4">
                        <h3 class="text-lg font-bold text-white drop-shadow-md group-hover:text-yellow-500 transition-colors duration-300">
                            Mufasa
                        </h3>
                    </div>
                </div>
                <!-- Repeat Movie Cards -->
                <div class="relative bg-gray-800 rounded-xl shadow-lg overflow-hidden group cursor-pointer">
                    <div class="aspect-w-2 aspect-h-3">
                        <img src="images/tvShow1.jpg" alt="Movie 2" class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-b from-transparent via-black/20 to-black/80 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative z-10 flex items-end justify-center h-full p-4">
                        <h3 class="text-lg font-bold text-white drop-shadow-md group-hover:text-yellow-500 transition-colors duration-300">
                            Mufasa
                        </h3>
                    </div>
                </div>
                <!-- Add more cards as needed -->
            </div>
        </div>
    </section>

   <!-- Footer -->
   <footer class="text-gray-400 py-6">
       <div class="container mx-auto text-center">
           <p>&copy; 2025 IMDB Clone. All rights reserved.</p>
       </div>
   </footer>
</body> 
</html>

