<?php
if($_SERVER['REQUEST_METHOD']=='POST') {
	include_once "configuration.php";
	$json = json_decode(file_get_contents("php://input"));
	//inisialisasi variabel untuk menampung data
	$response = "";
	//inisialisasi variabel method
	if(isset($_POST['method'])) {
		$method = $_POST['method'];
		if($method == 'showTime') {
			showTime();
		}
	} else if(isset($json->method)) {
		$method = $json->method;
		if($method === 'store') {
			store();
		}
	}

	echo json_encode($response);
}

function store() {
	global $conn;
	global $response;
	global $json;

	$id_user = $json->id_user;
	$id_lapangan = $json->id_lapangan;
	$waktu_pilih_tanggal = $json->waktu_pilih_tanggal;
	$waktu_pilih_jam = $json->waktu_pilih_jam;
	$metode_bayar = $json->metode_bayar;

	$waktu_pilih = array();
	$query = "";

	for($i = 0; $i < count($waktu_pilih_jam); $i++) {
		$waktu_pilih[] = $waktu_pilih_tanggal . " " . $waktu_pilih_jam[$i];

		$query .= "INSERT INTO pesanan 
					(id_user, id_lapangan, waktu_pilih, metode_bayar, status) 
				VALUES 
					('$id_user', '$id_lapangan', '$waktu_pilih[$i]', '$metode_bayar', 'belum');";
	}
	
	$result = $conn->multi_query($query);
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
	
	$waktu_pilih = $_POST['waktu_pilih'];
	$id_lapangan = $_POST['id_lapangan'];
	$waktu_pilih_now = NULL;
	$data = array();
	if($waktu_pilih == date("Y-m-d")) {
		$waktu_pilih_now = date("Y-m-d H:i:s");

		for($i = date('H', strtotime('07:00:00')); $i <= date('H', strtotime($waktu_pilih_now)); $i++) {
			array_push($data, array(
				'waktu_pilih' => date('H', strtotime($i. ':00:00'))
				)
			);
		}
	}
    
    $query = "SELECT waktu_pilih 
				FROM pesanan 
				WHERE 
					waktu_pilih LIKE '$waktu_pilih%' 
				AND
					waktu_pilih > '$waktu_pilih_now' 
				AND 
					id_lapangan = '$id_lapangan'";

    $result = $conn->query($query);
	
	if($result->num_rows > 0) {
		while($row = mysqli_fetch_array($result)){
			array_push($data, array(
				'waktu_pilih' => date('H', strtotime($row[0]))));
		}
		$response = array(
			'status' => TRUE,
			'msg' => "",
			'data' => $data
		);
	} else if($waktu_pilih_now != NULL) {
		$response = array(
			'status' => TRUE,
			'msg' => "",
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