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
    if (isset($_POST['update'])) {
        $new_email = $_POST['email'];
        $new_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $stmt = $conn->prepare("UPDATE users SET email = ?, password = ? WHERE id = ?");
        $stmt->bind_param("ssi", $new_email, $new_password, $user_id);

        if ($stmt->execute()) {
            $_SESSION['success_message'] = "Account updated successfully!";
            header("Location: index.php");
            exit();
        } else {
            echo "Error updating account: " . $stmt->error;
        }

        $stmt->close();
    } elseif (isset($_POST['delete'])) {
        $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $user_id);

        if ($stmt->execute()) {
            session_unset();
            session_destroy();
            header("Location: index.php");
            exit();
        } else {
            echo "Error deleting account: " . $stmt->error;
        }

        $stmt->close();
    }

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
    <div class="bg-white p-6 rounded-lg shadow-md text-center relative">
        <h1 class="text-2xl mb-6 text-gray-800">Edit Account</h1>
        <form action="edit_account.php" method="post">
            <label for="email" class="block mb-2 text-gray-600 font-bold">Email</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required class="w-full p-2 mb-4 border border-gray-300 rounded">
            <label for="password" class="block mb-2 text-gray-600 font-bold">New Password</label>
            <input type="password" id="password" name="password" required class="w-full p-2 mb-4 border border-gray-300 rounded">
            <button type="submit" name="update" class="w-full p-2 bg-yellow-500 text-gray-800 rounded hover:bg-yellow-600 mb-8">Update Account</button>
        </form>
        <a href="account.php" class="inline-block p-2 bg-yellow-500 text-gray-800 rounded hover:bg-yellow-600 text-sm absolute bottom-4 left-4">Back to Account</a>
        <form action="edit_account.php" method="post" class="absolute bottom-4 right-4">
            <button type="submit" name="delete" class="p-2 bg-red-500 text-gray-800 rounded hover:bg-red-600 text-sm">Delete Account</button>
        </form>
    </div>
</body>
</html>