<?php 


class Register extends Controller{

	public function index() {
		$data['judul'] = 'Register';
		$data['akses'] = Akses::hakAkses();
		$this->view('register/index',$data);
	}

	public function daftar() {
		if ($this->model('Daftar_model')->daftar($_POST) > 0) {
			Flasher::setFlash('Berhasil','data anda berhasil ditambahkan','success','daftarBerhasil');
			header('location:'.Constant::BASEURL.'register');
			exit;
		} else {
			Flasher::setFlash('Gagal','data anda tidak berhasil ditambahkan','error','daftarGagal');
			header('location:'.Constant::BASEURL.'register');
			exit;
		}
	}
}