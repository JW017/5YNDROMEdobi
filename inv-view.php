<?php
    include 'config.php';
    global $conn;

    if(isset($_GET['invoice'])){
        $invoice = mysqli_real_escape_string($conn, $_GET['invoice']);

        // make SQL query
        $sql = "SELECT invoices.InvNo, users.Name, invoices.SalesDate, items.ItemName, items.ItemPrice, invdetails.Qty, servicemethod.ServiceName, paymethod.PaymentName, invoices.PickUpDate FROM invdetails JOIN items ON items.ItemID=invdetails.ItemID JOIN invoices ON invoices.InvNo=invdetails.invNo JOIN users ON users.UserID=invoices.UserID JOIN servicemethod ON servicemethod.ServiceID=invoices.ServiceID JOIN paymethod ON paymethod.PaymentID=invoices.PaymentID WHERE invoices.InvNo=$invoice;";

        // get the query result
        $result = mysqli_query($conn, $sql);

        // fetch result in array format
        $view = mysqli_fetch_assoc($result);

        $v_inv = $view['InvNo'];
        $v_name = $view['Name'];
        $v_date = $view['SalesDate'];
        $v_service = $view['ServiceName'];
        $v_payment = $view['PaymentName'];
        $v_pickdate = $view['PickUpDate'];

        $v_total = 0; // Initialize total amount to 0

        ob_start(); // Start output buffering
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Details</title>
    <!-- Montserrat Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style-admin.css">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #333;
            color: #fff;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .total {
            margin-top: 20px;
            text-align: right;
            font-weight: bold;
        }

        .total label {
            font-weight: normal;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Invoice Full Details</h1>
        <div>
            <label for="InvNo">Invoice Number:</label>
            <span><b><?php echo htmlspecialchars($v_inv); ?></b></span>
        </div>

        <div>
            <label for="Name">Buyer Name:</label>
            <span><b><?php echo htmlspecialchars($v_name); ?></b></span>
        </div>

        <div>
            <label for="SalesDate">Date:</label>
            <span><b><?php echo htmlspecialchars($v_date); ?></b></span>
        </div>

        <table>
            <tr>
                <th>Service Name</th>
                <th>Quantity</th>
                <th>Price per Service</th>
            </tr>
            <?php
            // Reset the internal pointer of the $result array
            mysqli_data_seek($result, 0);
            while ($row = mysqli_fetch_assoc($result)) {
                $itemAmount = $row['ItemPrice'] * $row['Qty'];
                $v_total += $itemAmount; // Add the item amount to the total
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['ItemName']); ?></td>
                    <td><?php echo htmlspecialchars($row['Qty']); ?></td>
                    <td><?php echo htmlspecialchars($row['ItemPrice']); ?></td>
                </tr>
            <?php } ?>
        </table>

        <div class="total">
            <label for="Amount">Total:</label>
            <span><b>RM <?php echo htmlspecialchars($v_total); ?></b></span>
        </div>

        <div>
            <label for="ServiceName">Service: </label>
            <span><b><?php echo htmlspecialchars($v_service); ?></b></span>
        </div>

        <div>
            <label for="PaymentName">Payment Method: </label>
            <span><b><?php echo htmlspecialchars($v_payment); ?></b></span>
        </div>

        <div>
            <label for="PickUpDate">Pick Up Date: </label>
            <span><b><?php echo htmlspecialchars($v_pickdate); ?></b></span>
        </div>
        <br><br>
        <button onclick="back()">Back</button>
    </div>

    <!-- Scripts -->
    <!-- Custom JS -->
    <script src="js/script-admin.js"></script>
    <script src="js/sales.js"></script>
    <script>
        function back() {
            window.location.href = "transaction.php";
        }
    </script>
</body>
</html>

<?php
        ob_end_flush(); // End output buffering and flush the output
    }
?>
