<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <!-- Montserrat Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <link rel="stylesheet" href="../css/test.css">
    <link rel="stylesheet" href="../css/user-style.css">
    <link rel="stylesheet" href="../css/style-admin.css">
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
                        <form action="" method="get">
                            <input type="checkbox" id="check">
                            <div class="search-box">
                                <input type="search"  name="search" id="search" class="form-control" placeholder="Search User by Name">
                                <label for="check" class="icon">
                                    <i class="fas fa-search"></i>
                                </label>
                            </div>
                        </form>
                        <div class="main-white">
                            <div id="results"></div>
                        </div>
                    </div>
                </div>
            </div>  
        </main>
        <!-- End of Main Content -->
    </div>
    

    <!-- Custom JS -->
    <script src="../js/script-admin.js"></script>
    <script src="../js/users.js"></script>
</body>
</html>