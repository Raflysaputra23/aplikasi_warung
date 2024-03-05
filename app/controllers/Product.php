<?php 


class Product extends Controller {

	public function index() {
		$data['judul'] = 'Product';
		$data['akses'] = Akses::hakAksesHome();
		$data['data_user'] = $this->model('Home_model')->getUserById($_SESSION['id_user']);
		$data['produk'] = $this->model('Produk_model')->getProdukAll();

		$this->view('templates/header',$data);
		$this->view('product/index',$data);
		$this->view('templates/footer');
	}

	public function tambahProduk() {
		if ($this->model('Produk_model')->tambah($_POST) > 0) {
			Flasher::setFlash('Berhasil','produk baru ditambahkan','success');
			header('location:'.Constant::BASEURL.'product');
			exit;
		} else {
			Flasher::setFlash('Gagal','produk gagal ditambahkan','error');
			header('location:'.Constant::BASEURL.'product');
			exit;
		}
	}

	public function hapusProduk($id) {
		
		if ($this->model('Produk_model')->hapusData($id) > 0) {
			Flasher::setFlash('Berhasil','produk berhasil dihapus','success');
			header('location:'.Constant::BASEURL.'product');
			exit;
		}else {
			Flasher::setFlash('Gagal','produk gagal dihapus','success');
			header('location:'.Constant::BASEURL.'product');
			exit;
		}
	}
	public function plusKeranjang($id_produk, $id_user, $harga) {
		$produk = $id_produk;
		$user = $id_user;
		$id_keranjang = 'AOBSHY'.$id_user;

		if (empty($_SESSION['cart'])) {
			$_SESSION['cart'] = [];
		}

		if (isset($_SESSION['cart'][$produk])) {
			$_SESSION['cart'][$produk]['quantity'] += 1;
			$_SESSION['cart'][$produk]['harga'] += $harga;
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

	public function tranksaksi($id_keranjang) {
		if ($this->model('Tranksaksi_model')->tambahTranksaksi($id_keranjang) > 0) {
			header('location:'.Constant::BASEURL.'tranksaksi');
			unset($_SESSION['cart']);
			exit;
		}else {
			Flasher::setFlash('Gagal','produk gagal dipesan','error');
			header('location:'.Constant::BASEURL.'tranksaksi');
			exit;
		}
	}
}