<?php
@include 'config.php';
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
    <title>Search</title>
</head>
<body>
 <section class="menu" id="Menu">

    <form action="" method="GET">  
        <input type="text" name="search" required value="<?php if(isset($_GET['search'])){echo $_GET['search']; } ?>" class="form-control" placeholder="Search data">
		<button type="submit" class="btn-search">Search</button>
    </form>
	<div class="menu_box">
        <?php 
            $con = mysqli_connect("localhost","root","","5yndromedobi_db");
            if(isset($_GET['search']))
            {
            $filtervalues = $_GET['search'];
            $query = "SELECT * FROM items WHERE ItemName LIKE '%$filtervalues%' ";
            $query_run = mysqli_query($con, $query);
			if(mysqli_num_rows($query_run) > 0)
				{                                            
				foreach($query_run as $items)
                    {
					while($fetch_product = mysqli_fetch_assoc($query_run)){
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
                } 
				}else {
                    echo "No service available.";
                }
				};?>
				</div>

    
            <!-- Brand List  -->          
                <form action="" method="GET">
                        <div class="card-header">
                            <br> 
                                <button type="submit" class="btn-browse">Browse</button>
                            <br>
                        </div>
                        <div class="card-body">
                            <h4>Service List</h4>
                            <hr>
                            <?php
                                $brand_query = "SELECT * FROM itemcategory";
                                $brand_query_run  = mysqli_query($con, $brand_query);

                                if(mysqli_num_rows($brand_query_run) > 0)
                                {
                                    foreach($brand_query_run as $brandlist)
                                    {
                                        $checked = [];
                                        if(isset($_GET['brands']))
                                        {
                                            $checked = $_GET['brands'];
                                        }
                            ?>
                                            <div>
                                                <input type="checkbox" name="brands[]" value="<?= $brandlist['categoryID']; ?>" 
                                                    <?php if(in_array($brandlist['categoryID'], $checked)){ echo "checked"; } ?>
                                                 />
                                                <?= $brandlist['categoryName']; ?>
                                            </div>
                                        <?php
                                    }
                                }
                                else
                                {
                                    echo "No Brands Found";
                                }
                            ?>
                        </div>
                    
                </form>
           

            <!-- Brand Items - Products -->

<div class="menu_box">
                        <?php
                            if(isset($_GET['brands']))
                            {
                                $branchecked = [];
                                $branchecked = $_GET['brands'];
                                foreach($branchecked as $rowbrand)
                                {
                                    // echo $rowbrand;
                                    $products = "SELECT * FROM items WHERE categoryID IN ($rowbrand)";
                                    $products_run = mysqli_query($con, $products);
                                    if(mysqli_num_rows($products_run) > 0)
                                    {					
										while($fetch_product = mysqli_fetch_assoc($products_run))
										{
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
										}
									}
								}
                            	
										?>
               
</div>


   </section>

</body>
</html>