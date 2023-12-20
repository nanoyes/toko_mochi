<?php
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'mochi';

$mysqli = new mysqli($host, $username, $password, $dbname);

if ($mysqli->connect_error) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}
?>
