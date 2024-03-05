<?php 


class Home extends Controller{

	public function index() {
		$data['judul'] = 'Home';
		$data['akses'] = Akses::hakAksesHome();
		$data['data_user'] = $this->model('Home_model')->getUserById($_SESSION['id_user']);
		$this->view('templates/header', $data);
		$this->view('templates/sidebar');
		$this->view('home/index');
		$this->view('templates/footer');

	}

	public function logout($id) {
		session_start();
		session_unset();
		session_destroy();
		setcookie('ingat','', time() - 3600, '/kasir/');
		setcookie('id_user','', time() - 3600, '/kasir/');

		$this->model('Home_model')->updateStatus($id);
		header('location:'.Constant::BASEURL.'login');
		exit;
	}
}