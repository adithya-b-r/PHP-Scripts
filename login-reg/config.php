<?php
// Database configuration
$db_host = 'localhost'; 
$db_username = 'root';
$db_password = '';
$db_name = 'your-database-name';

try {
    // Attempt to establish a database connection
    $connection = new mysqli($db_host, $db_username, $db_password, $db_name);

    // Check for connection errors
    if ($connection->connect_error) {
        throw new Exception("Connection failed: " . $connection->connect_error);
    }

    // echo "<script>alert('Connection Successful')</script>";
} catch (Exception $e) {
    // Handle connection errors
    echo "<script>alert('Database connection failed!')</script>";
}
?>

