<?php 

@include 'config.php';

session_start();
$user_id = $_SESSION['user_id'];
 $date = isset($_POST['date']) ? $_POST['date'] : date('Y-m-d');
 $currentDate = date('Y-m-d');


if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_POST['Confirm'])){

   $number = $_POST['number'];
   $method = $_POST['method'];
   $remark = $_POST['remark'];
   $address = $_POST['address'];
   $city = $_POST['city'];
   $state = $_POST['state'];
   $postcode = $_POST['postcode'];
   $grand_total = 0;

   $cart_query = mysqli_query($conn, "SELECT * FROM user_cart WHERE UserID = '$user_id'");
   if(mysqli_num_rows($cart_query) > 0){
      while($product_item = mysqli_fetch_assoc($cart_query)){
         $product_name[] = $product_item['ItemName'] .' ('. $product_item['Qty'] .') ';
         $product_price = number_format($product_item['ItemPrice'] * $product_item['Qty']);
         $grand_total += $product_price;
      };
   };
  
   
   //$total_product = implode(', ',$product_name);
   $detail_query = mysqli_query($conn, "INSERT INTO invoices (ServiceID, SalesDate, UserID, phonenumber, PaymentID, address, city, state, postcode, grand_total, PickUpDate) VALUES('$remark','$currentDate','$user_id','$number','$method','$address','$city','$state','$postcode','$grand_total', '$date')") or die('query failed');
	      
   $cart_query2 = mysqli_query($conn, "SELECT * FROM user_cart WHERE UserID = '$user_id'");	  
   if(mysqli_num_rows($cart_query2) > 0){
      while($product_item = mysqli_fetch_assoc($cart_query2)){
		  $ItemID = $product_item['ItemID'];
		  $Qty= $product_item['Qty'];
		 $cart = mysqli_query($conn, "INSERT INTO invdetails (ItemID , Qty ) VALUES ('$ItemID' , '$Qty')");
		$cart_run = mysqli_query($conn, $cart);
      };
   };

	$delete_cart = mysqli_query($conn, "DELETE FROM user_cart WHERE UserID= '$user_id'") or die("query failed");
	  
}else{
            $message[] = 'Checkout failed!';
      }
      


?>

<html>
  <head>
    <title>5YNDROME DOBI CHECKOUT PAGE</title>
    <link rel="stylesheet" href="css/checkout.css">
  </head>
  <body>
  
  <section class="checkout-form">

   <h1 class="heading">complete your order</h1>

   <form action="" method="post">

      <div class="flex">
         <div class="inputBox">
            <span>your number</span>
            <input type="number" placeholder="enter your number" name="number" required>
         </div>
         <div class="inputBox">
            <span>payment method</span>
            <select name="method">
               <option value="1" selected>cash on devlivery</option>
               <option value="2">credit card</option>
               <option value="3">online banking</option>
            </select>
         </div>
         <div class="inputBox">
            <span>Service Method</span>
            <select name="remark">
               <option value="1" selected>pickup and delivery</option>
               <option value="2">pickup</option>
               <option value="3">delivery</option>
            </select>
         </div>
		    <div class="inputBox">
            <span>Service Date</span>
			<input type='date' name="date" id='date' required class='form-control'>
         </div>

         <div class="inputBox">
            <span>address</span>
            <input type="text" placeholder="e.g. street name" name="address" required>
         </div>
		 
         <div class="inputBox">
            <span>city</span>
            <input type="text" placeholder="e.g. Kota Samarahan" name="city" required>
         </div>
		 
         <div class="inputBox">
            <span>state</span>
            <input type="text" placeholder="e.g. Sarawak" name="state" required>
         </div>
		 
         <div class="inputBox">
            <span>postcode</span>
            <input type="text" placeholder="e.g. 94300" name="postcode" required>
         </div>		 
      </div>

   </form>

</section>

<div class="container">

<section class="shopping-cart">


   <table>

      <thead>
         <th>image</th>
         <th>name</th>
         <th>price</th>
         <th>quantity</th>
      </thead>

      <tbody>

         <?php 
         
         $select_cart = mysqli_query($conn, "SELECT * FROM `user_cart` WHERE UserID = '$user_id'");
         $grand_total = 0;
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
         ?>

         <tr>
		 
            <td><img src="uploaded_img/<?php echo $fetch_cart['ItemPhoto']; ?>" height="90" width="90" alt="Service Photo"></td>
            <td><?php echo $fetch_cart['ItemName']; ?></td>
            <td>RM<?php echo number_format($fetch_cart['ItemPrice']); ?></td>
            <td>RM<?php echo $sub_total = number_format($fetch_cart['ItemPrice'] * $fetch_cart['Qty']); ?></td>
         </tr>
         <?php
           $grand_total += $sub_total;  
            };
         };
         ?>
         <tr class="table-bottom">
            <td colspan="3">grand total</td>
            <td>RM<?php echo $grand_total; ?></td>
         </tr>

      </tbody>

   </table> 

</section> 
   <div class="order_container">
      <a href="indexafter.php" button type="submit" name="Confirm" ><?= ($grand_total > 1)?'':'disabled'; ?>Confirm Checkout</a>
   </div>       
      
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
   
  </body>
</html>