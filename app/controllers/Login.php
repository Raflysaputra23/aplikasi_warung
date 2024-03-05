<?php 


class Login extends Controller{

	public function index() {
		$data['judul'] = 'Login';
		$data['akses'] = Akses::hakAkses();
		$this->view('login/index',$data);
	}

	public function masuk() {
		$this->model('Login_model')->masuk($_POST);
	}
}