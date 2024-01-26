<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Check if the form was submitted
    if (isset($_GET['filter'])) {
        $filter = $_GET['filter'];

        // Database connection
        $host = "localhost";
        $username = "root";
        $password = "";
        $database = "5yndrome";

        $conn = new mysqli($host, $username, $password, $database);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Transaction summary code
        $sql = "SELECT * FROM invoices WHERE DATE(SalesDate) = CURDATE()";
        if ($filter === "weekly") {
            $sql = "SELECT * FROM invoices WHERE SalesDate >= DATE_SUB(NOW(), INTERVAL 7 DAY)";
        } elseif ($filter === "monthly") {
            $sql = "SELECT * FROM invoices WHERE YEAR(SalesDate) = YEAR(CURRENT_DATE()) AND MONTH(SalesDate) = MONTH(CURRENT_DATE())";
        }

        $result = $conn->query($sql);

        // Display the summary
        if ($result->num_rows > 0) {
            echo "<h2>Transaction Records Summary</h2>";
            echo "<h3>Filter: " . ucfirst($filter) . "</h3>";

            // Perform your summary calculations or display individual transaction details here
            // ...

        } else {
            echo "<p>No transactions found for the selected filter.</p>";
        }

        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Transaction Records Summary</title>
</head>
<body>
    <h2>Transaction Records Summary</h2>

    <form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="filter">Select Filter:</label>
        <select name="filter" id="filter">
            <option value="daily">Daily</option>
            <option value="weekly">Weekly</option>
            <option value="monthly">Monthly</option>
        </select>
        <br>
        <input type="submit" value="View Summary">
    </form>
</body>
</html>
