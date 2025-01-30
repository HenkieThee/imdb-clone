<?php
session_start();

// Controleer of de gebruiker is ingelogd
if (!isset($_SESSION['user_id'])) {
    header("Location: signin.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "imdb_clone";

// Maak verbinding met de database
$conn = new mysqli($servername, $username, $password, $dbname);

// Controleer de verbinding
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Verkrijg de gebruikers-ID uit de sessie
$user_id = $_SESSION['user_id'];

// Verwijder de gebruiker uit de database
$stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);

if ($stmt->execute()) {
    // Vernietig de sessie en stuur de gebruiker naar de homepagina
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
} else {
    echo "Error: " . $stmt->error;
}

// Sluit de verbinding
$stmt->close();
$conn->close();
?>