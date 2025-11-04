<?php

$host = "localhost";
$user = "root";
$pass = "";
$db   = "tugas3_pemweb";
$port = 8111;


$connection =null;

$conn = mysqli_connect($host, $user, $pass, $db, $port);
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
