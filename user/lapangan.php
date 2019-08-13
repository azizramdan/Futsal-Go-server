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
            
            case 'fasilitas':
				fasilitas();
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
            case 'index':
				break;
            
            default:
                # code...
                break;
        }
    }
}

function index() {
	global $conn;
	$sort = $_GET['sort'];

    if($sort == 'terlaris') {
        $query = "SELECT
                        lapangan.*,
                        admin.telp,
                        admin.alamat,
                        admin.latitude,
                        admin.longitude,
                        admin.bank,
                        admin.nama_rekening,
                        admin.no_rekening,
                        (SELECT COUNT(id) FROM pesanan WHERE id_lapangan = lapangan.id AND status = 'sudah') AS terlaris
                    FROM
                        lapangan, admin
                    WHERE 
                        deleted_at IS NULL
                        AND lapangan.id_admin = admin.id
                    ORDER BY terlaris DESC";

    } else if($sort == 'termurah') {
        $query = "SELECT
                    lapangan.*,
                    admin.telp,
                    admin.alamat,
                    admin.latitude,
                    admin.longitude,
                    admin.bank,
                    admin.nama_rekening,
                    admin.no_rekening
                FROM
                    lapangan, admin
                WHERE deleted_at IS NULL AND lapangan.id_admin = admin.id
                ORDER BY CONVERT(lapangan.harga, decimal) ASC";

    } else {
        $query = "SELECT 
                    lapangan.*, 
                    admin.telp, 
                    admin.alamat, 
                    admin.latitude, 
                    admin.longitude, 
                    admin.bank, 
                    admin.nama_rekening, 
                    admin.no_rekening 
                FROM lapangan, admin
                WHERE deleted_at IS NULL AND lapangan.id_admin = admin.id";
    }
    
    $result = $conn->query($query);
    $data = array();
    if($result->num_rows > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            array_push($data, array(
                'id' => $row['id'], 
                'nama' => $row['nama'], 
                'harga' => $row['harga'], 
                'foto' => $row['foto'],
                'telp'=>$row['telp'],
                'alamat'=>$row['alamat'],
                'latitude'=>$row['latitude'],
                'longitude'=>$row['longitude'],
                'bank'=>$row['bank'],
                'nama_rekening'=>$row['nama_rekening'],
                'no_rekening'=>$row['no_rekening']));
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

function fasilitas() {
    global $conn;
    $id = $_GET['id'];
    $query = "SELECT 
                    fasilitas_lapangan.id,
                    fasilitas.nama
                FROM fasilitas_lapangan, fasilitas 
                WHERE fasilitas_lapangan.id_fasilitas = fasilitas.id
                    AND fasilitas_lapangan.id_lapangan = '$id'";
    $result = $conn->query($query);
    $data = array();
    if($result->num_rows > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            array_push($data, array(
                'id' => $row['id'], 
                'nama' => $row['nama']));
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