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

// $date = '2019-07-19 16:00:00';
// $data = array();
// $now = date('H', strtotime($date));
// $max = date('H', strtotime('07:00:00'));

// for($i = $max; $i <= $now; $i++) {
//     array_push($data, array(
//         'waktu_pilih' => date('H', strtotime($i. ':00:00'))
//         )
//     );
// }
    include_once "..\configuration.php";
    global $conn;
	global $response;
	
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
    
    $query = "SELECT waktu_pilih 
				FROM pesanan 
				WHERE 
					waktu_pilih LIKE '$waktu_pilih%'
				AND 
                    id_lapangan = '$id_lapangan'
                ORDER BY
                    waktu_pilih ASC";

	$result = $conn->query($query);

    
    if($result->num_rows > 0) {

        while($row = mysqli_fetch_assoc($result)){
			array_push($waktu_pesanan, array(
                'waktu_pesanan' => date('H', strtotime($row['waktu_pilih']))));
        }
        $j = 0;
        $waktu_pesanan_size = count($waktu_pesanan) - 1;
        for($i = $jam_buka; $i < $jam_tutup; $i++) {
            if($i == $waktu_pesanan[$j]['waktu_pesanan']) {
                $kosong = FALSE;
                if($j != $waktu_pesanan_size) {
                    $j++;
                }
            } else {
                $kosong = TRUE;
            }

			array_push($data, array(
                'waktu_pilih' => date('H:i', strtotime($i. ':00:00')),
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
	} else {
		$response = array(
			'status' => FALSE,
			'msg' => 'Tidak ada data!'
		);
	}
echo json_encode($response);

