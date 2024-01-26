<?php
@include '../config.php';

// Retrieve transactions from the database
$sql = "SELECT invoices.SalesDate, invdetails.InvNo AS invNo, items.ItemPrice FROM invdetails JOIN items ON items.ItemID=invdetails.ItemID JOIN invoices ON invoices.InvNo=invdetails.invNo;";

// Execute the query
$result = $conn->query($sql);

// Check if the query returned any rows
if ($result->num_rows > 0) {
    $transactions = array();

    // Loop through each row and store the data in the $transactions array
    while ($row = $result->fetch_assoc()) {
        $transactions[] = array(
            'invoice' => $row['invNo'],
            'amount' => $row['ItemPrice'],
            'date' => $row['SalesDate']
        );
    }
} else {
    // No rows found
    $transactions = array();
}

// Close the database connection
$conn->close();
// Function to filter transactions by date range
function filterTransactions($transactions, $startDate, $endDate)
{
    $filteredTransactions = array();

    foreach ($transactions as $transaction) {
        if ($transaction['date'] >= $startDate && $transaction['date'] <= $endDate) {
            $filteredTransactions[] = $transaction;
        }
    }

    return $filteredTransactions;
}

// Function to calculate total number of invoices and total amount
function calculateTotal($transactions)
{
    $totalInvoices = count($transactions);
    $totalAmount = 0;

    foreach ($transactions as $transaction) {
        $totalAmount += $transaction['amount'];
    }

    return array('invoices' => $totalInvoices, 'amount' => $totalAmount);
}

// Get the filter type and set the start and end dates accordingly
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'daily';
$endDate = date('Y-m-d');
$startDate = '';

if ($filter === 'daily') {
    $startDate = $endDate;
} elseif ($filter === 'weekly') {
    $startDate = date('Y-m-d', strtotime('-1 week', strtotime($endDate)));
} elseif ($filter === 'monthly') {
    $startDate = date('Y-m-d', strtotime('-1 month', strtotime($endDate)));
}

// Filter transactions based on the date range
$filteredTransactions = filterTransactions($transactions, $startDate, $endDate);

// Calculate total number of invoices and total amount
$total = calculateTotal($filteredTransactions);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Transaction Report</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        tfoot td {
            font-weight: bold;
        }
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <h1>Transaction Report</h1>

    <form action="" method="GET">
        <label for="filter">Filter:</label>
        <select name="filter" id="filter">
            <option value="daily" <?php if ($filter === 'daily') echo 'selected'; ?>>Daily</option>
            <option value="weekly" <?php if ($filter === 'weekly') echo 'selected'; ?>>Weekly</option>
            <option value="monthly" <?php if ($filter === 'monthly') echo 'selected'; ?>>Monthly</option>
        </select>
        <button type="submit">Filter</button>
    </form>

    <!-- Daily Transactions -->
<div class="<?php if ($filter !== 'daily') echo 'hidden'; ?>">
    <h3>Daily Transactions</h3>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Number of Invoices</th>
                <th>Amount (RM)</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $dateTotals = array(); // Stores the amount totals for each date
            $totalAmount = 0; // Total amount for all transactions

            foreach ($transactions as $transaction) {
                $date = $transaction['date'];

                if (!isset($dateTotals[$date])) {
                    $dateTotals[$date] = array('count' => 0, 'amount' => 0);
                }

                $dateTotals[$date]['count']++;
                $dateTotals[$date]['amount'] += $transaction['amount'];
                $totalAmount += $transaction['amount']; // Update the total amount
            }

            foreach ($dateTotals as $date => $totals) {
                echo "<tr>";
                echo "<td>$date</td>";
                echo "<td>{$totals['count']}</td>";
                echo "<td>{$totals['amount']}</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <td>Total</td>
                <td><?php echo count($transactions); ?></td>
                <td><?php echo $totalAmount; ?></td>
            </tr>
        </tfoot>
    </table>
</div>

    <!-- Weekly Transactions -->
    <div class="<?php if ($filter !== 'weekly') echo 'hidden'; ?>">
    <h3>Weekly Transactions</h3>
    <table>
        <thead>
            <tr>
                <th>Week</th>
                <th>Month</th>
                <th>Year</th>
                <th>Number of Invoices</th>
                <th>Amount (RM)</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $weeklyRanges = array(
                1 => array('start' => 1, 'end' => 7),
                2 => array('start' => 8, 'end' => 14),
                3 => array('start' => 15, 'end' => 21),
                4 => array('start' => 22, 'end' => 28),
                5 => array('start' => 29, 'end' => 31)
            );

            $weeklyTotals = array(); // Stores the weekly amount totals for each week

            foreach ($transactions as $transaction) {
                $date = $transaction['date'];

                $weekNumber = 0;
                foreach ($weeklyRanges as $week => $range) {
                    if (date('j', strtotime($date)) >= $range['start'] && date('j', strtotime($date)) <= $range['end']) {
                        $weekNumber = $week;
                        break;
                    }
                }

                if ($weekNumber !== 0) {
                    if (!isset($weeklyTotals[$weekNumber])) {
                        $weeklyTotals[$weekNumber] = array('count' => 0, 'amount' => 0, 'month' => '', 'year' => '');
                    }

                    $weeklyTotals[$weekNumber]['count']++;
                    $weeklyTotals[$weekNumber]['amount'] += $transaction['amount'];

                    // Store the month and year of the start date of the week
                    $startDateOfWeek = date('Y-m-d', strtotime('-' . ($weekNumber - 1) . ' weeks', strtotime($endDate)));
                    $weeklyTotals[$weekNumber]['month'] = date('F', strtotime($startDateOfWeek));
                    $weeklyTotals[$weekNumber]['year'] = date('Y', strtotime($startDateOfWeek));
                }
            }

            foreach ($weeklyTotals as $week => $totals) {
                echo "<tr>";
                echo "<td>Week $week</td>";
                echo "<td>{$totals['month']}</td>";
                echo "<td>{$totals['year']}</td>";
                echo "<td>{$totals['count']}</td>";
                echo "<td>{$totals['amount']}</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <td>Total</td>
                <td>-</td>
                <td>-</td>
                <td><?php echo count($transactions); ?></td>
                <td>
                    <?php
                    $totalAmount = array_sum(array_column($weeklyTotals, 'amount'));
                    echo $totalAmount;
                    ?>
                </td>
            </tr>
        </tfoot>
    </table>
</div>




    <!-- Monthly Transactions -->
    <div class="<?php if ($filter !== 'monthly') echo 'hidden'; ?>">
    <h3>Monthly Transactions</h3>
    <table>
        <thead>
            <tr>
                <th>Month</th>
                <th>Number of Invoices</th>
                <th>Amount (RM)</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $monthlyTotals = array(); // Stores the amount totals for each month
            $totalAmount = 0; // Total amount for all transactions

            foreach ($transactions as $transaction) {
                $date = $transaction['date'];
                $month = date('F', strtotime($date));

                if (!isset($monthlyTotals[$month])) {
                    $monthlyTotals[$month] = array('count' => 0, 'amount' => 0);
                }

                $monthlyTotals[$month]['count']++;
                $monthlyTotals[$month]['amount'] += $transaction['amount'];
                $totalAmount += $transaction['amount']; // Update the total amount
            }

            foreach ($monthlyTotals as $month => $totals) {
                echo "<tr>";
                echo "<td>$month</td>";
                echo "<td>{$totals['count']}</td>";
                echo "<td>{$totals['amount']}</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <td>Total</td>
                <td><?php echo count($transactions); ?></td>
                <td><?php echo $totalAmount; ?></td>
            </tr>
        </tfoot>
    </table>
</div>


    <script>
        // Script to show/hide the appropriate section based on the selected filter
        const filterSelect = document.getElementById('filter');
        const dailySection = document.querySelector('.daily-section');
        const weeklySection = document.querySelector('.weekly-section');
        const monthlySection = document.querySelector('.monthly-section');

        filterSelect.addEventListener('change', function() {
            const selectedValue = filterSelect.value;

            if (selectedValue === 'daily') {
                dailySection.classList.remove('hidden');
                weeklySection.classList.add('hidden');
                monthlySection.classList.add('hidden');
            } else if (selectedValue === 'weekly') {
                dailySection.classList.add('hidden');
                weeklySection.classList.remove('hidden');
                monthlySection.classList.add('hidden');
            } else if (selectedValue === 'monthly') {
                dailySection.classList.add('hidden');
                weeklySection.classList.add('hidden');
                monthlySection.classList.remove('hidden');
            }
        });
    </script>
</body>
</html>