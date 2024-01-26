<?php
    include '../config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Montserrat Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/user-style.css">
    <link rel="stylesheet" href="../css/style-admin.css">
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

    <style>
        .form-group {
            padding-top: 10px;
            margin-bottom: 10px;
        }
        
        label {
            display: block;
            font-weight: bold;
        }
        
        input[type="text"], input[type="date"] {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            width: 15%;
        }
        
        input[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>

</head>
<body>
    <div class="grid-container">
        <!-- Content Header/Sidebar -->
        <?php include 'navibars.php'; ?>
        <!-- End of Content Header/Sidebar -->

        <!-- Main Content -->
        <main class="main-container">
            <div class="main-title">
                <p class="font-weight-bold">SEARCH REPORT</p>
            </div>
            <div class="main-white">
                <br>
                <form method="POST" action="" style="text-align: center;">
                    <div class="form-group">
                        <label for="start_date">Start Date:</label>
                        <input type="date" id="start_date" name="start_date" required>
                    </div>
                    <div class="form-group">
                        <label for="end_date">End Date:</label>
                        <input type="date" id="end_date" name="end_date" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Filter">
                    </div>
                </form>
                <!-- Display Search Result -->
                <div class="table-form">
                    <table class="table1">
                        <thead>
                            <tr>         
                            <th width="17%"><span>Date</span></th>       
                            <th width="17%"><span>Buyer</span></th>
                            <th width="32%"><span>Invoice Number</span></th>
                            <th width="17%"><span>Amount (RM)</span></th>
                            <th width="17%"><span>Full Details</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $start_date = isset($_POST['start_date']) ? $_POST['start_date'] : date('Y-m-d');
                                $end_date = isset($_POST['end_date']) ? $_POST['end_date'] : date('Y-m-d');

                                $sql = "SELECT invoices.SalesDate, users.Name, invdetails.InvNo AS invNo, SUM(ItemPrice*invdetails.Qty) AS Amount FROM invdetails JOIN items ON items.ItemID=invdetails.ItemID JOIN invoices ON invoices.InvNo=invdetails.invNo JOIN users ON users.UserID=invoices.UserID WHERE SalesDate BETWEEN '$start_date' AND '$end_date' GROUP BY InvNo";
                                $result = mysqli_query($conn, $sql);
                                $queryResults = mysqli_num_rows($result);

                                if (mysqli_num_rows($result) > 0) {
                                    
                                    while ($row = mysqli_fetch_assoc($result)) { ?>
                                        <tr>
                                            <td style="text-align: center;">
                                                <?php $date=date("d-m-Y", strtotime($row['SalesDate']));
                                                echo htmlspecialchars($date)?>
                                            </td>
                                            <td style="text-align: center;">
                                                <?php echo htmlspecialchars($row['Name'])?>
                                            </td>
                                            <td style="text-align: center;">
                                                <?php echo htmlspecialchars($row['invNo'])?>
                                            </td>
                                            <td style="text-align: center;">
                                                <?php echo htmlspecialchars($row['Amount'])?>
                                            </td>
                                            <td>
                                                <a href="sales-view.php?invoice=<?php echo $row['invNo']?>"><button>View</button></a> 
                                            </td>
                                        </tr>
                                    <?php }
                                } else {
                                    echo "";
                                }?>
                        <tbody>
                    </table>
                </div>
                <!-- End Display Table -->
            </div>
        </main>
        <!-- End of Main Content -->
    </div>

    <!-- Custom JS -->
    <script src="../js/script-admin.js"></script>
</body>
</html>