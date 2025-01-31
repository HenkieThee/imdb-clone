<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_from_watchlist'])) {
    $index = $_POST['index'];
    if (isset($_SESSION['watchlist'][$index])) {
        unset($_SESSION['watchlist'][$index]);
        $_SESSION['watchlist'] = array_values($_SESSION['watchlist']);
    }
    header('Location: watchlist.php');
    exit();
}


// Controleer of de gebruiker is ingelogd
if (isset($_SESSION['user_id'])) {
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

    // Verkrijg de naam van de ingelogde gebruiker
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
    <title>Watchlist</title>
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
   </style>
</head>
<body>
<nav class="bg-custom text-white p-4">
       <div class="container mx-auto flex justify-between items-center">
           <a href="index.php" class="flex items-center">
               <img src="images/logo.png" alt="Logo" class="h-8 mr-3">
               <span class="text-lg font-bold">IMDB Clone</span>
           </a>
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

<main id="container" class="bg-stone-900 text-white">
    <section class='mx-auto py-10 w-4/6'>
        <h1 class='text-5xl mb-6'>Your Watchlist</h1>
        <?php if (isset($_SESSION['watchlist']) && !empty($_SESSION['watchlist'])): ?>
            <div class='grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6'>
                <?php foreach ($_SESSION['watchlist'] as $index => $item): ?>
                    <div class='bg-gray-800 p-4 rounded-lg'>
                        <img src='<?php echo $item['poster']; ?>' alt='<?php echo $item['title']; ?>' class='rounded-lg mb-4'>
                        <h2 class='text-2xl mb-2'><?php echo $item['title']; ?></h2>
                        <form method='POST' action=''>
                            <input type='hidden' name='index' value='<?php echo $index; ?>'>
                            <button type='submit' name='delete_from_watchlist' class='bg-red-500 cursor-pointer flex flex-nowrap font-semibold rounded text-white text-sm p-1'>Remove from Watchlist</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>No items in your watchlist.</p>
        <?php endif; ?>
    </section>
</main>
</body>
</html>