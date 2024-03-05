<?php 

class Tranksaksi_model {
	private $db;

	public function __construct() {
		$this->db = new Database();
	}

	public function getTranksaksiAll() {
		$idTranksaksi = $_SESSION['idTranksaksi'];

		$this->db->query('SELECT * FROM tranksaksi join keranjang join produk join users WHERE id_tranksaksi = :id_tranksaksi AND tranksaksi.id_keranjang = keranjang.id_keranjang AND keranjang.id_user = users.id_user AND keranjang.id_produk = produk.id_produk');
		$this->db->bind('id_tranksaksi', $idTranksaksi);
		$this->db->execute();
		return $this->db->resultSet();
	}

	public function getTotalHarga($id_keranjang) {
		$idTranksaksi = $_SESSION['idTranksaksi'];

		$this->db->query('SELECT SUM(harga) as totalHarga FROM tranksaksi join keranjang WHERE id_tranksaksi = :id_tranksaksi AND tranksaksi.id_keranjang = keranjang.id_keranjang');
		$this->db->bind('id_tranksaksi', $idTranksaksi);
		$this->db->execute();
		return $this->db->single();
	}

	public function tambahTranksaksi($id_keranjang) {
			$data = $this->getTranksaksiAll();
			foreach ($data as $produk) {
				if ($produk['quantity'] > $produk['stok_produk']) {
					Flasher::setFlash('Gagal','pesanan anda melebihi batas stok produk','error');
					header('location:'.Constant::BASEURL.'keranjang');
					exit;
				}
			}
			$idTranksaksi = $_SESSION['idTranksaksi'] = rand();

			$this->db->query('INSERT INTO tranksaksi(id_tranksaksi, id_keranjang) VALUES (:id_tranksaksi, :id_keranjang)');
			$this->db->bind('id_tranksaksi', $idTranksaksi);
			$this->db->bind('id_keranjang', 'AOBSHY'.$id_keranjang);
			$this->db->execute();
			$this->kurangiStokProduk();
			return $this->db->rowCount();

	}

	public function hapusKeranjangAll($id_keranjang) {
		$this->db->query('DELETE FROM keranjang WHERE id_keranjang = :id_keranjang');
		$this->db->bind('id_keranjang', $id_keranjang);
		$this->db->execute();
		header('location:'.Constant::BASEURL.'keranjang');
		exit;
	}

	public function kurangiStokProduk() {
		$data = $this->getTranksaksiAll();
			foreach ($data as $produk) {
				$this->__construct();

				$stok = $produk['quantity'];
				$idProduk = $produk['id_produk'];
					
				$this->db->query('UPDATE produk SET stok_produk = stok_produk - :stok_produk WHERE id_produk = :id_produk');
				$this->db->bind('stok_produk', $stok);
				$this->db->bind('id_produk', $idProduk);
				$this->db->execute();
			}
	}

}