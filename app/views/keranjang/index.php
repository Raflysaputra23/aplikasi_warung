<div class="container-fluid border mt-3 rounded-2 overflow-auto gx-0 p-2 gap-2 shadow-sm d-flex flex-wrap justify-content-start position-relative overflow-hidden" style="height: 65vh";>

	<?php if ($data['keranjang'] !== []): ?>
	<?php foreach ($data['keranjang'] as $produk): ?>
	<div class="card text-bg-dark shadow-sm" style="max-width: 250px;width: 250px; height: 200px;">
	  <img src="img/<?= $produk['gambar_produk']?>" class="card-img object-fit-cover" alt="..." style="width: 100%; height: 100%;">
	  <div class="card-img-overlay" style="background-color: rgba(0, 0, 0, .5);">
	    <h5 class="card-title font-poppins fw-bold"><?= $produk['nama_produk']?></h5>
	    <div class="row mx-1 gap-2 mt-4 ">
	    	<div class="col-5 d-flex flex-column align-items-center justify-content-center border rounded-2 gap-1">
	    		<p class="m-0 font-poppins mt-2" style="font-size: 16px;">Jumlah</p>
	    		<p style="font-size: 13px;" class="font-poppins"><?= $produk['quantity']?></p>
	    	</div>
	    	<div class="col-6 d-flex flex-column align-items-center justify-content-center border rounded-2 gap-1">
	    		<p class="m-0 font-poppins mt-2" style="font-size: 16px;">Harga</p>
	    		<p style="font-size: 13px;" class="font-poppins">Rp.<?= number_format($produk['harga'],0,'.','.')?></p>
	    	</div>
	    </div>
	    <div class="mt-3">
	    	<?php if ($produk['quantity'] < $produk['stok_produk']): ?>
	    		<a href="<?= Constant::BASEURL ?>product/plusKeranjang/<?= $produk['id_produk'] ?>/<?= $produk['id_user']?>/<?= $produk['harga_produk']?>" class="btn btn-primary"><i class="fa fa-plus" style="font-size: 14px;"></i></a>
		    	<a href="<?= Constant::BASEURL ?>keranjang/minKeranjang/<?= $produk['id_produk'] ?>/<?= $produk['id_user']?>/<?= $produk['harga_produk']?>" class="btn btn-danger"><i class="fa fa-minus" style="font-size: 14px;"></i></a>
	    	<?php else: ?>
	    		<button class="btn btn-primary" disabled><i class="fa fa-plus" style="font-size: 14px;"></i></button>
		    	<a href="<?= Constant::BASEURL ?>keranjang/minKeranjang/<?= $produk['id_produk'] ?>/<?= $produk['id_user']?>/<?= $produk['harga_produk']?>" class="btn btn-danger"><i class="fa fa-minus" style="font-size: 14px;"></i></a>
	    	<?php endif; ?> 
	    </div>
	  </div>
	</div>
	<?php endforeach ?>
	<?php else: ?>
		<h3 class="font-poppins m-auto">TIDAK ADA PRODUK DIDALAM KERANJANG <i class="fa fa-search"></i></h3>
	<?php endif; ?>

	<footer id="pembayaran" class="shadow-sm position-fixed rounded-2 p-2 bg-white" style="bottom: 17px; max-width: 950px; width: 905px; border-top: 5px solid #eaeaea !important; border: 1px solid #eaeaea; border-bottom: none;">
		<div id="tombol-pembayaran" class="arrow-top rounded-circle d-flex justify-content-center align-items-center bg-primary position-absolute end-50" style="width: 30px; height: 30px; top: -15px; transform: translateX(50%);"><i class="fa fa-arrow-up text-white"></i></div>
		<form action="<?= Constant::BASEURL ?>product/tranksaksi/<?= $_SESSION['id_user']?>" method="post" id="card-pembayaran"  class="content-footer overflow-hidden mt-2 font-poppins" style="height: 2px;">
			<h3 class="">Total harga :</h3>
			<p class="fs-4 ms-2">Rp.<?= number_format($data['total_harga']['harga'],0,'.','.')?></p>
			<?php if ($data['total_harga']['harga'] == 0): ?>
				<button type="submit" name="submit" class="btn btn-primary" disabled>Bayar</button>
			<?php else: ?>
				<button type="submit" name="submit" class="btn btn-primary">Bayar</button>
			<?php endif; ?>
		</form>
	</footer>

	<!-- CANVAS -->
	<div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel">
	  <div class="offcanvas-header">
	    <h5 class="offcanvas-title" id="offcanvasBottomLabel">Offcanvas bottom</h5>
	    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
	  </div>
	  <div class="offcanvas-body small">
	    ...
	  </div>
	</div>

</div>

<script>
	const cardPembayaran = document.getElementById('card-pembayaran');
	const tombolPembayaran = document.getElementById('tombol-pembayaran');

	tombolPembayaran.addEventListener('click', function() {
	  cardPembayaran.classList.toggle('max-height-pembayaran')
	  tombolPembayaran.querySelector('i').classList.toggle('fa-arrow-down')
	})

</script>