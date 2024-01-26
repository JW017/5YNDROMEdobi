<?php
// Connect to your database
$host = "localhost";
$dbname = "5yndrome";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Retrieve search query from the URL parameter
$query = $_GET['query'];

// Prepare and execute the database query
$stmt = $conn->prepare("SELECT UserID,Email,Name,DateOfBirth,Address,PhoneNum FROM users WHERE Name LIKE :query");
$stmt->bindValue(':query', '%' . $query . '%');
$stmt->execute();

// Fetch the results as an associative array
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Send the results as a JSON response
header('Content-Type: application/json');
echo json_encode($results);
?>
