<?php
session_start();
require_once("inc/db.inc.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $dishId = $_POST["dishId"];
    $dname = $_POST["dname"];
    $dprice = $_POST["dprice"];
    $ddesc = $_POST["ddesc"];

    $q = "UPDATE dishes SET d_name='$dname', d_price='$dprice', d_desc='$ddesc' WHERE d_id=$dishId";
    $result = mysqli_query($db, $q);

    if ($result) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["error" => "Failed to update dish"]);
    }

    exit;
} else {
    echo json_encode(["error" => "Invalid request"]);
}
?>