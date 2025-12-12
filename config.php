<?php
// config.php
$servername = "localhost";
$username = "root";
$password = "root"; // Nếu bạn dùng MAMP mặc định là root
$dbname = "v_store";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
