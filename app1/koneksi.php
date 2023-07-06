<?php
$hostname = "localhost";
$database = "sso";
$username = "root";
$password = "";
$koneksi = mysqli_connect($hostname, $username, $password, $database);
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
