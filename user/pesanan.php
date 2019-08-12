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

			case 'getTime':
				getTime();
                break;
			
			case 'batal':
				batal();
                break;
            
            default:
                # code...
                break;
        }
    }
}
function post() {
	$json = json_decode(file_get_contents("php://input"));
    if(isset($json->method)) {
        switch ($json->method) {
            case 'store':
				store();
				break;

            default:
                # code...
                break;
        }
    }
}

function index() {
    include_once "..\kadaluarsa.php";

    global $conn;
    $id_user = $_GET['id_user'];
	$data = array();
	$query = "SELECT
				pesanan.id, pesanan.waktu_pilih, pesanan.metode_bayar, pesanan.status,
				lapangan.nama, lapangan.harga, 
				admin.alamat, admin.bank, admin.nama_rekening, admin.no_rekening, admin.telp, admin.latitude, admin.longitude
			FROM
				pesanan, lapangan, admin
			WHERE
				pesanan.id_user = '$id_user'
				AND pesanan.id_lapangan = lapangan.id
				AND lapangan.id_admin = admin.id
			ORDER BY
				CASE pesanan.status
					WHEN 'belum' THEN 1
					WHEN 'sudah' THEN 2
                    WHEN 'kadaluarsa' THEN 3
					ELSE 4
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
				case 'sudah':
					$status = 'Sudah bayar';
                    break;
                case 'kadaluarsa':
					$status = 'Kadaluarsa';
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
				'nama_lapangan' => $row['nama'],
				'harga' => $row['harga'],
				'alamat' => $row['alamat'],
				'bank' => $row['bank'],
				'nama_rekening' => $row['nama_rekening'],
				'no_rekening' => $row['no_rekening'],
				'telp' => $row['telp'],
				'latitude' => $row['latitude'],
				'longitude' => $row['longitude']
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

function getTime() {
	global $conn;
	$waktu_pilih = $_POST['waktu_pilih'];
	$id_lapangan = $_POST['id_lapangan'];
	$waktu_pilih_now = NULL;
    $data = array();
    $waktu_pesanan = array();
    
    $query = "SELECT
					jam_buka,
					jam_tutup 
				FROM 
					admin,
					lapangan
				WHERE 
					admin.id = lapangan.id_admin
					AND lapangan.id = '$id_lapangan'";

	$result = $conn->query($query);
	$row = mysqli_fetch_assoc($result);
	$jam_buka = date('H', strtotime($row['jam_buka']));
	$jam_tutup = date('H', strtotime($row['jam_tutup']));

	$waktu_sekarang = NULL;

	if($waktu_pilih == date("Y-m-d")) {
		$waktu_sekarang = date("Y-m-d H:i:s");
		for($i = $jam_buka; $i <= date('H', strtotime($waktu_sekarang)); $i++) {
			array_push($waktu_pesanan, array(
				'waktu_pesanan' => date('H', strtotime($i. ':00:00'))
				)
			);
		}
	}
    
    $query = "SELECT waktu_pilih 
				FROM pesanan 
				WHERE 
					waktu_pilih LIKE '$waktu_pilih%'
				AND
					waktu_pilih > '$waktu_sekarang'
				AND 
                    id_lapangan = '$id_lapangan'
				AND 
                    status = 'belum'
                ORDER BY
                    waktu_pilih ASC";

	$result = $conn->query($query);

	while($row = mysqli_fetch_assoc($result)){
		array_push($waktu_pesanan, array(
			'waktu_pesanan' => date('H', strtotime($row['waktu_pilih']))));
	}

	$j = 1;
	$waktu_pesanan_size = count($waktu_pesanan);
	for($i = $jam_buka; $i < $jam_tutup; $i++) {
		if($waktu_pesanan_size > 0) {
			if($i == $waktu_pesanan[$j-1]['waktu_pesanan']) {
				$kosong = FALSE;
				if($j != $waktu_pesanan_size) {
					$j++;
				}
			} else {
				$kosong = TRUE;
			}
		} else {
			$kosong = TRUE;
		}

		array_push($data, array(
			'waktu_pilih' => date('H:i:s', strtotime($i. ':00:00')),
			'waktu_pilih_text' => date('H:i', strtotime($i. ':00:00')) . ' - ' . date('H:i', strtotime($i. ':00:00 +60 minutes')),
			'kosong' => $kosong
			)
		);
	}
	$response = array(
		'status' => TRUE,
		'msg' => "",
		'data' => $data
	);
	$conn->close();
	echo json_encode($response);
}

function batal() {
	global $conn;
	$id = $_GET['id'];
	$query = "UPDATE pesanan 
				SET 
					status = 'batal'
				WHERE 
					id = '$id'";

	$result = $conn->query($query);
	// die(var_dump($result));
	if($result) {
		$response = array(
			'status' => TRUE,
			'msg' => 'Pesanan berhasil dibatalkan!'
		);
	} else {
		$response = array(
			'status' => FALSE,
			'msg' => 'Pesanan gagal dibatalkan!'
		);
	}
	$conn->close();
	echo json_encode($response);
}

function store() {
	global $conn;
	$json = json_decode(file_get_contents("php://input"));
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
	echo json_encode($response);
}