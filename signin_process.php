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
$email = $_POST['email'];
$password = $_POST['password'];

// Bereid en bind
$stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

// Controleer of de gebruiker bestaat
if ($stmt->num_rows > 0) {
    $stmt->bind_result($id, $hashed_password);
    $stmt->fetch();

    // Controleer het wachtwoord
    if (password_verify($password, $hashed_password)) {
        session_start();
        $_SESSION['user_id'] = $id;
        header("Location: account.php");
    } else {
        header("Location: signin.php?error=invalid_password");
    }
} else {
    header("Location: signin.php?error=no_user");
}

// Sluit de verbinding
$stmt->close();
$conn->close();
?>