<?php 


class Keranjang_model {
	private $db;

	public function __construct() {
		$this->db = new Database();
	}

	public function tambahProduk($data_produk, $id_produk) {
		$data = $data_produk[$id_produk];
		$idProduk = $data['id_produk'];
		$idUser = $data['id_user'];
		$quantity = $data['quantity'];
		$harga = $data['harga'];
		$idKeranjang = $data['id_keranjang'];

		$stok = $this->getStokProduk($idProduk);
		if ($quantity > $stok['stok_produk']) {
			$_SESSION['cart'][$idProduk]['quantity'] -= 1;
			Flasher::setFlash('Gagal','pesanan anda melebihi stok produk','error');
			header('location:'.Constant::BASEURL.'product');
			exit;
		}

		if ($quantity === 0) {
			$this->hapusKeranjang($idProduk, $idKeranjang);
			unset($_SESSION['cart'][$idProduk]);
			header('location:'.Constant::BASEURL.'keranjang');
			exit;
		}

		if ($this->getProdukById($idProduk, $idKeranjang) > 0) {
			$this->updateProduk($quantity, $harga, $idProduk, $idKeranjang);
			header('location:'.Constant::BASEURL.'keranjang');
			exit;
		} else {
			$this->db->query('INSERT INTO keranjang VALUES (:id_keranjang, :id_produk, :id_user, :quantity, :harga)');
			$this->db->bind('id_keranjang', $idKeranjang);
			$this->db->bind('id_produk', $idProduk);
			$this->db->bind('id_user', $idUser);
			$this->db->bind('quantity', $quantity);
			$this->db->bind('harga', $harga);
			$this->db->execute();
			header('location:'.Constant::BASEURL.'keranjang');
		}
	}

	public function getProdukById($id_produk, $id_keranjang) {
		$this->db->query('SELECT * FROM keranjang WHERE id_produk = :id_produk AND id_keranjang = :id_keranjang');
		$this->db->bind('id_produk', $id_produk);
		$this->db->bind('id_keranjang', $id_keranjang);

		$this->db->execute();
		return $this->db->single();
		 die;
	}

	public function updateProduk($quantity, $harga, $id_produk, $id_keranjang) {
		$this->db->query('UPDATE keranjang SET quantity = :quantity, harga = :harga WHERE id_produk = :id_produk AND id_keranjang = :id_keranjang');
		$this->db->bind('quantity', $quantity);
		$this->db->bind('harga', $harga);
		$this->db->bind('id_produk', $id_produk);
		$this->db->bind('id_keranjang', $id_keranjang);
		$this->db->execute();
	}

	public function getProdukAll($id_keranjang) {
		$this->db->query('SELECT * FROM keranjang join produk join users WHERE keranjang.id_produk = produk.id_produk AND keranjang.id_user = users.id_user AND id_keranjang = :id_keranjang');
		$this->db->bind('id_keranjang', 'AOBSHY'.$id_keranjang);
		$this->db->execute();
		return $this->db->resultSet();
	}

	public function hapusKeranjang($id_produk, $id_keranjang) {
		$this->db->query('DELETE FROM keranjang WHERE id_produk = :id_produk AND id_keranjang = :id_keranjang');
		$this->db->bind('id_produk', $id_produk);
		$this->db->bind('id_keranjang', $id_keranjang);
		$this->db->execute();	
	}
	public function getTotalHarga($id_keranjang) {
		$this->db->query('SELECT SUM(harga) as harga FROM keranjang WHERE id_keranjang = :id_keranjang');
		$this->db->bind('id_keranjang', 'AOBSHY'.$id_keranjang);
		$this->db->execute();
		return $this->db->single();
	}
	public function getStokProduk($id_produk) {
		$this->db->query('SELECT stok_produk FROM produk WHERE id_produk = :id_produk');
		$this->db->bind('id_produk', $id_produk);
		$this->db->execute();
		return $this->db->single();
	}
}