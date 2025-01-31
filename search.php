<?php

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
    for ($i = 0; $i < 50; $i++) {
        $movie = fetchRandomMovie($omdbApiKey);
        if ($movie && $movie['Response'] === "True") {
            $movies[] = $movie;
        }
    }
}
?>