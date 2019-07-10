<?php
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
    header('Content-type: application/json');
	echo json_encode($response);
    die();
}