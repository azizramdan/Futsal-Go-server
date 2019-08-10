<?php
include_once "..\configuration.php";

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        get();
        break;

    case 'POST':
        post();
        break;
    
    default:
        # code...
        break;
}

function get() {
    if(isset($_GET['method'])) {
        switch ($_GET['method']) {
            case 'index':
                index();
                break;
            
            default:
                # code...
                break;
        }
    }
}
function post() {
    if(isset($_POST['method'])) {
        switch ($_POST['method']) {
            case 'konfirmasi':
                konfirmasi();
                break;
            
            default:
                # code...
                break;
        }
    }
}
function index() {
    global $conn;
    $waktu_pilih = date("Y-m-d H:i:s");
    $id_admin = $_GET['id_admin'];
    $data = array();
    $response;
    $query = "SELECT
                pesanan.id,
                pesanan.waktu_pilih,
                pesanan.metode_bayar,
                pesanan.status,
                lapangan.nama AS nama_lapangan,
                user.nama AS nama_pemesan,
                user.telp
            FROM
                pesanan,
                lapangan,
                admin,
                user
            WHERE
                pesanan.waktu_pilih >= '$waktu_pilih' AND pesanan.id_lapangan = lapangan.id AND lapangan.id_admin = admin.id AND pesanan.id_user = user.id AND admin.id = '$id_admin'
            ORDER BY CASE
                pesanan.status WHEN 'belum' THEN 1 WHEN 'sudah' THEN 2 ELSE 3
            END";

    $result = $conn->query($query);
    if($result->num_rows > 0) {
		while($row = mysqli_fetch_assoc($result)){
			$waktu_pilih_tanggal = strftime('%A, %e %B %Y', strtotime($row['waktu_pilih']));
			$waktu_pilih_jam = date('H:i', strtotime($row['waktu_pilih'])) . ' - ' . date('H:i', strtotime($row['waktu_pilih'] . '+60 minutes'));
			switch($row['status']) {
				case 'belum':
					$status = 'Belum bayar';
					break;
				case 'sudah':
					$status = 'Sudah bayar';
					break;
				default:
				$status = 'Dibatalkan';
			}
			array_push($data, array(
				'id' => $row['id'],
				'waktu_pilih_tanggal' => $waktu_pilih_tanggal,
				'waktu_pilih_jam' => $waktu_pilih_jam,
				'metode_bayar' => $row['metode_bayar'],
				'status' => $status,
				'nama_lapangan' => $row['nama_lapangan'],
                'nama_pemesan' => $row['nama_pemesan'],
                'telp' => $row['telp']
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
    echo json_encode($response);
}

function konfirmasi() {
	global $conn;
    $id = $_POST['id'];
    $status = $_POST['status'];

	$query = "UPDATE pesanan 
				SET 
					status = '$status'
				WHERE 
					id = '$id'";

	$result = $conn->query($query);
	// die(var_dump($result));
	if($result) {
		$response = array(
			'status' => TRUE,
			'msg' => 'Status pesanan berhasil diubah!'
		);
	} else {
		$response = array(
			'status' => FALSE,
			'msg' => 'Status pesanan berhasil diubah!'
		);
	}
    $conn->close();
    echo json_encode($response);
}

