<?php
include_once "configuration.php";
global $conn;
$query = "UPDATE pesanan 
				SET 
					status = 'kadaluarsa'
				WHERE 
                    status = 'belum' AND waktu_pilih < NOW()";
$result = $conn->query($query);
if($result) {
    $response = array(
        'status' => TRUE,
        'msg' => 'Update berhasil!'
    );
} else {
    $response = array(
        'status' => FALSE,
        'msg' => 'Update gagal!'
    );
}
// $conn->close();
// echo json_encode($response);