<?php
header('Content-type: application/json');
date_default_timezone_set("Asia/Jakarta");
setlocale(LC_ALL, 'id_ID');
//error_reporting(0);
$host = "localhost"; // Nama hostnya
$username = "root"; // Username
$password = ""; // Password (Isi jika menggunakan password)
$database = "futsalgo"; // Nama databasenya
$conn = new mysqli($host, $username, $password, $database); // Koneksi ke MySQL
if ($conn->connect_error) {
    $response = array(
        'status' => FALSE,
        'msg' => 'Connection failed!'
    );
	echo json_encode($response);
    die();
}