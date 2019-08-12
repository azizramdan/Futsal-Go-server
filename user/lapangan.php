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
                        lapangan.id_admin = admin.id
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
                WHERE lapangan.id_admin = admin.id
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
                FROM lapangan 
                INNER JOIN admin 
                ON lapangan.id_admin = admin.id";
    }
    
    $result = $conn->query($query);
    $data = array();
    if($result->num_rows > 0) {
        while($row = mysqli_fetch_array($result)){
            array_push($data, array(
                'id' => $row[0], 
                'nama' => $row[2], 
                'harga' => $row[3], 
                'foto' => $row[4],
                'telp'=>$row[5],
                'alamat'=>$row[6],
                'latitude'=>$row[7],
                'longitude'=>$row[8],
                'bank'=>$row[9],
                'nama_rekening'=>$row[10],
                'no_rekening'=>$row[11]));
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