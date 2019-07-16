<?php
$response;
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
    
    $query = "SELECT * FROM lapangan";
    $result = $conn->query($query);
    $data = array();
    while($row = mysqli_fetch_array($result)){
        array_push($data, array(
            'id' => $row[0], 
            'nama' => $row[1], 
            'harga' => $row[2], 
            'telp' => $row[3],
            'alamat'=>$row[4],
            'longitude'=>$row[5],
            'latitude'=>$row[6],
            'foto'=>$row[7],
            'email'=>$row[8]));
    }
    $response = array(
        'status' => True,
        'msg' => '',
        'data' => $data
    );
	$conn->close();
}