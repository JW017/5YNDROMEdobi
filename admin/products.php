<?php

@include '../config.php';


if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_query = mysqli_query($conn, "DELETE FROM `items` WHERE ItemID = $delete_id ") or die('query failed');
   if($delete_query){
      header('location:products.php');
      $message[] = 'product has been deleted';
   }else{
      header('location:products.php');
      $message[] = 'product could not be deleted';
   };
};

if(isset($_POST['update_product'])){
   $update_p_id = $_POST['update_p_id'];
   $update_p_name = $_POST['update_p_name'];
   $update_p_desc = $_POST['update_p_desc'];
   $update_p_price = $_POST['update_p_price'];
   $update_p_image = $_FILES['update_p_image']['name'];
   $update_p_image_tmp_name = $_FILES['update_p_image']['tmp_name'];
   $update_p_image_folder = '../uploaded_img/'.$update_p_image;

   $update_query = mysqli_query($conn, "UPDATE `items` SET ItemName = '$update_p_name', ItemDes = '$update_p_desc', ItemPrice = '$update_p_price', ItemPhoto = '$update_p_image' WHERE ItemID = '$update_p_id'");

   if($update_query){
      move_uploaded_file($update_p_image_tmp_name, $update_p_image_folder);
      $message[] = 'product updated succesfully';
      header('location:products.php');
   }else{
      $message[] = 'product could not be updated';
      header('location:products.php');
   }

}

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
            <br>
            <div class="main-title">
                <p class="font-weight-bold">PRODUCTS</p>
            </div>
            <br>
            <div class="main-white">
                <section>
                    <a href="product-add.php ">
                        <input type="submit" value="add the product" name="add_product" class="btn">
                    </a>  
                </section>
                <section class="display-product-table">
                    <table>
                        <thead>
                            <th>product image</th>
                            <th>product name</th>
                            <th>product description</th>
                            <th>product price</th>
                            <th>action</th>
                        </thead>
                        <tbody>
                            <?php
                            
                                $select_products = mysqli_query($conn, "SELECT * FROM `items`");
                                if(mysqli_num_rows($select_products) > 0){
                                while($row = mysqli_fetch_assoc($select_products)){
                            ?>
                            <tr>
                                <td><img src="../uploaded_img/<?php echo $row['ItemPhoto']; ?>" height="100" alt=""></td>
                                <td><?php echo $row['ItemName']; ?></td>
                                <td><?php echo $row['ItemDes']; ?></td>
                                <td>RM <?php echo $row['ItemPrice']; ?></td>
                                <td>
                                <a href="products.php?delete=<?php echo $row['ItemID']; ?>" class="delete-btn" onclick="return confirm('are your sure you want to delete this?');"> <i class="fas fa-trash"></i> delete </a>
                                <a href="products.php?edit=<?php echo $row['ItemID']; ?>" class="option-btn"> <i class="fas fa-edit"></i> update </a>
                                </td>
                            </tr>
                            <?php
                                };    
                                }else{
                                echo "<div class='empty'>no product added</div>";
                                };
                            ?>
                        </tbody>
                    </table>
                </section>
                <section class="edit-form-container">
                    <?php
                    if(isset($_GET['edit'])){
                        $edit_id = $_GET['edit'];
                        $edit_query = mysqli_query($conn, "SELECT * FROM `items` WHERE ItemID = $edit_id");
                        if(mysqli_num_rows($edit_query) > 0){
                            while($fetch_edit = mysqli_fetch_assoc($edit_query)){
                    ?>

                    <form action="" method="post" enctype="multipart/form-data">
                        <img src="../uploaded_img/<?php echo $fetch_edit['ItemPhoto']; ?>" height="200" alt="">
                        <input type="hidden" name="update_p_id" value="<?php echo $fetch_edit['ItemID']; ?>">
                        <input type="text" class="box" required name="update_p_name" value="<?php echo $fetch_edit['ItemName']; ?>">
                        <input type="text" class="box" required name="update_p_desc" value="<?php echo $fetch_edit['ItemDes']; ?>">
                        <input type="number" min="0" class="box" required name="update_p_price" value="<?php echo $fetch_edit['ItemPrice']; ?>">
                        <input type="file" class="box" required name="update_p_image" accept="image/png, image/jpg, image/jpeg">
                        <input type="submit" value="update the product" name="update_product" class="btn">
                        <input type="reset" value="cancel" id="close-edit" class="option-btn">
                    </form>
                    <?php
                                };
                            };
                            echo "<script>document.querySelector('.edit-form-container').style.display = 'flex';</script>";
                        };
                    ?>
                </section>
            </div>
        </main>
        <!-- End of Main Content -->
    </div>
    

    <!-- Custom JS -->
    <script src="../js/script-admin.js"></script>
</body>
</html>