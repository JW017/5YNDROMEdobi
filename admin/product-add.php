<?php

@include '../config.php';

if(isset($_POST['add_product'])){
   $p_name = $_POST['p_name'];
   $p_desc = $_POST['p_desc'];
   $p_price = $_POST['p_price'];
   $p_image = $_FILES['p_image']['name'];
   $p_image_tmp_name = $_FILES['p_image']['tmp_name'];
   $p_image_folder = '../uploaded_img/'.$p_image;

   $insert_query = mysqli_query($conn, "INSERT INTO `items`(ItemName, ItemDes, ItemPrice, ItemPhoto) VALUES('$p_name','$p_desc', '$p_price', '$p_image')") or die('query failed');

   if($insert_query){
      move_uploaded_file($p_image_tmp_name, $p_image_folder);
      $message[] = 'product add succesfully';
      header('location:products.php');
   }else{
      $message[] = 'could not add the product';
      header('location:products.php');
   }
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin panel</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/style-admin.css">
   <link rel="stylesheet" href="../css/admin.css">

</head>
<body>
    <div class="grid-container">
        <!-- Content Header/Sidebar -->
        <?php include 'navibars.php'; ?>
        <!-- End of Content Header/Sidebar -->

        <!-- Main Content -->
        <main class="main-container">
            
        <div class="container">

            <section>

            <form action="" method="post" class="add-product-form" enctype="multipart/form-data">
            <h3>add a new product</h3>
            <input type="text" name="p_name" placeholder="enter the product name" class="box" required>
            <input type="text" name="p_desc" placeholder="enter the description name" class="box" required>
            <input type="number" name="p_price" min="0" placeholder="enter the product price" class="box" required>
            <input type="file" name="p_image" accept="image/png, image/jpg, image/jpeg" class="box" required>
            <input type="submit" value="add the product" name="add_product" class="btn">
            </form>

            </section>

        </div>

        </main>
        <!-- End of Main Content -->
    </div>
    

    <!-- Custom JS -->
    <script src="../js/script-admin.js"></script>
</body>
</html>