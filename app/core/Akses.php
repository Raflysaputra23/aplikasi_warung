<?php 

class Akses {
	public static function hakAkses() {
		if (isset($_SESSION['id_user'])) {
			header('location:'.Constant::BASEURL.'home');
			exit;
		} elseif(isset($_COOKIE['ingat'])) {
			if ($_COOKIE['ingat'] == $_COOKIE['ingat']) {
				$_SESSION['id_user'] = $_COOKIE['id_user'];
				header('location:'.Constant::BASEURL.'home');
				exit;
			} 
		} 
	}

	public static function hakAksesHome() {
		if (empty($_SESSION['id_user'])) {
			header('location:'.Constant::BASEURL.'login');
			exit;
		}
	}
}