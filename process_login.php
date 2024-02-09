<?php session_start();

    //Todo: validate

    require_once("inc/db.inc.php");

    $email = $_POST["email"];
$password = md5($_POST["pwd"]);

// Check customers table
$q_customers = "SELECT * FROM customers WHERE cus_email = '$email' AND cus_pwd = '$password'";
$res_customers = mysqli_query($db, $q_customers) or die(mysqli_error($db));

// Check sellers table
$q_sellers = "SELECT * FROM sellers WHERE sel_email = '$email' AND sel_pwd = '$password'";
$res_sellers = mysqli_query($db, $q_sellers) or die(mysqli_error($db));

if (mysqli_num_rows($res_customers) > 0) {
    // Login as customer
    $row = mysqli_fetch_assoc($res_customers);
    $_SESSION["uid"] = $row["cus_id"];
    $_SESSION["unm"] = $row["cus_name"];
    $_SESSION["user_type"] = "customer";
    header("location: index.php");
    exit;
} elseif (mysqli_num_rows($res_sellers) > 0) {
    // Login as seller
    $row = mysqli_fetch_assoc($res_sellers);
    $_SESSION["uid"] = $row["sel_id"];
    $_SESSION["unm"] = $row["sel_name"];
    $_SESSION["user_type"] = "seller";
    header("location: index.php");
    exit;
} else {
    // Wrong data. Display an error message or redirect to an error page.
    die("Wrong data. Try again");
}
?>