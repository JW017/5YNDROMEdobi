<?php
// Assuming you have already established a connection to your database
include '../config.php';

// Query to retrieve data from the database
$query = "SELECT * FROM users";
$result = mysqli_query($connection, $query);

// Checking if the query executed successfully
if ($result) {
    $data = array();

    // Fetching data into an array
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    // Returning the data as JSON
    header('Content-Type: application/json');
    echo json_encode($data);
} else {
    echo 'Error: ' . mysqli_error($connection);
}

// Close the database connection
mysqli_close($connection);
?>
