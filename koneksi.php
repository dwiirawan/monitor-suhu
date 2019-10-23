<?php
$host = 'localhost'; // Nama hostnya
$username = 'root'; // Username
$password = ''; // Password (Isi jika menggunakan password)
$database = 'iot'; // Nama databasenya

// Koneksi ke MySQL dengan MySQLi
$connect = mysqli_connect($host, $username, $password, $database);
?>
