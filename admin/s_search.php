<?php
// Connect to your database
require_once('../config.php'); // Include the connect.php file

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Retrieve search query from the URL parameter
$query = $_GET['query'];

// Prepare and execute the database query
$stmt = $conn->prepare("SELECT invoices.SalesDate, users.Name, invdetails.InvNo 
AS invNo, SUM(ItemPrice*invdetails.Qty) AS Amount FROM invdetails JOIN items ON items.ItemID=invdetails.ItemID JOIN 
invoices ON invoices.InvNo=invdetails.invNo JOIN users ON users.UserID=invoices.UserID 
WHERE Name LIKE :query OR invoices.InvNo LIKE :query GROUP BY InvNo");
$stmt->bindValue(':query', '%' . $query . '%');
$stmt->execute();

// Fetch the results as an associative array
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Send the results as a JSON response
header('Content-Type: application/json');
echo json_encode($results);
?>
