<?php 


class Keranjang extends Controller {

	public function index() {
		$data['judul'] = 'Keranjang';
		$data['akses'] = Akses::hakAksesHome();
		$data['data_user'] = $this->model('Home_model')->getUserById($_SESSION['id_user']);
		$data['keranjang'] = $this->model('Keranjang_model')->getProdukAll($_SESSION['id_user']);
		$data['total_harga'] = $this->model('Keranjang_model')->getTotalHarga($_SESSION['id_user']);
		$this->view('templates/header', $data);
		$this->view('keranjang/index', $data);
		$this->view('templates/footer');
	}

	public function minKeranjang($id_produk, $id_user, $harga) {
		$produk = $id_produk;
		$user = $id_user;
		$id_keranjang = 'AOBSHY'.$id_user;

		if (empty($_SESSION['cart'])) {
			$_SESSION['cart'] = [];
		}

		if (isset($_SESSION['cart'][$produk])) {
			$_SESSION['cart'][$produk]['quantity'] -= 1;
			$_SESSION['cart'][$produk]['harga'] -= $harga;
		} else {
			$_SESSION['cart'][$produk] = [
				"id_keranjang" => $id_keranjang,
				"id_produk" => $produk,
				"id_user" => $user,
				"quantity" => 1,
				"harga" => $harga
			];	
		}
		
		$this->model('Keranjang_model')->tambahProduk($_SESSION['cart'], $id_produk);
	}
}