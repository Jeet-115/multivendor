<?php session_start(); ?><!DOCTYPE html>
<html lang="en">

<head>
  <?php require_once("inc/head.inc.php") ?>
</head>

<body class="index-page" data-bs-spy="scroll" data-bs-target="#navmenu">

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="container-fluid d-flex align-items-center justify-content-between">

    <?php require_once("inc/hungry.inc.php") ?>
    <?php require_once("inc/nav.inc.php") ?>  
    </div>
  </header><!-- End Header -->
  <section id="hero" class="hero">

      <img src="https://plus.unsplash.com/premium_photo-1661407772941-c5a2a5c9595b?q=80&w=1000&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8b2ZmaWNlJTIwZGFya3xlbnwwfHwwfHx8MA%3D%3D" alt="" data-aos="fade-in">

      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row">
          <div class="col-lg-10">
            <h2>Please select that are you a customer or a seller</h2>
            <form method="post">
    <button type="submit" name="site1" class="btn btn-outline-primary">CUSTOMER</button>
    <button type="submit" name="site2" class="btn btn-outline-success">SELLER</button>
  </form>

  <?php
    if (isset($_POST['site1'])) {
      header("Location: customer.php");
      exit();
    }

    if (isset($_POST['site2'])) {
      header("Location: seller.php");
      exit();
    }
  ?>
          </div>
          
        </div>
        
      </div>
      

    </section>
  <?php require_once("inc/footer.inc.php") ?>
</body>

</html>