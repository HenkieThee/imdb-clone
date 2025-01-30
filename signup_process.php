<?php
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

// Verkrijg de gegevens van het formulier
$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash het wachtwoord

// Bereid en bind
$stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $email, $password);

// Voer de query uit
if ($stmt->execute()) {
    // Start een sessie en log de gebruiker in
    session_start();
    $_SESSION['user_id'] = $stmt->insert_id;
    header("Location: account.php");
    exit();
} else {
    echo "Error: " . $stmt->error;
}

// Sluit de verbinding
$stmt->close();
$conn->close();
?>