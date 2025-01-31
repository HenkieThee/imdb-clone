<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_watchlist'])) {
    if (!isset($_SESSION['user_id'])) {
        $_SESSION['message'] = "You need to log in first to add movies to your watchlist.";
        header('Location: trailer.php');
        exit();
    }

    $watchlistItem = [
        'title' => $_POST['title'],
        'year' => $_POST['year'],
        'rated' => $_POST['rated'],
        'runtime' => $_POST['runtime'],
        'poster' => $_POST['poster'],
        'trailer_key' => $_POST['trailer_key']
    ];

    if (!isset($_SESSION['watchlist'])) {
        $_SESSION['watchlist'] = [];
    }

    $alreadyInWatchlist = false;
    foreach ($_SESSION['watchlist'] as $item) {
        if ($item['title'] === $watchlistItem['title']) {
            $alreadyInWatchlist = true;
            break;
        }
    }

    if ($alreadyInWatchlist) {
        $_SESSION['message'] = "This movie is already in your watchlist.";
    } else {
        $_SESSION['watchlist'][] = $watchlistItem;
        $_SESSION['message'] = "Movie added to your watchlist.";
    }

    header('Location: trailer.php');
    exit();
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trailer</title>
    <link rel="stylesheet" href="trailer.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.2/css/all.css">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
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
       .close-btn {
           background: none;
           border: none;
           color: black;
           font-weight: bold;
           cursor: pointer;
           float: right;
       }
   </style>
</head>
<body>
       <?php 
       include "nav.php";
       include "search.php";
       ?>

    <main id="container" class="bg-stone-900 text-white">
        <?php
        if (isset($_SESSION['message'])) {
            echo "<div class='bg-yellow-500 text-black p-2 rounded'>
                    {$_SESSION['message']}
                    <button class='close-btn' onclick='this.parentElement.style.display=\"none\";'>&times;</button>
                  </div>";
            unset($_SESSION['message']);
        }

        $omdbApiKey = "74595494";
        $tmdbApiKey = "ad44c9ef1393dce98f4d2f0cfc319492";

        $title = isset($_GET['title']) ? $_GET['title'] : 'Shrek'; 
        $omdbUrl = "http://www.omdbapi.com/?t=" . urlencode($title) . "&apikey=" . $omdbApiKey;

        function fetchFromAPI($url) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $response = curl_exec($ch);
            curl_close($ch);
            return json_decode($response, true);
        }

        $omdbData = fetchFromAPI($omdbUrl);

        if ($omdbData['Response'] === "True") {
            $imdbId = $omdbData['imdbID'];
            $tmdbSearchUrl = "https://api.themoviedb.org/3/find/" . $imdbId . "?api_key=" . $tmdbApiKey . "&external_source=imdb_id";
            $tmdbData = fetchFromAPI($tmdbSearchUrl);

            if (!empty($tmdbData['movie_results'])) {
                $movieId = $tmdbData['movie_results'][0]['id'];
                $tmdbTrailerUrl = "https://api.themoviedb.org/3/movie/" . $movieId . "/videos?api_key=" . $tmdbApiKey;
                $trailerData = fetchFromAPI($tmdbTrailerUrl);
                $trailers = array_filter($trailerData['results'], function($video) {
                    return $video['type'] === "Trailer" && $video['site'] === "YouTube";
                });
                $trailer = !empty($trailers) ? reset($trailers) : null;
            } else {
                $trailer = null;
            }

            $votes = $omdbData['imdbVotes'];
            $numberedVotes = intval(str_replace(",", "", $votes));

            $trailerEmbed = $trailer
            ? "<iframe class='rounded-xl' width='760' height='386' src='https://www.youtube.com/embed/{$trailer['key']}' frameborder='0' allowfullscreen></iframe>"
            : "<p>No trailer available.</p>";

            echo "
            <section class='mx-auto py-10 w-5/6'>
                <div class='flex justify-between w-[90%]'>
                    <div>
                        <p id='title' class='text-5xl'>{$omdbData['Title']}</p>
                        <div class='flex gap-2'>
                            <p>{$omdbData['Year']}</p>
                            <p>{$omdbData['Rated']}</p>
                            <p>{$omdbData['Runtime']}</p>
                        </div>
                    </div>
                    <div class='flex flex-col font-bold text-gray-400'>
                        <p class='tracking-wider'>IMDb RATING</p>
                        <div class='flex items-start'>
                            <svg width='40' height='40' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'>
                                <path d='M50 15 L61 38 Q63 43 68 43 L85 38 Q87 38 85 45 L67 55 Q65 57 66 63 L73 78 Q73 80 70 80 L50 65 Q48 64 46 65 L27 78 Q25 80 25 78 L33 55 Q33 53 31 51 L15 38 Q13 36 15 35 L39 38 Q41 38 45 38 Z' fill='gold' stroke='black' stroke-width='2' />
                            </svg>
                            <div>
                                <p><span class='font-bold text-xl text-white'>{$omdbData['imdbRating']}</span>/10</p>
                                <p class='text-xs'>" . ($numberedVotes >= 1000 ? substr($votes, 0, 3) . "k" : $omdbData['imdbVotes']) . "</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class='flex items-center'>
                    <div>
                        <div>
                            <img src='{$omdbData['Poster']}' id='poster' class='rounded-xl w-64'>
                        </div>
                    </div>
                    <div class='px-4'>
                        {$trailerEmbed}
                    </div>
                </div>

                <div class='flex justify-between pt-4 w-[90%]'>
                    <div class='flex flex-col gap-4 w-4/6'>
                        <div>
                            <p>{$omdbData['Genre']}</p>
                        </div>
                        <div>
                            <p>{$omdbData['Plot']}</p>
                        </div>
                        <div class='flex flex-col gap-4'>
                            <p class='font-bold'>Director <span class='casting-info'>{$omdbData['Director']}</span></p>
                            <p class='font-bold'>Writers <span class='casting-info'>{$omdbData['Writer']}</span></p>
                            <p class='font-bold'>Stars <span class='casting-info'>{$omdbData['Actors']}</span></p>
                        </div>
                    </div>

                    <div class='flex flex-col justify-center gap-2'>
                        <form method='POST' action=''>
                            <input type='hidden' name='title' value='{$omdbData['Title']}'>
                            <input type='hidden' name='year' value='{$omdbData['Year']}'>
                            <input type='hidden' name='rated' value='{$omdbData['Rated']}'>
                            <input type='hidden' name='runtime' value='{$omdbData['Runtime']}'>
                            <input type='hidden' name='poster' value='{$omdbData['Poster']}'>
                            <input type='hidden' name='trailer_key' value='" . ($trailer ? $trailer['key'] : '') . "'>
                            <button type='submit' name='add_to_watchlist' class='bg-yellow-500 cursor-pointer flex flex-nowrap font-semibold rounded text-black text-sm p-1'>Add to Watchlist</button>
                        </form>
                        <div>
                            <span class='flex gap-1'>
                                <p class='" . ($omdbData['Metascore'] <= 50 ? 'bg-red-400' : 'bg-green-400') . " font-bold px-1'>{$omdbData['Metascore']}</p>
                                Metascore
                            </span>
                        </div>
                        <div>
                            <span class='text-center'>
                                <p>Box office:</p>
                                <p>{$omdbData['BoxOffice']}</p>
                            </span>
                        </div>
                    </div>
                </div>
            </section>
            ";
        } else {
            echo "<p>Cannot load movie from OMDb API</p>";
        }
        ?>
    </main>
</body>
</html>