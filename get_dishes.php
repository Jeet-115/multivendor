<?php
session_start();

// Include your database connection logic
require_once("inc/db.inc.php");

// Fetch dishes from the database (replace this with your actual query)
$q = "SELECT * FROM dishes";
$result = mysqli_query($db, $q) or die(mysqli_error($db));

// Create an array to store the dishes
$dishes = array();

// Fetch each row from the result set and add it to the dishes array
while ($row = mysqli_fetch_assoc($result)) {
    $dishes[] = $row;
}
// Return the dishes as JSON
header('Content-Type: application/json');
echo json_encode($dishes);
// Close the database connection
mysqli_close($db);


?>