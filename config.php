<?php
// Database configuration
$host = 'localhost'; // Database host
$db_name = 'tailspin_aircraft_marketplace'; // Database name
$username = 'tailspin_aircrat_marketplace'; // Database username
$password = 'aircraft@786'; // Database password

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8mb4", $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Handle connection error
    die("Connection failed: " . $e->getMessage());
}
?>
