<?php
if($_SERVER['REQUEST_METHOD'] == 'POST' OR $_SERVER['REQUEST_METHOD'] == 'GET') {
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
	} else if(isset($_GET['method'])) {
		$method = $_GET['method'];
		if($method == 'getClient') {
			getClient();
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

function getClient() {
	global $conn;
	global $response;

	$id_user = $_GET['id_user'];
	$waktu_pilih = date("Y-m-d H:i:s");
	$data = array();
	$query = "SELECT
				pesanan.id, pesanan.waktu_pilih, pesanan.metode_bayar, pesanan.status,
				lapangan.nama, lapangan.harga, 
				admin.alamat
			FROM
				pesanan, lapangan, admin
			WHERE
				pesanan.id_user = '$id_user'
				AND pesanan.waktu_pilih >= '$waktu_pilih'
				AND pesanan.id_lapangan = lapangan.id
				AND lapangan.id_admin = admin.id
			ORDER BY
				CASE pesanan.status
					WHEN 'belum' THEN 1
					WHEN 'selesai' THEN 2
					ELSE 3
				END";
			
	$result = $conn->query($query);

	if($result->num_rows > 0) {
		while($row = mysqli_fetch_array($result)){
			$waktu_pilih_tanggal = strftime('%A, %e %B %Y', strtotime($row[1]));
			$waktu_pilih_jam = date('H:i', strtotime($row[1])) . ' - ' . date('H:i', strtotime($row[1] . '+60 minutes'));
			switch($row[3]) {
				case 'belum':
					$status = 'Belum bayar';
					break;
				case 'selesai':
				$status = 'Selesai';
					break;
				default:
				$status = 'Dibatalkan';
			}
			array_push($data, array(
				'id' => $row[0],
				'waktu_pilih_tanggal' => $waktu_pilih_tanggal,
				'waktu_pilih_jam' => $waktu_pilih_jam,
				'metode_bayar' => $row[2],
				'status' => $status,
				'nama_lapangan' => $row[4],
				'harga' => $row[5],
				'alamat' => $row[6]
			));
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