<?php

include 'config.php';

session_start();

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $pw = mysqli_real_escape_string($conn,md5($_POST['password']));

   $select = mysqli_query($conn, "SELECT * FROM `users` WHERE Name = '$name' AND Password = '$pw'") or die("query failed");
   $check = mysqli_query($conn, "SELECT Name FROM `users` WHERE Name = '$name'") or die("query failed");

   if(mysqli_num_rows($select) > 0){
      $row = mysqli_fetch_assoc($select);
      $_SESSION['user_id'] = $row['UserID'];
      header('location:indexafter.php');
   }
   else{
	  if(!mysqli_num_rows($check)){
      $message[] = 'unregistered username!';
   }
    else{$message[] = 'incorrect username or password!';
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
    <title>Login Form</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <section>
        <div class="form-box" style="height: 450px ;">
            <div class="form-value">
                <form action="" method="post">
                    <h2>Login</h2>
					<?php
					  if(isset($message)){
						 foreach($message as $message){
							echo '<div class="message">'.$message.'</div>';
						 }
					  }
					?>
                    <div class="inputbox">
                        <ion-icon name="person-outline"></ion-icon>
                        <input type="text" name="name" required>
                        <label for="name">UserName</label>
                    </div>
                    
                    <div class="inputbox">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input type="password" name="password" required>
                        <label for="password">Password</label>
                    </div>
                    <div class="forget">
                        <label for=""><input type="checkbox">Remember Me</label>
                          <a href="#">Forget Password</a>
                      
                    </div>
                    <button type="submit" name="submit">Log in</button>
                    <div class="register">
                        <p>Don't have a account? <a href="register.php">Register</a></p>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="js/login.js"></script>
</body>
</html>