<?php
$response = "";
if($_SERVER['REQUEST_METHOD']=='GET') {
    include_once "configuration.php";
    
    index();

    echo json_encode($response);
} else {
    if(isset($_POST['method'])) {
        include_once "configuration.php";
        $method = $_POST['method'];

        if($method == 'login') {
            login();
        } else if($method == 'registrasi') {
            registrasi();
        } else if($method == 'update') {
            update();
        }
        echo json_encode($response);
    }
}

function index() {
    global $conn;
    global $response;
    
    $query = "SELECT lapangan.*, admin.telp, admin.alamat, admin.latitude, admin.longitude, admin.bank, admin.nama_rekening, admin.no_rekening 
                FROM lapangan 
                INNER JOIN admin 
                ON lapangan.id_admin = admin.id";
    $result = $conn->query($query);
    $data = array();
    if($result->num_rows > 0) {
        while($row = mysqli_fetch_array($result)){
            array_push($data, array(
                // 'id' => $row[0], 
                // 'nama' => $row[1], 
                // 'harga' => $row[2], 
                // 'telp' => $row[3],
                // 'alamat'=>$row[4],
                // 'longitude'=>$row[5],
                // 'latitude'=>$row[6],
                // 'foto'=>$row[7],
                // 'email'=>$row[8]));

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
}