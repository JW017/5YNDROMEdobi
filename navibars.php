<?php
    include 'config.php';

$user_id = $_SESSION['user_id'];
	if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:login.php');
}
	
		// make SQL query
        $sql = "SELECT * FROM `users` WHERE UserID = '$user_id';";

        // get the query result
        $result = mysqli_query($conn, $sql);

        // fetch result in array format
        $fetch = mysqli_fetch_assoc($result);

        $Name = $fetch['Name'];
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
    <link rel="stylesheet" href="css/style-admin.css">
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
                        <img src="img/SyndromeLogo.jpg">
                        <h3>Hi, <?php echo ($Name); ?></h3>
                    </div>
                    <hr>
                    <a href="index.html" class="sub-menu-link">
                        <img src="img/logout.png">
                        <p>Logout</p>
                    </a>
                </div>
            </div>
        </header>
        <!-- End Header -->

        <!-- Sidebar -->
        <aside id="sidebar">
            <div class="sidebar-title">
                <img src="img/SyndromeLogo.jpg" alt="5yndrome-logo" width="30" height="30" style="border-radius: 50%;">
                <div class="sidebar-brand">
                    <a href="indexafter.php">
                        5YNDROME Dobby
                    </a>
                </div>
                <span class="material-icons-outlined" onclick="closeSidebar()">close</span>
            </div>
    
            <ul class="sidebar-list">
                <li class="sidebar-list-item">
                    <a href="user.php">
                        <span class="material-icons-outlined">groups</span> User Profile
                    </a>
                </li>

                <li class="sidebar-list-item">
                    <a href="transaction.php">
                        <span class="material-icons-outlined">search</span> Transactions
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
    <script src="js/script-admin.js"></script>
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