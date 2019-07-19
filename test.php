<?php
header('Content-type: application/json');
// echo password_hash("admin", PASSWORD_BCRYPT);
// $hash = '$2y$10$N76KQD64bov2Styq/em./eeg.MS85dZfIaXbTkyETfDH2jIUUYLtS';
// if (password_verify('admin', $hash)) {
//     echo 'Password is valid!';
// } else {
//     echo 'Invalid password.';
// }

// $waktu_pilih_tanggal = "2019-07-18";
// $waktu_pilih_jam = ["09:00:00","12:00:00","15:00:00","21:00:00","22:00:00"];

// $waktu_pilih = array();
// $query = "";

// for($i = 0; $i < count($waktu_pilih_jam); $i++) {
//     $waktu_pilih[] = $waktu_pilih_tanggal . " " . $waktu_pilih_jam[$i];
//     $query .= "INSERT INTO pesanan (id_user, id_lapangan, waktu_pilih, metode_bayar, status) VALUES ('id_user', 'id_lapangan', '$waktu_pilih[$i]', 'metode_bayar', 'belum');";
// }

$date = '2019-07-19 16:00:00';
$data = array();
$now = date('H', strtotime($date));
$max = date('H', strtotime('07:00:00'));

for($i = $max; $i <= $now; $i++) {
    array_push($data, array(
        'waktu_pilih' => date('H', strtotime($i. ':00:00'))
        )
    );
}

$response = array(
    'status' => TRUE,
    'msg' => $data
);
echo json_encode($response);

