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

// Verkrijg de huidige gebruikersgegevens
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT email FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($email);
$stmt->fetch();
$stmt->close();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_email = $_POST['email'];
    $new_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("UPDATE users SET email = ?, password = ? WHERE id = ?");
    $stmt->bind_param("ssi", $new_email, $new_password, $user_id);

    if ($stmt->execute()) {
        echo "Account updated successfully!";
    } else {
        echo "Error updating account: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Account</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black flex justify-center items-center h-screen">
    <div class="bg-white p-6 rounded-lg shadow-md text-center">
        <h1 class="text-2xl mb-6 text-gray-800">Edit Account</h1>
        <form action="edit_account.php" method="post">
            <label for="email" class="block mb-2 text-gray-600 font-bold">Email</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required class="w-full p-2 mb-4 border border-gray-300 rounded">
            <label for="password" class="block mb-2 text-gray-600 font-bold">New Password</label>
            <input type="password" id="password" name="password" required class="w-full p-2 mb-4 border border-gray-300 rounded">
            <button type="submit" class="w-full p-2 bg-yellow-500 text-gray-800 rounded hover:bg-yellow-600 mb-4">Update Account</button>
        </form>
        <a href="account.php" class="inline-block p-2 bg-yellow-500 text-gray-800 rounded hover:bg-yellow-600">Back to Account</a>
    </div>
</body>
</html>