<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "canteen_management";

try {
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

} catch (Exception $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
