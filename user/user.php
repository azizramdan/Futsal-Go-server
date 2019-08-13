<?php
include_once "../configuration.php";

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
            case 'login':
				login();
				break;

			case 'registrasi':
				registrasi();
				break;
			
			case 'update':
				update();
				break;
            
            default:
                # code...
                break;
        }
    }
}

function login() {
	global $conn;
	$email = $_POST['email'];
	$password = $_POST['password'];

	$query = "SELECT * FROM user WHERE email = '$email'";

	$result = $conn->query($query);
	if ($result->num_rows === 1) {
		$result = $result->fetch_assoc();
		if (password_verify($password, $result['password'])) {
			$response = array(
				'status' => TRUE,
				'msg' => 'Login berhasil',
				'data' => array(
					'id' => $result['id'],
					'nama' => $result['nama'],
					'email' => $result['email'],
					'telp' => $result['telp']
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
	echo json_encode($response);
}

function registrasi() {
	global $conn;
	$nama = $_POST['nama'];
	$telp = $_POST['telp'];
	$email = $_POST['email'];
	$password = password_hash($_POST['password'], PASSWORD_BCRYPT);

	$query = "SELECT id FROM user WHERE email = '$email'";

	$result = $conn->query($query);
	if ($result->num_rows === 0) {

		$query = "INSERT INTO user 
					(nama, telp, email, password) 
					VALUES 
					('$nama', '$telp', '$email', '$password')";

		$result = $conn->query($query);
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
	echo json_encode($response);
}

function update() {
	global $conn;
	$id = $_POST['id'];
	$nama = $_POST['nama'];
	$telp = $_POST['telp'];
	$email = $_POST['email'];
	$password = $_POST['password'];

	if($password != '') {
		
		$password = password_hash($password, PASSWORD_BCRYPT);
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
	$conn->close();
	echo json_encode($response);
}