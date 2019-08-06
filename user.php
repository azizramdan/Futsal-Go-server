<?php
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['method'])) {
	//include file connect.php untuk menyambungkan file create.php dengan database
	include_once "configuration.php";
	//inisialisasi variabel method
	$method = $_POST['method'];
	//inisialisasi variabel untuk menampung data
	$response = "";

	if($method == 'login') {
		login();
	} else if($method == 'registrasi') {
		registrasi();
	} else if($method == 'edit') {
		edit();
	} else if($method == 'update') {
		update();
	}

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

function registrasi() {
	//inisialisasi variabel yang akan ditampung dan diolah dengan query
	$nama = $_POST['nama'];
	$telp = $_POST['telp'];
	$email = $_POST['email'];
	$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
	global $conn;
	global $response;
	//inisialiasi query cek apakah email belum terdaftar
	$query = "SELECT id FROM user WHERE email = '$email'";
	//pemanggilan fungsi mysqli_query untuk mengirimkan perintah sesuai parameter yang diisi
	$result = $conn->query($query);
	//cek apakah email belum terdaftar
	if ($result->num_rows === 0) {
		// /$conn->close();
		//inisialisasi query insert data
		$query = "INSERT INTO user 
					(nama, telp, email, password) 
					VALUES 
					('$nama', '$telp', '$email', '$password')";

		$result = $conn->query($query);
		//pengkondisian saat fungsi mysqli_query berhasil atau gagal dieksekusi
		if($result) {
			$response = array(
				'status' => TRUE,
				'msg' => 'Pendaftaran berhasil!'
			);
		} else {
			$response = array(
				'status' => FALSE,
				'msg' => 'Pendaftaran gagal!'
			);
		}
	} else {
		$response = array(
			'status' => FALSE,
			'msg' => 'Pendaftaran gagal, email sudah terdaftar.'
		);
	}
	$conn->close();
}

function edit() {
	global $conn;
	global $response;
	$id = $_POST['id'];
	$data = array();

	$query = "SELECT * FROM user WHERE id = '$id'";

	$result = $conn->query($query);
	if($result->num_rows > 0) {
		while($row = mysqli_fetch_assoc($result)) {
			array_push($data, array(
				'id' => $row['id'],
				'nama' => $row['nama'],
				'email' => $row['email'],
				'telp' => $row['telp'],
			));
		}
		$response = array(
			'status' => TRUE,
			'msg' => '',
			'data' => $data
		);
	} else {
		$response = array(
			'status' => FALSE,
			'msg' => '',
			'data' => 'Tidak ada data!'
		);
	}
}

function update() {
	$id = $_POST['id'];
	$nama = $_POST['nama'];
	$telp = $_POST['telp'];
	$email = $_POST['email'];
	global $conn;
	global $response;
	//cek apakah password akan diganti
	if(isset($_POST['password'])) {
		$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
		$query = "UPDATE user SET 
					nama = '$nama', 
					telp = '$telp',
					email = '$email',
					password = '$password'
				WHERE
					id = '$id'";
	} else {
		$query = "UPDATE user SET 
					nama = '$nama', 
					telp = '$telp',
					email = '$email'
				WHERE
					id = '$id'";
	}
	$result = $conn->query($query);
	if($result) {
		$response = array(
			'status' => TRUE,
			'msg' => 'Update akun berhasil!'
		);
	} else {
		$response = array(
			'status' => FALSE,
			'msg' => 'Update akun gagal!'
		);
	}
}