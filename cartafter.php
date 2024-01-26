<?php

include 'config.php';

session_start();
$user_id = $_SESSION['user_id'];

$select = mysqli_query($conn, "SELECT Name FROM `users` WHERE UserID = '$user_id'") or die("query failed");
		if(mysqli_num_rows($select) > 0){
		$fetch = mysqli_fetch_assoc($select);
		}

if(isset($_POST['update_item_btn'])){
   $update_value = $_POST['update_quantity'];
   $update_id = $_POST['update_quantity_id'];
   $update_quantity_query = mysqli_query($conn, "UPDATE `user_cart` SET Qty = '$update_value' WHERE ItemID = '$update_id'");
   if($update_quantity_query){
      header('location:cartafter.php');
   };
};

if(isset($_GET['remove'])){
   $remove_id = $_GET['remove'];
   mysqli_query($conn, "DELETE FROM `user_cart` WHERE ItemID = '$remove_id'");
   header('location:cartafter.php');
};

if(isset($_GET['delete_all'])){
   mysqli_query($conn, "DELETE FROM `user_cart`");
   header('location:cartafter.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>shopping cart</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href=" css/cartstyle.css">
   <link rel="stylesheet" href=" css/ccart.css">

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
          <li><a href="contactafter.php">Contact</a></li>
        </ul>
      </nav>
      <div class="social-icons">
        <a href="#"><i class="fa-solid fa-cart-shopping"></i></a>
        <a href="user.php"><i class="fa-regular fa-user"></i><span><?php echo $fetch['Name'];?></span></a>
      </div>
    </div>
  </header>

<div class="container">

<section class="shopping-cart">

   <h1 class="heading">shopping cart</h1>

   <table>

      <thead>
         <th>image</th>
         <th>name</th>
         <th>price</th>
         <th>quantity</th>
         <th>total price</th>
         <th>action</th>
      </thead>

      <tbody>

         <?php 
         
         $select_cart = mysqli_query($conn, "SELECT * FROM `user_cart` WHERE UserID = '$user_id'");
         $grand_total = 0;
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
         ?>

         <tr>
		 
            <td><img src="img/<?php echo $fetch_cart['ItemPhoto']; ?>" height="100" alt="Service Photo"></td>
            <td><?php echo $fetch_cart['ItemName']; ?></td>
            <td>RM<?php echo number_format($fetch_cart['ItemPrice']); ?></td>
            <td>
               <form action="" method="post">
                  
                  <input type="number" name="update_quantity" min="1"  value="<?php echo $fetch_cart['Qty']; ?>" >
                  <input type="submit" value="update" name="update_item_btn">
               </form>   
            </td>
            <td>RM<?php echo $sub_total = number_format($fetch_cart['ItemPrice'] * $fetch_cart['Qty']); ?></td>
            <td><a href="cartafter.php?remove=<?php echo $fetch_cart['ItemID']; ?>" onclick="return confirm('remove item from cart?')" class="delete-btn"> <i class="fas fa-trash"></i> remove</a></td>
         </tr>
         <?php
           $grand_total += $sub_total;  
            };
         };
         ?>
         <tr class="table-bottom">
            <td><a href="addcart2after.php" class="option-btn" style="margin-top: 0;">continue shopping</a></td>
            <td colspan="3">grand total</td>
            <td>RM<?php echo $grand_total; ?></td>
            <td><a href="cartafter.php?delete_all" onclick="return confirm('are you sure you want to delete all?');" class="delete-btn"> <i class="fas fa-trash"></i> delete all </a></td>
         </tr>

      </tbody>

   </table>

   <div class="checkout-btn">
      <a href="checkout.php" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>">procced to checkout</a>
   </div>

</section>

</div>
   
<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
