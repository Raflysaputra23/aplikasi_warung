<?php 


class Produk_model {
	private $db;

	public function __construct() {
		$this->db = new Database();
	}

	public function tambah($data) {
		$nama = $data['nama_produk'];
		$stok = $data['stok_produk'];
		$harga = $data['harga_produk'];

		if ($_FILES['gambar_produk']['error'] <= 0) {
			$gambar = $this->uploadGambar($_FILES);
		} else {
			Flasher::setFlash('Gagal','pastikan gambar diupload','error');
			header('location:'.Constant::BASEURL.'product');
			exit;
		}

		$this->db->query('INSERT INTO produk(gambar_produk,nama_produk,stok_produk,harga_produk) VALUES (:gambar, :nama, :stok, :harga)');
		$this->db->bind('gambar',$gambar);
		$this->db->bind('nama',$nama);
		$this->db->bind('stok',$stok);
		$this->db->bind('harga',$harga);
		$this->db->execute();
		return $this->db->rowCount();

	}

	public function uploadGambar($data) {
		$namaGambar = $data['gambar_produk']['name'];
		$sizeGambar = $data['gambar_produk']['size'];
		$pathGambar = $data['gambar_produk']['tmp_name'];
		$error = $data['gambar_produk']['error'];

		$extensiGambarValid = ['jpg','jpeg','png'];
		$extensiGambar = pathinfo($namaGambar, PATHINFO_EXTENSION);

		// CEK EXTENSI GAMBAR
		if (!in_array($extensiGambar, $extensiGambarValid)) {
			Flasher::setFlash('Gagal','pastikan yang diupload hanya gambar','error');
			header('location:'.Constant::BASEURL.'product');
			exit;
		}

		// CEK SIZE GAMBAR
		if ($sizeGambar > 1000000) {
			Flasher::setFlash('Gagal','size gambar terlalu besar','error');
			header('location:'.Constant::BASEURL.'product');
			exit;
		}

		// ENKRIPSI GAMBAR
		$gambar = uniqid().'.'.$extensiGambar;

		// UPLOAD GAMBAR
		move_uploaded_file($pathGambar, 'img/'.$gambar);

		return $gambar;
	}

	public function getProdukAll() {
		$this->db->query('SELECT * FROM produk');
		$this->db->execute();
		$data = $this->db->resultSet();

		function filterWaktu($waktu) {
			$time = strtotime($waktu);
				$selisihWaktu = time() - ($time - 21600);

				// HITUNG WAKTU
				$tahun = floor(($selisihWaktu / (60 * 60 * 24 * 30 * 12)));
				$bulan = floor(($selisihWaktu / (60 * 60 * 24 * 30))); 
				$hari = floor(($selisihWaktu / (60 * 60 * 24)));
				$jam = floor(($selisihWaktu / (60 * 60))); 
				$menit = floor(($selisihWaktu / 60 ));
				$detik = floor(($selisihWaktu % 60)); 

				switch (true) {
					case $tahun > 0:
						return $tahun.' tahun yang lalu';
						break;
					case $bulan > 0:
						return $bulan.' bulan yang lalu';
						break;
					case $hari > 0:
						return $hari.' hari yang lalu';
						break;
					case $jam > 0:
						return $jam.' jam yang lalu';
						break;
					case $menit > 0:
						return $menit.' menit yang lalu';
						break;
					default:
						return $detik.' detik yang lalu';
						break;
				}
		}

		foreach ($data as $d) {
			$time = [];
			
			$time[] = $d['current_at'];
			$time = array_map('filterWaktu', $time);
			unset($d['current_at']);
			$d['current_at'] = $time[0];
			$dataBaru[] = $d;
		}
		if (isset($dataBaru)) {
			return $dataBaru;
		} else {
			return $dataBaru = [];
		}
	}

	public function hapusData($id) {
		if ($this->getProdukById($id) > 0) {
			Flasher::setFlash('Gagal','produk dalam pilihan konsumen','error');
			header('location:'.Constant::BASEURL.'product');
			exit;
		}
		$this->db->query('DELETE FROM produk WHERE id_produk = :id_produk');
		$this->db->bind('id_produk',$id);
		$this->db->execute();
		return $this->db->rowCount();
	}

	public function getProdukById($id) {
		$this->db->query('SELECT * FROM keranjang WHERE id_produk = :id_produk');
		$this->db->bind('id_produk', $id);
		$this->db->execute();
		return $this->db->single();
		 die;
	}
	
}