<?php

@include 'config.php';

session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:../addcart2.php');
};

$select = mysqli_query($conn, "SELECT Name FROM `users` WHERE UserID = '$user_id'") or die("query failed");
		if(mysqli_num_rows($select) > 0){
		$fetch = mysqli_fetch_assoc($select);
		}

if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = 1;


   $select_cart = mysqli_query($conn, "SELECT * FROM `user_cart` WHERE ItemName = '$product_name'");

   if(mysqli_num_rows($select_cart) > 0){
	   $insert_product = mysqli_query($conn, "UPDATE `user_cart` SET Qty = Qty+1 WHERE ItemName = '$product_name'");
      $message[] = 'Product was added to cart again succesfully';
   }else{
      $insert_product = mysqli_query($conn, "INSERT INTO `user_cart`(UserID, Qty ,ItemPhoto, ItemPrice, ItemName) VALUES('$user_id','$product_quantity', '$product_image','$product_price', '$product_name')");
      $message[] = 'Product added to cart succesfully';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
	<link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/service.css">
  <script src="https://kit.fontawesome.com/212d76f1f1.js" crossorigin="anonymous"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Climate+Crisis&family=Kaushan+Script&family=Press+Start+2P&display=swap" rel="stylesheet"> 
</head>
<body>
    <header>
        <div class="navbar">
        <a class="logo"><img src="img/SyndromeLogo.jpg" alt="Logo"><span>5YNDROME</span></a>
        <nav>
            <ul class="nav-links">
            <li><a href="indexafter.php">Home</a></li>
            <li><a href="aboutafter.php">About Us</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="contactafter.php">Contact</a></li>
            </ul>
        </nav>
        <div class="social-icons">
            <a href="cartafter.php"><i class="fa-solid fa-cart-shopping"></i></a>
            <a href="user.php"><i class="fa-regular fa-user"></i><span><?php echo $fetch['Name'];?></span></a>			
        </div>
        </div>
    </header>
   
<?php

if(isset($message)){
   foreach($message as $message){
      echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
   };
};
?>
  		<div class="menu_box">
		<!-- <input type="text" placeholder="Search service" name="search" ><i class="fa-solid fa-magnifying-glass"></i> -->
        <?php include 'searchbox.php'; ?>
		</div>
		
    <section class="service">
        <div class="title">
            <h2>Our Service</h2>
        </div>

        <div class="box">
            <div class="card">
                <img class="image" src="img/10_no_size.png">
                <h5>Wash & Dry Service</h5>
                <div class="pra">
                    <p>Experience lightning-fast drying and impeccable care with our Wash & Dry Service. Our cutting-edge technology and skilled professionals ensure your clothes are dried quickly, efficiently, and with utmost precision, so you can say goodbye to dampness and hello to perfectly dry garments every time.
                    </p>
                </div>
                <p style="text-align: center;">
                    <a class="button" href="#">Read More</a>
                </p>
            </div>

            <div class="card">
                <img class="image" src="img/11no_size.png">
                <h5>Wash, Dry & Fold Service</h5>
                <div class="pra">
                    <p>Say farewell to the tedious task of folding laundry with our convenient Wash, Dry & Fold Service. Our expert team meticulously folds your clothes with precision and care, delivering beautifully organized garments ready to be effortlessly put away in your wardrobe.
                    </p>
                </div>
                <p style="text-align: center;">
                    <a class="button" href="#">Read More</a>
                </p>
            </div>
			
            <div class="card">
                <img class="image" src="img/12no_size.png">
                <h5>Wash, Dry, Fold & Iron Service</h5>
                <div class="pra">
                    <p>
Experience the transformative power of our Wash, Dry, Fold & Iron Service. Our skilled professionals will expertly iron your garments, leaving them crisp, wrinkle-free, and ready to make a stylish impression, so you can confidently step out looking polished and put-together.
                    </p>
                </div>
                <p style="text-align: center;">
                    <a class="button" href="#">Read More</a>
                </p>
            </div>
        </div>
    </section>

    <section class="menu" id="Menu">
        <h1>Our Service</h1>
        <div class="menu_box">
            <?php
                $select_products = mysqli_query($conn, "SELECT * FROM `items`");
                if(mysqli_num_rows($select_products) > 0){
                    while($fetch_product = mysqli_fetch_assoc($select_products)){
                        $itemPhoto = $fetch_product['ItemPhoto']; 
                        $itemName = $fetch_product["ItemName"];
                        $itemDes = $fetch_product["ItemDes"];
                        $itemPrice = $fetch_product["ItemPrice"];
            // Generate the HTML for the menu item ?>
            <form action="" method="POST">
                <div class="menu-card">
                    <div class="menu_image">
					<br>
					<img alt="Service Photo" width="300" height="200"<?php echo"<img src='img/$itemPhoto'";?>> 
                        <input type="hidden" name="product_image" value="<?php echo $itemPhoto; ?>">
                    </div>
                    <div class="menu_info">
                        <h3><?php echo "$itemName" ?></h3>
                        <input type="hidden" name="product_name" value="<?php echo $itemName; ?>">
                        <h3><?php echo "RM $itemPrice" ?></h3>
                        <input type="hidden" name="product_price" value="<?php echo $itemPrice; ?>">
                        <input type="submit" class="menu_btn" value="add to cart" name="add_to_cart">
                    </div>
                </div>
            </form>
            <?php
                    }
                } else {
                    echo "No service available.";
                }?>
			</div>	
        </section>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>