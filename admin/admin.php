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
                index();
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

	$query = "SELECT * FROM admin WHERE email = '$email'";

	$result = $conn->query($query);
	if ($result->num_rows === 1) {
		$result = $result->fetch_assoc();
		if (password_verify($password, $result['password'])) {
			$response = array(
				'status' => TRUE,
				'msg' => 'Login berhasil',
				'data' => array(
					'id' => $result['id'],
					'telp' => $result['telp'],
                    'email' => $result['email'],
                    'bank' => $result['bank'],
                    'nama_rekening' => $result['nama_rekening'],
                    'no_rekening' => $result['no_rekening'],
                    'jam_buka' => $result['jam_buka'],
					'jam_tutup' => $result['jam_tutup']
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

function update() {
	global $conn;
	$id = $_POST['id'];
	$telp = $_POST['telp'];
	$bank = $_POST['bank'];
	$nama_rekening = $_POST['nama_rekening'];
	$no_rekening = $_POST['no_rekening'];
	$jam_buka = $_POST['jam_buka'];
	$jam_tutup = $_POST['jam_tutup'];
	$password = $_POST['password'];

	if($password != '') {
		$password = password_hash($password, PASSWORD_BCRYPT);
		$query = "UPDATE admin SET 
					telp = '$telp',
					bank = '$bank',
					nama_rekening = '$nama_rekening',
					no_rekening = '$no_rekening',
					jam_buka = '$jam_buka',
					jam_tutup = '$jam_tutup',
					password = '$password'
				WHERE
					id = '$id'";
	} else {
		$query = "UPDATE admin SET 
					telp = '$telp',
					bank = '$bank',
					nama_rekening = '$nama_rekening',
					no_rekening = '$no_rekening',
					jam_buka = '$jam_buka',
					jam_tutup = '$jam_tutup'
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