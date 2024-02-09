<?php
session_start();

// Include your database connection logic
require_once("inc/db.inc.php");

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Handle file upload
    $targetDirectory = "photos/";
    
    // Ensure the "photos" directory exists
    if (!file_exists($targetDirectory)) {
        mkdir($targetDirectory, 0777, true);
    }

    $dishPhoto = $targetDirectory . basename($_FILES["dphoto"]["name"]);

    // Validate file type (you can add more validations as needed)
    $imageFileType = strtolower(pathinfo($dishPhoto, PATHINFO_EXTENSION));
    $allowedExtensions = ["jpg", "jpeg", "png", "gif"];

    if (!in_array($imageFileType, $allowedExtensions)) {
        header("HTTP/1.1 400 Bad Request");
        exit("Invalid file type. Allowed file types: jpg, jpeg, png, gif");
    }

    // Move the uploaded file to the "photos" directory
    move_uploaded_file($_FILES["dphoto"]["tmp_name"], $dishPhoto);

    // Insert the new dish into the database
    $q = "INSERT INTO dishes (d_name, d_price, d_desc, d_photo) VALUES ('" . $_POST["dname"] . "','" . $_POST["dprice"] . "','" . $_POST["ddesc"] . "', '$dishPhoto')";
    mysqli_query($db, $q) or die(mysqli_error($db));

    // Return the last inserted dish ID as JSON
    $lastInsertId = mysqli_insert_id($db);
    echo json_encode(["dishId" => $lastInsertId]);

    exit;
} else {
    // If the form was not submitted via POST, redirect to an error page or handle accordingly
    header("HTTP/1.1 400 Bad Request");
    exit("Invalid request");
}
?>