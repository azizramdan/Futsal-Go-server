<?php
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['method'])) {
	//include file connect.php untuk menyambungkan file create.php dengan database
	include_once "configuration.php";
	//inisialisasi variabel method
	$method = $_POST['method'];
	//inisialisasi variabel untuk menampung data
	$response;

	if($method == 'login') {
		login();
	} else if($method == 'registrasi') {
		registrasi();
	} else if($method == 'update') {
		update();
	}

	header('Content-type: application/json'); //set tipe response jadi json
	echo json_encode($response); //merubah respone menjadi JsonObject lalu dikirim
}
function login() {
	//inisialisasi variabel yang akan ditampung dan diolah dengan query
	$email = $_POST['email'];
	$password = $_POST['password'];
	global $conn;
	global $response;
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
					'telp' => $result['telp'],
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
	$conn->close();
}

function registrasi($nama, $email, $password) {
	
}

function update() {

}