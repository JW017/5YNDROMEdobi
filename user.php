<?php

include 'config.php';

session_start();
$user_id = $_SESSION['user_id'];


if(!isset($user_id)){
   header('location:login.php');
};
		 // make SQL query
        $sql = "SELECT * FROM `users` WHERE UserID = '$user_id';";

        // get the query result
        $result = mysqli_query($conn, $sql);

        // fetch result in array format
        $fetch = mysqli_fetch_assoc($result);

        $Image = $fetch['Image'];
        $Name = $fetch['Name'];
        $Email = $fetch['Email'];
        $DateOfBirth = $fetch['DateOfBirth'];
        $Address = $fetch['Address'];
		$PhoneNum = $fetch['PhoneNum'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile Page</title>
    <!-- Montserrat Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <link rel="stylesheet" href="css/test.css">
    <link rel="stylesheet" href="css/user-style.css">
    <link rel="stylesheet" href="css/style-admin.css">
</head>
<body>
    <div class="grid-container">
        <!-- Content Header/Sidebar -->
        <?php include 'navibars.php'; ?>
        <!-- End of Content Header/Sidebar -->

        <!-- Main Content -->
        <main class="main-container">
            <div class="container">
                <div class="main-title">
                    <p class="font-weight-bold">REGISTERED USERS</p>
                </div>
                <div class="main-white">
                    <br>
                    <div class="box">
                        <div class="main-white">
   <div class="profile">
      <?php
         if(('$Image') == ''){
            echo '<img src="default-avatar.png">';
         }else{
            echo '<img src="uploaded_img/'.('$Image').'">';
         }
      ?>

      <h3><?php echo ($Name); ?></h3>
	  <h4><?php echo ($Email); ?></h4>
	  <h4><?php echo ($DateOfBirth); ?></h4>
	  <h4><?php echo ($Address); ?></h4>
	  <h4><?php echo ($PhoneNum); ?></h4>		
 
      <a href="update_profile.php" class="btn">update profile</a>
   </div>
   
                        </div>
                    </div>
                </div>
            </div>  
        </main>
        <!-- End of Main Content -->
    </div>
    

    <!-- Custom JS -->
    <script src="js/script-admin.js"></script>
    <script src="js/users.js"></script>
</body>
</html>