<?php session_start(); 

    

    //ToDo: Validate the data
    //ToDo: Validate the uploded 

    require_once("inc/db.inc.php");

    $q = "insert into sellers (sel_name, sel_phone, sel_email, sel_pwd, sel_restro, sel_addr) values ('".$_POST["name"]."','".$_POST["phone"]."','".$_POST["email"]."','".md5($_POST["password"])."', '".$_POST["restro"]."', '".$_POST["addr"]."')";

    mysqli_query($db, $q) or die(mysqli_error($db));

    header("location: seller.php"); exit;

?>