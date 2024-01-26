<?php

@include 'config.php';

session_start();
$user_id = $_SESSION['user_id'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>5YNDROME</title>
  <link rel="stylesheet" href="css/style.css">
  <script src="https://kit.fontawesome.com/212d76f1f1.js" crossorigin="anonymous"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Climate+Crisis&family=Kaushan+Script&family=Press+Start+2P&display=swap" rel="stylesheet"> 
  <link href="https://fonts.googleapis.com/css2?family=Comme:wght@400;700&family=Josefin+Sans:ital,wght@0,400;0,700;1,400;1,700&family=Quicksand:wght@400;700&display=swap" rel="stylesheet">
  
</head>
<body>
  <header>
    <div class="navbar">
      <a href="#" class="logo"><img src="img/SyndromeLogo.jpg" alt="Logo"><span>5YNDROME</span></a>
      <nav>
        <ul class="nav-links">
          <li><a href="#">Home</a></li>
          <li><a href="about.html">About Us</a></li>
          <li><a href="addcart2.php">Services</a></li>
          <li><a href="contact.html">Contact</a></li>
        </ul>
      </nav>
      <div class="social-icons">
        <a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a>
        <a href="login.php"><i class="fa-regular fa-user"></i><span>Login/Register</span></a>
      </div>
    </div>
  </header>

  <section class="dobi">
    
    <div class="dobi-text">
      <h1>Freshness that lasts, quality that counts.</h1>
        <p>5YNDROME is a professional cleaning service in Kota Samarahan, Sarawak that provides services ranging from simple laundry to dry cleaning, ironing, and folding,
          as well as self-pick-up and delivery services.
        </p>
        <a href="about.html">Learn More &nbsp; &gt;</a>
    </div>

    <div class="dobi-img">
        <img src="img/intro1.jpg">
    </div>

  </section>

  <footer class="brief-intro">
    <p>
      &#169; 2023 &nbsp; 5YNDROME &nbsp; &nbsp; &nbsp; All Rights Reserved.
    </p>
  </footer>

  <script src="https://unpkg.com/scrollreveal"></script>
  <script src="js/script.js"></script>

</body>
</html>