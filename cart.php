<?php
session_start();

// Include your database connection logic
require_once("inc/db.inc.php");

// Fetch all wishlist items
$query = "SELECT * FROM wishlist";
$result = mysqli_query($db, $query);

// Initialize an array to store wishlist items
$wishlistItems = [];

// Fetch wishlist items into an associative array
while ($row = mysqli_fetch_assoc($result)) {
    $wishlistItems[] = $row;
}

// Close the database connection
mysqli_close($db);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once("inc/rmhead.inc.php") ?>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Add your custom CSS styles for dish cards here -->
    <style>
        .hero
        {
          background-image: url('https://c8.alamy.com/comp/CW70E0/full-shopping-cart-with-fruits-vegetables-food-in-supermarket-CW70E0.jpg');  /* Replace 'path/to/your/image.jpg' with the actual path to your image file */
          background-size: cover; /* You can use 'contain' or other values depending on your preference */
          background-repeat: no-repeat;
          background-attachment: fixed; /* This makes the background image fixed while scrolling */
          animation: fadeIn 4s ease;
        }
    </style>
</head>

<body class="index-page" data-bs-spy="scroll" data-bs-target="#navmenu">

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="container-fluid d-flex align-items-center justify-content-between">
            <?php require_once("inc/hungry.inc.php") ?>
            <?php require_once("inc/nav.inc.php") ?>
        </div>
    </header><!-- End Header -->

    <main id="main">

        <!-- Wishlist Section -->
        <section id="hero" class="hero">
            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <h2 class="section-title">Your Wishlist</h2>

                <?php if (empty($wishlistItems)) : ?>
                    <p>Your wishlist is empty.</p>
                <?php else : ?>
                    <!-- Display wishlist items in a table -->
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Dish Name</th>
                                <th>Dish Price</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($wishlistItems as $item) : ?>
                                <tr>
                                    <td><?= $item['dish_name'] ?></td>
                                    <td>₹<?= $item['dish_price'] ?></td>
                                    <td><?= $item['quantity'] ?></td>
                                    <td>₹<?= $item['dish_price'] * $item['quantity'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>

            </div>
        </section>

    </main>

    <?php require_once("inc/footer.inc.php") ?>
</body>

</html>