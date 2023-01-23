<?php
$servername = "localhost";
$username = "username";
$password = "password";
$database = "database";
$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    die("Connection failed");
}
mysqli_set_charset($conn, "utf8");
