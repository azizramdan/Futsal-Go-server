<?php
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['method'])) {
	//include file connect.php untuk menyambungkan file create.php dengan database
	include_once "configuration.php";
	//inisialisasi variabel method
	$method = $_POST['method'];
	//inisialisasi variabel untuk menampung data
	$response = "";

	if($method == 'store') {
		store();
	} else if($method == 'showTime') {
		showTime();
	}

	echo json_encode($response);
}

function store() {
	$id_user = $_POST['id_user'];
	$id_lapangan = $_POST['id_lapangan'];
	$waktu_pilih = $_POST['waktu_pilih'];
	$metode_bayar = $_POST['metode_bayar'];
	$status = $_POST['status'];

	global $conn;
	global $response;

	$query = "INSERT INTO pesanan 
					(id_user, id_lapangan, waktu_pilih, metode_bayar, status) 
					VALUES 
					('$id_user', '$id_lapangan', '$waktu_pilih', '$metode_bayar', '$status')";
	
	$result = $conn->query($query);
	if($result) {
		$response = array(
			'status' => TRUE,
			'msg' => 'Pemesanan berhasil!'
		);
	} else {
		$response = array(
			'status' => FALSE,
			'msg' => 'Pemesanan gagal!'
		);
	}
	$conn->close();
}

function showTime() {
	global $conn;
	global $response;
	
	$waktu_pilih = date('Y-m-d', strtotime($_POST['waktu_pilih']));
    
    $query = "SELECT waktu_pilih FROM pesanan WHERE waktu_pilih LIKE '$waktu_pilih%'";
    $result = $conn->query($query);
	$data = array();
	if($result->num_rows > 0) {
		while($row = mysqli_fetch_array($result)){
			array_push($data, array(
				'waktu_pilih' => date('H', strtotime($row[0]))));
		}
		$response = array(
			'status' => TRUE,
			'msg' => '',
			'data' => $data
		);
	} else {
		$response = array(
			'status' => FALSE,
			'msg' => 'Tidak ada data!'
		);
	}
	$conn->close();
}