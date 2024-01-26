<?php
    include '../config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Montserrat Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/style-admin.css">
</head>
<body>
        <!-- Header -->
        <header class="header">
            <div class="menu-icon" onclick="openSidebar()">
                <span class="material-icons-outlined">menu</span>
            </div>
            <div class="header-right">
                <span class="material-icons-outlined" style="cursor: pointer;" onclick="toggleMenu()">account_circle</span>
            </div>
            <div class="sub-menu-wrap" id="subMenu">
                <div class="sub-menu">
                    <div class="user-info">
                        <img src="../img/SyndromeLogo.jpg">
                        <h3>Hi, Admin!</h3>
                    </div>
                    <hr>
                    <a href="../index.php" class="sub-menu-link">
                        <img src="../img/logout.png">
                        <p>Logout</p>
                    </a>
                </div>
            </div>
        </header>
        <!-- End Header -->

        <!-- Sidebar -->
        <aside id="sidebar">
            <div class="sidebar-title">
                <img src="../img/SyndromeLogo.jpg" alt="5yndrome-logo" width="30" height="30" style="border-radius: 50%;">
                <div class="sidebar-brand">
                    5YNDROME Dobby
                </div>
                <span class="material-icons-outlined" onclick="closeSidebar()">close</span>
            </div>
    
            <ul class="sidebar-list">
                <li class="sidebar-list-item">
                    <a href="index-admin.php">
                        <span class="material-icons-outlined">dashboard</span> Dashboard
                    </a>
                </li>
                <li class="sidebar-list-item">
                    <a href="products.php">
                        <span class="material-icons-outlined">inventory_2</span> Products
                    </a>
                </li>
                <li class="sidebar-list-item">
                    <a href="user.php">
                        <span class="material-icons-outlined">groups</span> Users
                    </a>
                </li>
                <li class="sidebar-list-item">
                    <a href="sales.php">
                        <span class="material-icons-outlined">local_atm</span> Sales
                    </a>
                </li>
                <li class="sidebar-list-item">
                    <a href="sales-date.php">
                        <span class="material-icons-outlined">search</span> Filter Data
                    </a>
                </li>
                <li class="sidebar-list-item">
                    <a href="transaction.php">
                    <span class="material-icons-outlined">receipt_long</span> Transaction
                    </a>
                </li>
                <!--SAMPLE TEMPLATE
                    <li class="sidebar-list-item">
                    <a href="#" target="_blank">
                        <span class="material-icons-outlined">poll</span> Reports
                    </a>
                </li>-->
            </ul>
        </aside>
        <!-- End Sidebar -->
        
    <!-- Custom JS -->
    <script src="../js/script-admin.js"></script>
    <script>
        // SIDEBAR TOGGLE
        var sidebarOpen = false;
        var sidebar = document.getElementById("sidebar");

        function openSidebar() {
            if(!sidebarOpen) {
                sidebar.classList.add("sidebar-responsive");
                sidebarOpen = true;
            }
        }

        function closeSidebar() {
            if(sidebarOpen) {
                sidebar.classList.remove("sidebar-responsive");
                sidebarOpen = false;
            }
        }
    </script>
    <script>
        let subMenu = document.getElementById("subMenu");

        function toggleMenu(){
            subMenu.classList.toggle("open-menu");
        }

        document.querySelector('#close-edit').onclick = () =>{
            document.querySelector('.edit-form-container').style.display = 'none';
            window.location.href = 'product-add.php';
        };
    </script>
</body>
</html>