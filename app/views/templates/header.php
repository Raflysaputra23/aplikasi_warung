<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= $data['judul'] ?></title>

	<!-- BOOTSTRAP -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

	<!-- SWETALERT -->
	<link rel="stylesheet" href="framework/swetalert/sweetalert2.min.css">
	<script src="framework/swetalert/sweetalert2.all.min.js"></script>

	<!-- FONTSGOOGLE -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Madimi+One&family=Poppins:wght@300&family=Shadows+Into+Light&family=Tillana&display=swap" rel="stylesheet">

	<!-- FONTAWESOME -->
	<link rel="stylesheet" href="framework/fontawesome/css/font-awesome.min.css">

	<!-- MY STYLE -->
	<style>
		<?= require_once 'css/style.css' ?>
	</style>
</head>
<body class="overflow-hidden">
	<?= Flasher::getFlash('loginBerhasil')?>
	
	<div class="container-sm my-5" style="max-width: 950px;">
		<div class="container-fluid gx-0">
			<div class="d-flex justify-content-between align-items-center py-2">
				<div class="d-flex gap-2">
					<img src="img/<?= $data['data_user']['gambar_user']?>" alt="" width="50px" height="50px" class="rounded-circle shadow-sm">
					<div class="">
						<p class="font-poppins m-0"><?= $data['data_user']['nama_lengkap']?></p>
						<?php if ($data['data_user']['status'] == 'online'): ?>
							<span class=" px-2 rounded-2 text-white bg-success font-tilana" style="font-size: 13px;"><?= $data['data_user']['status']?></span>
						<?php else : ?>
						<span class=" px-2 rounded-2 text-white bg-danger font-tilana" style="font-size: 13px;"><?= $data['data_user']['status']?></span>
						<?php endif ; ?>
					</div>
				</div>
				<h1 class="font-tilana text-danger text-shadow">Aplikasi <span class="text-primary">Warung</span></h1>
			</div>
			<div class="alert alert-primary shadow-sm position-relative d-flex justify-content-between align-items-center hover-group">
				<!-- <i class="fa fa-exclamation position-absolute" style="left: -2px; top: -12px; font-size: 25px; rotate: -10deg;"></i> -->
				<span class="font-poppins">Selamat datang <b class="text-primary">ADMINISTRATOR</b> di aplikasi kasir.</span>
				<i class="fa fa-bars d-none" style="font-size: 20px; transform: scaleX(.2);" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="right" data-bs-content="Hi, Admin"></i>
			</div>
			<div class="row">
				<div class="col-12 d-flex justify-content-between align-items-center">
					<div class="">
						<a href="<?= Constant::BASEURL ?>" class="btn btn-primary"><i class="fa fa-home"></i> Home</a>
						<a href="<?= Constant::BASEURL ?>product" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Product</a>
						<a href="<?= Constant::BASEURL ?>keranjang" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Keranjang</a>
					</div>
					<a id="logout" href="<?= Constant::BASEURL ?>home/logout/<?= $_SESSION['id_user']?>" class="btn btn-danger font-tilana opacity-50 hover position-relative me-2">
						<div class="pover">Log out</div>
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 25px; height: 25px;">
					  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
					</svg>
					</a>
				</div>
			</div>
		</div>
		
	
