<?php
session_start();

// Include your database connection logic
require_once("inc/db.inc.php");

// Check if the form was submitted via POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // ToDo: Implement any necessary data validation

    // Extract dish details from the POST data
    $dishId = $_POST['dishId'];
    $dishName = $_POST['dishName'];
    $quantity = $_POST['quantity'];
    $dishPrice = $_POST['dishPrice'];
    // ToDo: Adjust the query to match your database structure
    $query = "INSERT INTO wishlist (dish_id, dish_name, quantity, dish_price) VALUES ('$dishId', '$dishName', '$quantity', '$dishPrice')"; // Updated line
    // Execute the query
    $result = mysqli_query($db, $query);
    if ($result) {
        // Return success response as JSON
        echo json_encode(["success" => true]);
    } else {
        // Return error response as JSON
        echo json_encode(["error" => "Failed to add item to wishlist"]);
    }
    // Close the database connection
    mysqli_close($db);
} else {
    // If the form was not submitted via POST, return an error or handle accordingly
    echo json_encode(["error" => "Invalid request"]);
}
?>
