<?php

include 'config.php';

session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:contact.html');
};

$select = mysqli_query($conn, "SELECT Name FROM `users` WHERE UserID = '$user_id'") or die("query failed");
		if(mysqli_num_rows($select) > 0){
		$fetch = mysqli_fetch_assoc($select);
		}
?>

<!DOCTYPE html>
<html>
<head>
	<!-- *******  Link To CSS Style Sheet  ******* -->
	<link rel="stylesheet" type="text/css" href="css/contact.css">

	<!-- *******  Font Awesome Icons Link  ******* -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>

	<!-- *******  Link To Goggle Fonts  *******  -->
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,400;0,500;0,600;0,800;1,900&display=swap" rel="stylesheet">

	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<script src="https://kit.fontawesome.com/212d76f1f1.js" crossorigin="anonymous"></script>
	<link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Climate+Crisis&family=Kaushan+Script&family=Press+Start+2P&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css2?family=Comme:wght@400;700&family=Josefin+Sans:ital,wght@0,400;0,700;1,400;1,700&family=Quicksand:wght@400;700&display=swap" rel="stylesheet">

	<title>Contact Section</title>
</head>
<body>
	<header>
		<div class="navbar">
		  <a class="logo"><img src="img/SyndromeLogo.jpg" alt="Logo"><span>5YNDROME</span></a>
		  <nav>
			<ul class="nav-links">
			  <li><a href="indexafter.php">Home</a></li>
			  <li><a href="aboutafter.php">About Us</a></li>
			  <li><a href="addcart2after.php">Services</a></li>
			  <li><a href="#">Contact</a></li>
			</ul>
		  </nav>
		  <div class="social-icons">
			<a href="cartafter.php"><i class="fa-solid fa-cart-shopping"></i></a>
			<a href="user.php"><i class="fa-regular fa-user"></i><span><?php echo $fetch['Name'];?></span></a>
		  </div>
		</div>
	  </header>
	<div class="container">
		<main class="row">
			
			<!--  *******   Left Section (Column) Starts   *******  -->

			<section class="col left">
				
				<!--  *******   Title Starts   *******  -->

				<div class="contactTitle">
					<h2>Get In Touch</h2>
					<p>Experience the convenience and quality of our service today!</p>
				</div>

				<!--  *******   Title Ends   *******  -->

				<!--  *******   Contact Info Starts   *******  -->

				<div class="contactInfo">
					
					<div class="iconGroup">
						<div class="icon">
							<i class="fa-solid fa-phone"></i>
						</div>
						<div class="details">
							<span>Phone</span>
							<span>+6011 5687 0000</span>
						</div>
					</div>

					<div class="iconGroup">
						<div class="icon">
							<i class="fa-solid fa-envelope"></i>
						</div>
						<div class="details">
							<span>Email</span>
							<span>5yndrome2023@gmail.com</span>
						</div>
					</div>

					<div class="iconGroup">
						<div class="icon">
							<i class="fa-solid fa-location-dot"></i>
						</div>
						<div class="details">
							<span>Location</span>
							<span>Jln Datuk Mohammad Musa, 94300 Kota Samarahan, Sarawak</span>
						</div>
					</div>

				</div>

				<!--  *******   Contact Info Ends   *******  -->

				<!--  *******   Social Media Starts   *******  -->

				<div class="socialMedia">
					<a href="#"><i class="fa-brands fa-facebook-f"></i></a>
					<a href="#"><i class="fa-brands fa-twitter"></i></a>
					<a href="#"><i class="fa-brands fa-instagram"></i></a>
					<a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
				</div>

				<!--  *******   Social Media Ends   *******  -->

			</section>

			<!--  *******   Left Section (Column) Ends   *******  -->

			<!--  *******   Right Section (Column) Starts   *******  -->

			<section class="col right">
				
				<!--  *******   Form Starts   *******  -->

				<form class="messageForm">
					
					<div class="inputGroup halfWidth">
						<input type="text" name="" required="required">
						<label>Your Name</label>
					</div>

					<div class="inputGroup halfWidth">
						<input type="email" name="" required="required">
						<label>Email</label>
					</div>

					<div class="inputGroup fullWidth">
						<input type="text" name="" required="required">
						<label>Subject</label>
					</div>

					<div class="inputGroup fullWidth">
						<textarea required="required"></textarea>
						<label>Say Something</label>
					</div>

					<div class="inputGroup fullWidth">
						<button>Send Message</button>
					</div>

				</form>

				<!--  *******   Form Ends   *******  -->
			</section>

			<!--  *******   Right Section (Column) Ends   *******  -->

		</main>
	</div>

	<script src="https://unpkg.com/scrollreveal"></script>
  	<script src="js/contact.js"></script>

</body>
</html>