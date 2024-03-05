<?php 



class Daftar_model {
	private $db;

	public function __construct() {
		$this->db = new Database();
	}

	public function daftar($data) {
		$username = $data['username'];
		$username2 = $data['username2'];
		$email = $data['email'];
		$password = $data['password'];
		$password2= $data['password2'];

		// CEK APAKAH USERNAME SUDAH TERSEDIA ATAU BELUM
		if (count($this->getUserById('username',$username)) > 0) {
			Flasher::setFlash('Gagal','username sudah terdaftar','error');
			header('location:'.Constant::BASEURL.'register');
			die;
		}
	
		// CEK PASSWORD
		if ($password !== $password2) {
			Flasher::setFlash('Gagal','pastikan password anda sudah benar','error');
			header('location:'.Constant::BASEURL.'register');
			die;
		}

		// CEK EMAIL
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			Flasher::setFlash('Gagal','pastikan email anda sudah benar','error');
			header('location:'.Constant::BASEURL.'register');
			die;
		}

		// ENKRIPSI PASSWORD
		$passwordHash = password_hash($password, PASSWORD_DEFAULT);

		// MASUKKAN DATA KEDALAM DATABASE
		$this->db->query("INSERT INTO users(username, nama_lengkap, email, password) VALUES (:username, :nama_lengkap, :email, :password)");
		$this->db->bind('username',$username); 
		$this->db->bind('nama_lengkap',$username2); 
		$this->db->bind('email',$email); 
		$this->db->bind('password',$passwordHash); 
		$this->db->execute();
		return $this->db->rowCount();
		die;
	}

	public function getUserById($id,$nilai) {
		$this->db->query("SELECT * FROM users WHERE $id = :$id");
		$this->db->bind("$id",$nilai);
		$this->db->execute();
		return $this->db->resultSet();	
	}
}