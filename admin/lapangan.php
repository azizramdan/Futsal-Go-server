<?php
include_once "../configuration.php";

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
				
			case 'delete':
                delete();
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
            case 'store':
                store();
                break;

            case 'update':
                update();
                break;
            
            default:
                # code...
                break;
        }
    }
}
function index() {
    global $conn;
    $id_admin = $_GET['id_admin'];
    $data = array();
    $response;
    $query = "SELECT *
            FROM lapangan
            WHERE id_admin = '$id_admin' AND deleted_at IS NULL";

    $result = $conn->query($query);
    if($result->num_rows > 0) {
		while($row = mysqli_fetch_assoc($result)){
			array_push($data, array(
				'id' => $row['id'],
				'nama' => $row['nama'],
				'harga' => $row['harga'],
				'foto' => $row['foto']
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

function update() {
	global $conn;
	$id = $_POST['id'];
	$nama = $_POST['nama'];
	$harga = $_POST['harga'];
    $foto = $_POST['foto'];
    
    $query = "UPDATE lapangan SET 
					nama = '$nama',
					harga = '$harga',
					foto = '$foto'
				WHERE
                    id = '$id'";
                    
	$result = $conn->query($query);
	if($result) {
		$response = array(
			'status' => TRUE,
			'msg' => 'Update lapangan berhasil!'
		);
	} else {
		$response = array(
			'status' => FALSE,
			'msg' => 'Update lapangan gagal!'
		);
	}
	$conn->close();
	echo json_encode($response);
}

function store() {
	global $conn;
	$id_admin = $_POST['id_admin'];
	$nama = $_POST['nama'];
	$harga = $_POST['harga'];
    $foto = $_POST['foto'];
    
    $query = "INSERT INTO 
                lapangan(id, id_admin, nama, harga, foto)
                VALUES(NULL, '$id_admin', '$nama', '$harga', '$foto')";
                
	$result = $conn->query($query);
	if($result) {
		$response = array(
			'status' => TRUE,
			'msg' => 'Tambah lapangan berhasil!'
		);
	} else {
		$response = array(
			'status' => FALSE,
			'msg' => 'Tambah lapangan gagal!'
		);
	}
	$conn->close();
	echo json_encode($response);
}

function delete() {
	global $conn;
	$id = $_GET['id'];
    
    $query = "UPDATE lapangan SET 
					deleted_at = NOW()
				WHERE
                    id = '$id'";
                    
	$result = $conn->query($query);
	if($result) {
		$response = array(
			'status' => TRUE,
			'msg' => 'Hapus lapangan berhasil!'
		);
	} else {
		$response = array(
			'status' => FALSE,
			'msg' => 'Hapus lapangan gagal!'
		);
	}
	$conn->close();
	echo json_encode($response);
}