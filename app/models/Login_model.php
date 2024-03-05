<?php 


class Login_model {
	private $db;


	public function __construct() {
		$this->db = new Database();
	}

	public function masuk($data) {
		$username = $data['username'];
		$password = $data['password'];
		
		if (isset($data['cookie'])) {
			if ($data['cookie'] == '') {
				$cookie = false;
			} else {
				$cookie = $data['cookie'];
			}	
		} 

		// CEK APAKAH USER SUDAH DAFTAR ATAU BELUM
		$data = $this->getUserById('username',$username);

		if ($data == false) {
			Flasher::setFlash('Gagal','username yang anda masukkan tidak terdaftar','error');
			header('location:'.Constant::BASEURL.'login');
			die;
		}

		// PERIKSA PASSWORD
		if (!password_verify($password, $data['password'])) {
			Flasher::setFlash('Gagal','password anda tidak sesuai','error');
			header('location:'.Constant::BASEURL.'login');
			die;
		} else {
			if ($cookie != false) {
				Flasher::setFlash('Berhasil','anda berhasil login','success');
				setcookie('ingat',password_hash('rahasia', PASSWORD_DEFAULT), time() + 60 * 60 * 24 * 30 * 12, '/kasir/');
				setcookie('id_user',$data['id_user'], time() + 60 * 60 * 24 * 30 * 12, '/kasir/');
				$_SESSION['id_user'] = $data['id_user'];
				$this->updateStatus($data['id_user']);
				header('location:'.Constant::BASEURL.'home');
				exit;
			} else {
				Flasher::setFlash('Berhasil','anda berhasil login','success');
				$_SESSION['id_user'] = $data['id_user'];
				$this->updateStatus($data['id_user']);
				header('location:'.Constant::BASEURL.'home');
				exit;
			}
		}
	}

	public function getUserById($id,$nilai) {
		$this->db->query("SELECT * FROM users WHERE $id = :$id");
		$this->db->bind("$id",$nilai);
		$this->db->execute();
		return $this->db->single();	
	}

	public function updateStatus($id) {
		$this->db->query("UPDATE users SET status = 'online' WHERE id_user = :id");
		$this->db->bind('id',$id);
		$this->db->execute();
	}
}