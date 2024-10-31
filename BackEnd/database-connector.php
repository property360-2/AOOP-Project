<?php
// registerconnector.php
$dbserver = 'localhost';
$dbUser = 'root';
$dbPassword = '';
$dbName = 'gym';

function connect() {
    global $dbserver, $dbUser, $dbPassword, $dbName;
    $conn = mysqli_connect($dbserver, $dbUser, $dbPassword, $dbName);
    if (!$conn) {
        throw new Exception("Database connection failed: " . mysqli_connect_error());
    }
    return $conn;
}
?>
