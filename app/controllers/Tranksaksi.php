<?php 


class Tranksaksi extends Controller {

	public function index() {
		$data['tranksaksi'] = $this->model('Tranksaksi_model')->getTranksaksiAll($_SESSION['id_user']);
		$data['total_harga'] = $this->model('Tranksaksi_model')->getTotalHarga($_SESSION['id_user']);
		$this->view('Tranksaksi/index', $data);
	}

	public function hapusKeranjang($id_keranjang) {
		$this->model('Tranksaksi_model')->hapusKeranjangAll($id_keranjang);
	}

}