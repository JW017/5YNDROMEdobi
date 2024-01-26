<?php
    include '../config.php';

    // count product items
    $result = mysqli_query($conn, "SELECT COUNT(*) AS `count` FROM `items`");
    $row = mysqli_fetch_array($result);
    $item = $row['count'];

    //count user
    $result = mysqli_query($conn, "SELECT COUNT(*) AS `count` FROM `users`");
    $row = mysqli_fetch_array($result);
    $user = $row['count'];
    
    //count sales order
    $result = mysqli_query($conn, "SELECT COUNT(*) AS `count` FROM `invoices`");
    $row = mysqli_fetch_array($result);
    $sales = $row['count'];

    //count sales today
    $result = mysqli_query($conn, "SELECT COUNT(*) AS `count` FROM `invoices` WHERE DATE(SalesDate) = CURDATE()");
    $row = mysqli_fetch_array($result);
    $salesTdy = $row['count'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Montserrat Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/style-admin.css">
</head>
<body>
    <div class="grid-container">
        <?php include 'navibars.php';?>
        <!-- Main -->
        <main class="main-container">
            <div class="main-title">
                <p class="font-weight-bold">DASHBOARD</p>
            </div>

            <div class="main-cards">
                <div class="card">
                    <div class="card-inner">
                        <p class="text-primary">PRODUCTS</p>
                        <span class="material-icons-outlined text-blue">inventory_2</span>
                    </div>
                    <span class="text-primary font-weight-bold"><?php echo $item;?></span>
                </div>
                
                <div class="card">
                    <div class="card-inner">
                        <p class="text-primary">USERS</p>
                        <span class="material-icons-outlined text-orange">people</span>
                    </div>
                    <span class="text-primary font-weight-bold"><?php echo $user;?></span>
                </div>

                <div class="card">
                    <div class="card-inner">
                        <p class="text-primary">SALES ORDERS</p>
                        <span class="material-icons-outlined text-green">shopping_cart</span>
                    </div>
                    <span class="text-primary font-weight-bold"><?php echo $sales;?></span>
                </div>

                <div class="card">
                    <div class="card-inner">
                        <p class="text-primary">SALES TODAY</p>
                        <span class="material-icons-outlined text-red">attach_money</span>
                    </div>
                    <span class="text-primary font-weight-bold"><?php echo $salesTdy;?></span>
                </div>  
            </div>

            <div class="main-white">
                <?php include 'transaction.php';?>
            </div>
        </main>
        <!-- End Main -->
    </div>     


    <!-- Scripts -->
    <!-- Apex Charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.40.0/apexcharts.min.js"></script>
    <!-- Custom JS -->
    <script src="../js/script-admin.js"></script>
</body>
</html>