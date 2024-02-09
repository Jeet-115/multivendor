<?php
session_start();

// Include your database connection logic
require_once("inc/db.inc.php");

// ToDo: Implement any necessary data validation

// Check if the dishId parameter is set
if (isset($_GET['dishId'])) {
    // Fetch details of the specified dish from the database (replace this with your actual query)
    $dishId = $_GET['dishId'];
    $q = "SELECT * FROM dishes WHERE d_id = $dishId";
    $result = mysqli_query($db, $q) or die(mysqli_error($db));

    // Fetch the details
    $dishDetails = mysqli_fetch_assoc($result);

    // Return the dish details as JSON
    header('Content-Type: application/json');
    echo json_encode($dishDetails);
} else {
    // If dishId parameter is not set, return an error or handle accordingly
    echo json_encode(["error" => "dishId parameter is missing"]);
}

// Close the database connection
mysqli_close($db);
?>