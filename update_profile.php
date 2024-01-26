<?php

include 'config.php';
session_start();

$user_id = $_SESSION['user_id'];


if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_POST['update_profile'])){

   $update_name = mysqli_real_escape_string($conn, $_POST['update_name']);
   $update_email = mysqli_real_escape_string($conn, $_POST['update_email']);
   $update_dob = mysqli_real_escape_string($conn, $_POST['update_dob']);
   $update_address = mysqli_real_escape_string($conn, $_POST['update_address']);
   $update_phone = mysqli_real_escape_string($conn, $_POST['update_phone']);
   
   mysqli_query($conn, "UPDATE `users` SET Name = '$update_name', Email = '$update_email', DateOfBirth = '$update_dob', Address = '$update_address', PhoneNum = '$update_phone' WHERE UserID = '$user_id'") or die('query failed');

   $old_pw = $_POST['old_pw'];
   $update_pw = mysqli_real_escape_string($conn, ($_POST['update_pw']));
   $new_pw = mysqli_real_escape_string($conn, ($_POST['new_pw']));
   $confirm_pw = mysqli_real_escape_string($conn, ($_POST['confirm_pw']));

   if(!empty($update_pw) || !empty($new_pw) || !empty($confirm_pw)){
      if($update_pw != $old_pw){
         $message[] = 'current password not matched!';
      }elseif($new_pw != $confirm_pw){
         $message[] = 'confirm password not matched!';
      }else{
         mysqli_query($conn, "UPDATE `users` SET Password = '$confirm_pw' WHERE UserID = '$user_id'") or die('query failed');
         $message[] = 'password updated successfully!';
      }
   }

   $update_image = $_FILES['update_image']['name'];
   $update_image_size = $_FILES['update_image']['size'];
   $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
   $update_image_folder = 'uploaded_img/'.$update_image;

   if(!empty($update_image)){
      if($update_image_size > 2000000){
         $message[] = 'image is too large';
      }else{
         $image_update_query = mysqli_query($conn, "UPDATE `users` SET image = '$update_image' WHERE UserID = '$user_id'") or die('query failed');
         if($image_update_query){
            move_uploaded_file($update_image_tmp_name, $update_image_folder);
         }
         $message[] = 'image updated succssfully!';
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>update profile</title>
	<link rel="stylesheet" href="css/checkout.css">


</head>
<body>
   
<div class="update-profile">

   <?php
      $select = mysqli_query($conn, "SELECT * FROM `users` WHERE UserID = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select) > 0){
         $fetch = mysqli_fetch_assoc($select);
      }
   ?>

   <form action="" method="post" enctype="multipart/form-data">
         <?php
         if($fetch['Image'] == ''){
			
            echo '<img class="image" src="img/default-avatar.png">';
         }else{
            echo '<img src="uploaded_img/'.$fetch['Image'].'">';
         }
         if(isset($message)){
            foreach($message as $message){
               echo '<div class="message">'.$message.'</div>';
            }
         }
      ?>
    <section class="checkout-form">
   <form action="" method="post">

      <div class="flex">
         <div class="inputBox">
            <span>Username :</span>
			<input type="text" name="update_name" value="<?php echo $fetch['Name']; ?>" class="box">
         </div>
	  
         <div class="inputBox">
            <span>Your Email :</span>
            <input type="email" name="update_email" value="<?php echo $fetch['Email']; ?>" class="box">
         </div>
		 
         <div class="inputBox">
		 <span>Update Profile Picture : </span>
		 <input type="file" name="update_image" accept="img/jpg, img/jpeg, img/png" class="box">
         </div>
		 
		   <div class="inputBox">
            <span>DateOfBirth :</span>
			<input type="date" id="start_date" name="update_dob" value="<?php echo $fetch['DateOfBirth']; ?>"required>
         </div>

         <div class="inputBox">
            <span>Address :</span>
            <input type="text" name="update_address" value="<?php echo $fetch['Address']; ?>" class="box">
         </div>
		 
         <div class="inputBox">
            <span>PhoneNum :</span>
            <input type="text" name="update_phone" value="<?php echo $fetch['PhoneNum']; ?>" class="box">
         </div>
		 
         <div class="inputBox">
			<div class="inputBox">
            <input type="hidden" name="old_pw" value="<?php echo $fetch['Password']; ?>">
			</div>
			
			<div class="inputBox">
            <span>old password :</span>
            <input type="password" name="update_pw" placeholder="enter previous password" class="box">
			</div>
			
			<div class="inputBox">
            <span>new password :</span>
            <input type="password" name="new_pw" placeholder="enter new password" class="box">
			</div>
			
			<div class="inputBox">
            <span>confirm password :</span>
            <input type="password" name="confirm_pw" placeholder="confirm new password" class="box">
         </div>
      </div>

   </form>

</section>

      <div class="inputBox">
      <input type="submit" value="update profile" name="update_profile" class="btn">
	  </div>
	   <div class="inputBox">
      <a href="user.php" class="btn">go back</a>
	  </div>
   </form>

</div>

</body>
</html>