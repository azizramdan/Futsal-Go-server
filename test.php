<?php
header('Content-type: application/json');
// echo password_hash("admin", PASSWORD_BCRYPT);
// $hash = '$2y$10$N76KQD64bov2Styq/em./eeg.MS85dZfIaXbTkyETfDH2jIUUYLtS';
// if (password_verify('admin', $hash)) {
//     echo 'Password is valid!';
// } else {
//     echo 'Invalid password.';
// }

$waktu_pilih_tanggal = "2019-07-18";
$waktu_pilih_jam = ["09:00:00","12:00:00","15:00:00","21:00:00","22:00:00"];

$waktu_pilih = array();
$query = "";

for($i = 0; $i < count($waktu_pilih_jam); $i++) {
    $waktu_pilih[] = $waktu_pilih_tanggal . " " . $waktu_pilih_jam[$i];
    $query .= "INSERT INTO pesanan (id_user, id_lapangan, waktu_pilih, metode_bayar, status) VALUES ('id_user', 'id_lapangan', '$waktu_pilih[$i]', 'metode_bayar', 'belum');";
}

$response = array(
    'status' => TRUE,
    'msg' => $query
);
echo json_encode($response);

