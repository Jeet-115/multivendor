<?php session_start(); ?><!DOCTYPE html>
<html lang="en">

<head>
<style>
    .hero{
    background-image: url('https://wallpapers.com/images/featured/business-jzw8ax93flqonkce.jpg');  /* Replace 'path/to/your/image.jpg' with the actual path to your image file */
    background-size: cover; /* You can use 'contain' or other values depending on your preference */
    background-repeat: no-repeat;
    background-attachment: fixed; /* This makes the background image fixed while scrolling */
    animation: fadeIn 4s ease;
    display: flex;
    justify-content:center;
    
}
.Form {
  width: 500px;
  margin: 0 auto;
  text-align: center; /* Center the buttons horizontally */
}

.Form label {
  display: block;
  margin-bottom: 5px;
}

.Form input,
.Form textarea {
  width: 100%;
  padding: 5px;
  margin-bottom: 10px;
}

.Form textarea {
  height: 100px; /* Set the desired height for the textarea */
}

.form-control {
  color: red;
}

.Form .btn-group {
  margin-top: 20px;
  text-align: center; /* Center the buttons horizontally */
}

.Form .btn-group button {
  width: 100px;
  margin: 0 auto; /* Center the buttons horizontally */
}
  </style>
  <?php require_once("inc/rmhead.inc.php") ?>
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
    <div class="container">
      <h2 data-aos="fade-up" data-aos-delay="100">SELLER PLEASE FILL YOUR DETAILS</h2>
      <div class="col-lg-12 entries">
      <form action="process_seller.php" method="post" enctype='multipart/form-data'  data-aos="fade-up" data-aos-delay="100">
<hr>
<div class="mb-3 Form">
  <label>Name</label>
  <input name="name" type="text" class="form-control">
</div>

<div class="mb-3 Form">
  <label>Email</label>
  <input name="email" type="text" class="form-control">
</div>

<div class="mb-3 Form">
  <label>Phone</label>
  <input name="phone" type="text" class="form-control">
</div>

<div class="mb-3 Form">
  <label>Password</label>
  <input name="password" type="password" class="form-control">
</div>

<div class="mb-3 Form">
  <label>Confirm Password</label>
  <input name="confirm_password" type="password" class="form-control">
</div>

<div class="mb-3 Form">
  <label>Restraunt Name</label>
  <input name="restro" type="text" class="form-control">
</div>

<div class="mb-3 Form">
  <label>Restraunt Address</label>
  <textarea name="addr" class="form-control"></textarea>
</div>


<div class="mb-3 Form">
<div class="mb-3 btn-group" role="group" aria-label="Basic mixed styles example">
  <button type="reset" class="btn btn-danger">Reset</button>
  <button type="submit" class="btn btn-success">Save</i> </button>
</div>
</div>
<hr>
</form>
      </div>

    </section><!-- End Hero Section -->
  </main>
  <?php require_once("inc/footer.inc.php") ?>
</body>

</html>