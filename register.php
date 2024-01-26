<?php

include 'config.php';

if(isset($_POST['registerbtn'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pw = mysqli_real_escape_string($conn, md5($_POST['password']));


   $select = mysqli_query($conn, "SELECT * FROM `users` WHERE Email = '$email' || Name = '$name'") or die("query failed");

   if(mysqli_num_rows($select) > 0){
      $message[] = 'user already exist'; 
   }else{
         $insert = mysqli_query($conn, "INSERT INTO `users`(Name, Email, Password) VALUES('$name', '$email', '$pw')") or die("query failed");

         if($insert){
            $message[] = 'registered successfully!';
            header('location:login.php');
         }else{
            $message[] = 'registration failed!';
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
    <title>Register Form</title>
    <link rel="stylesheet" href="css/login.css">
	<link rel="stylesheet" href="css/register.css">
</head>
<body>
    <section>
        <div class="form-box">
            <div class="form-value">
                <form action="" method="post">
				<?php
				if(isset($message)){
					foreach($message as $message){
						echo '<div class="message">'.$message.'</div>';
					}
				}
				?>
                    <h2>Register</h2>
                    <div class="inputbox">
                        <ion-icon name="person-outline"></ion-icon>
                        <input type="text" name="name" required>
                        <label for="name">UserName</label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="mail-outline"></ion-icon>
                        <input type="email" name="email" required>
                        <label for="email">Email</label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="lock-closed-outline"></ion-icon>
						<input type="password" id="pw" name="password" pattern="(?=.*\d)(?=.*[A-Z])(?=.*[^a-zA-Z0-9\s])(?!.*\s).{6,}" 
						title="Must contain at least one numeric, one uppercase letter, one special character, at least 6 or more characters and no space." required>
                        <label for="password">Password</label>				
                    </div>
                    <a href="login.html">
                        <button type="submit" name="registerbtn" >Register</button>
                    </a>
                    <div class="register">
                        <p>Already have account? <a href="login.php">Login</a></p>
                    </div>	  
                </form>
            </div>
        </div>
    </section>
					<div id="validation">
					  <h3>Password must contain the following:</h3>
					  <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
					  <p id="scharacter" class="invalid">A <b>special character</b></p>
					  <p id="number" class="invalid">A <b>number</b></p>
					  <p id="length" class="invalid">Minimum <b>6 characters</b></p>
					  <p id="space" class="invalid"><b>No space</b></p>
					</div>					
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://unpkg.com/scrollreveal"></script>	
    <script src="js/login.js"></script>
</body>
</html>