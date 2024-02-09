<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once("inc/rmhead.inc.php") ?>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Add your custom CSS styles for dish cards here -->
    <style>
        .hero{
    background-image: url('https://img.freepik.com/premium-vector/neon-sign-order-here-with-brick-wall-background-vector_118419-4104.jpg?w=2000');  /* Replace 'path/to/your/image.jpg' with the actual path to your image file */
    background-size: cover; /* You can use 'contain' or other values depending on your preference */
    background-repeat: no-repeat;
    /* background-attachment: fixed; This makes the background image fixed while scrolling */
    animation: fadeIn 4s ease;
}
        .dish-card {
            border: 1px solid #ccc;
            margin: 10px;
            padding: 10px;
            width: 300px;
            text-align: center;
        }

        .dish-image {
            max-width: 100%;
            height: auto;
        }
    </style>

    <!-- Add your JavaScript code for handling quantity selection and wishlist addition here -->
    <script>
        $(document).ready(function () {
            // Function to fetch dishes from the server
        function fetchDishes() {
            $.ajax({
                url: 'get_dishes.php', // Change this URL to the actual endpoint for fetching dishes
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    // Call a function to generate cards for each dish
                    generateDishCards(data);
                },
                error: function (error) {
                    console.error('Error fetching dishes:', error);
                    alert('Error fetching dishes. Please try again.');
                }
            });
        }

        // Function to generate cards for each dish
        function generateDishCards(dishes) {
            // Get the container where you want to append the dish cards
            var dishContainer = $('#dishContainer');

            // Clear the existing content
            dishContainer.empty();

            // Loop through the dishes and create a card for each
            dishes.forEach(function (dish) {
                var cardHtml =
                    '<div class="dish-card">' +
                    '<img class="dish-image" src="' + dish.d_photo + '" alt="' + dish.d_name + '">' +
                    '<h4>' + dish.d_name + '</h4>' +
                    '<p>Price: ₹' + dish.d_price + '</p>' +
                    '<p>' + dish.d_desc + '</p>' +
                    '<label for="quantity_' + dish.d_id + '">Quantity:</label>' +
                    '<input type="number" id="quantity_' + dish.d_id + '" name="quantity" value="1" min="1">' +
                    '<button class="add-to-wishlist btn btn-success" data-dish-id="' + dish.d_id + '" data-dish-name="' + dish.d_name + '" data-dish-price="' + dish.d_price + '">Add to Cart</button>' +
                    '</div>';

                // Append the card HTML to the container
                dishContainer.append(cardHtml);
            });
        }

        // Fetch dishes when the page loads
        fetchDishes();
            // Add event listener for the "Add to Wishlist" button
        $(document).on('click', '.add-to-wishlist', function () {
            // Get the details of the selected dish
            var dishId = $(this).data('dish-id');
            var dishName = $(this).data('dish-name');
            var quantity = $('#quantity_' + dishId).val();
            var dishPrice = $(this).data('dish-price');

            // Send the selected dish details to the server
            $.ajax({
                url: 'process_placeorder.php',
                type: 'POST',
                data: {
                    dishId: dishId,
                    dishName: dishName,
                    quantity: quantity,
                    dishPrice: dishPrice
                },
                dataType: 'json',
                success: function (response) {
                    // Handle the success response
                    if (response.success) {
                        alert('Item added to wishlist successfully!');
                    } else {
                        alert('Failed to add item to wishlist. Please try again.');
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error adding item to wishlist:', xhr.responseText);
                    console.error('Status:', status);
                    console.error('Error:', error);
                    alert('Error adding item to wishlist. Please try again.');
                }
            });
        });
    });
    </script>
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

        <!-- Hero Section - Home Page -->
        <section id="hero" class="hero">
            <div class="container" data-aos="fade-up" data-aos-delay="100">
             <!-- Container for dynamically generated dish cards -->
             <div id="dishContainer" class="dish-container row"></div>
            </div>
        </section>
    </main>
    <?php require_once("inc/footer.inc.php") ?>
</body>

</html>
