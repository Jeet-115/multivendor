<?php session_start(); 

    

    //ToDo: Validate the data
    //ToDo: Validate the uploded 

    require_once("inc/db.inc.php");

    $q = "insert into customers (cus_name, cus_phone, cus_email, cus_pwd, cus_add) values ('".$_POST["name"]."','".$_POST["phone"]."','".$_POST["email"]."','".md5($_POST["password"])."','".$_POST["addr"]."')";

    mysqli_query($db, $q) or die(mysqli_error($db));

    header("location: customer.php"); exit;

?>