<!-- Nav Menu -->
<nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="index.php" class="active">Home</a></li>
          <li><a href="AboutUs.php">About Us</a></li>
          <?php if (!isset($_SESSION["uid"])) { ?>
          <li><a href="register.php">Register</a></li>
          <li><a href="login.php">Login</a></li>
          <?php } ?>
          <?php if (isset($_SESSION["uid"])) { ?>
            <?php if ($_SESSION["user_type"] == "seller") { ?>
                <li><a href="restromanage.php">MANAGE DISHES</a></li>
            <?php } elseif ($_SESSION["user_type"] == "customer") { ?>
                <li><a href="placeorder.php">Place Order</a></li>
                <li><a href="cart.php">Cart</a></li>
            <?php } ?>
          <?php } ?>
          <li><a href="ContactUs.php">Contact Us</a></li>
          <?php if(isset($_SESSION["uid"])) { ?>
            <li><a href="logout.php">Logout</a></li>
          <?php } ?>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav><!-- End Nav Menu -->