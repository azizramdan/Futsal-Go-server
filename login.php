<?php
if($_SERVER['REQUEST_METHOD']=='POST') {
	//include file connect.php untuk menyambungkan file create.php dengan database
	include "configuration.php";
	//inisialisasi variabel yang akan ditampung dan diolah dengan query
	$email = $_POST['email'];
	$password = $_POST['password'];
	//inisialiasi query cek akun
	$query = "SELECT * FROM user WHERE email = '$email'";
	//pemanggilan fungsi mysqli_query untuk mengirimkan perintah sesuai parameter yang diisi
	$result = $conn->query($query);
	//pengkondisian saat fungsi mysqli_query berhasil atau gagal dieksekusi
	if ($result->num_rows === 1) {
		$result = $result->fetch_assoc();
		if (password_verify($password, $result['password'])) {
			$response = array(
				'status' => TRUE,
				'msg' => 'Login berhasil',
				'data' => array(
					'id' => $result['id'],
					'nama' => $result['nama'],
					'email' => $result['email']
				)
			);
		} else {
			$response = array(
				'status' => FALSE,
				'msg' => 'Password salah!'
			);
		}
	} else {
		$response = array(
			'status' => FALSE,
			'msg' => 'Email tidak terdaftar!'
		);
	}
	echo json_encode($response); //merubah respone menjadi JsonObject lalu dikirim
	$conn->close();
}