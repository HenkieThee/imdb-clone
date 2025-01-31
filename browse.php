<?php
session_start();

$omdbApiKey = "74595494";

function fetchRandomMovie($apiKey) {
    $titles = ["Inception", "The Matrix", "Interstellar", "The Dark Knight", "Fight Club", "Pulp Fiction", "Forrest Gump", "The Shawshank Redemption", "The Godfather", "The Lord of the Rings"];
    $randomTitle = $titles[array_rand($titles)];
    $url = "http://www.omdbapi.com/?t=" . urlencode($randomTitle) . "&apikey=" . $apiKey;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    curl_close($ch);
    return json_decode($response, true);
}

function fetchMoviesByQuery($apiKey, $query) {
    $url = "http://www.omdbapi.com/?s=" . urlencode($query) . "&apikey=" . $apiKey;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    curl_close($ch);
    return json_decode($response, true);
}

$movies = [];
if (isset($_GET['query'])) {
    $query = $_GET['query'];
    $data = fetchMoviesByQuery($omdbApiKey, $query);
    if ($data['Response'] === "True") {
        $movies = $data['Search'];
    }
} else {
    for ($i = 0; $i < 200; $i++) {
        $movie = fetchRandomMovie($omdbApiKey);
        if ($movie && $movie['Response'] === "True") {
            $movies[] = $movie;
        }
    }
}

if (isset($_SESSION['user_id'])) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "imdb_clone";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $user_id = $_SESSION['user_id'];
    $stmt = $conn->prepare("SELECT name FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($name);
    $stmt->fetch();
    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang='en'>
<head>
   <meta charset='UTF-8'>
   <meta http-equiv='X-UA-Compatible' content='IE=edge'>
   <meta name='viewport' content='width=device-width, initial-scale=1.0'>
   <title>Browse Movies - IMDB Clone</title>
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
       }
   </style>
</head>
<body class="bg-black text-white">
    <?php include 'nav.php'; ?>

    <section class="py-10">
        <div class="container mx-auto">
            <h2 class="text-2xl font-bold mb-6">All Movies</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <?php foreach ($movies as $movie): ?>
                <!-- Movie Card -->
                <div class="relative bg-gray-800 rounded-xl shadow-lg overflow-hidden group cursor-pointer h-96">
                    <div class="aspect-w-2 aspect-h-3"> 
                        <img src="<?php echo $movie['Poster']; ?>" alt="<?php echo $movie['Title']; ?>" class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                    </div>
                    <!-- Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-b from-transparent via-black/20 to-black/80 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <!-- Movie Title -->
                    <div class="relative z-10 flex items-end justify-center h-full p-4">
                        <h3 class="text-lg font-bold text-white drop-shadow-md group-hover:text-yellow-500 transition-colors duration-300">
                            <?php echo $movie['Title']; ?>
                        </h3>
                    </div>
                </div>
                <?php endforeach; ?>
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