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

  <main id="main">

    <!-- Hero Section - Home Page -->
    <section id="hero" class="hero">

      <img src="https://images.unsplash.com/photo-1589010588553-46e8e7c21788?q=80&w=1000&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8Zm9vZCUyMGRlbGl2ZXJ5fGVufDB8fDB8fHww" alt="" data-aos="fade-in">

      <div class="container">
        <div class="row">
          <div class="col-lg-10">
            <h2 data-aos="fade-up" data-aos-delay="100">WELCOME TO OUR FOOD SERVICE WEBSITE</h2>
            <p data-aos="fade-up" data-aos-delay="200">This is a multipurpose website used by both customers and sellers</p>
          </div>
          
        </div>
      </div>

    </section><!-- End Hero Section -->
  </main>
  <?php require_once("inc/footer.inc.php") ?>
</body>

</html>