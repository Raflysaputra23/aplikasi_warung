<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= $data['judul']?></title>

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

	<style>
		.font-poppins {
			font-family: 'Poppins', sans-serif;
		}
		.font-madimi {
			font-family: "Madimi One", sans-serif;
		}
		.font-intro {
			font-family: "Shadows Into Light", cursive;
		}
		.font-tilana {
			font-family: "Tillana", system-ui;
		}
		.text-shadow {
			text-shadow: -1px 1px 2px black;
		}
		body {
			display: flex;
			justify-content: center;
			align-items: center;
			height: 100vh;
		}
		form {
			transition: all .3s ease;
		}
		.form-group input:focus:valid {
			border: 1px solid green;
			box-shadow: 0 0 2px green;
		}
		.form-group input:focus:invalid {
			border: 1px solid red;
			box-shadow: 0 0 2px red;
		}
		.form-group input:focus ~ label,
		.form-group input:valid ~label{
			transform: translateY(-25px);
			background-color: blue;
			padding: 2px 6px;
			color: white;
			border-radius: 5px;
			font-size: 15px;
			transition: all .3s ease;

		}
		.spin-right {
			animation: spin 3s linear infinite forwards;
		}
		.spin-left {
			animation: spin 3s linear infinite backwards;

		}
		.container::before {
			content: '';
			position: absolute;
			width: 80px;
			height: 80px;
			left: -30px;
			top: -30px;
			border-radius: 100%;
			background-color: blue;
			z-index: -999;
			border-right: 3px solid red;
			border-left: 3px solid blue;
			animation: spin 1s linear infinite forwards;
		}
		.container::after {
			content: '';
			position: absolute;
			width: 80px;
			height: 80px;
			right: -30px;
			bottom: -30px;
			border-radius: 100%;
			background-color: red;
			z-index: -9999;
			border-right: 3px solid red;
			border-left: 3px solid blue;
			animation: spin 1s linear infinite forwards;
		}
		.container {
			background-color: rgba(255, 255, 255, .5);
			backdrop-filter: blur(10px);
			
		}
		@keyframes spin {
			0% {
				transform: rotate(0deg);
			}
			100% {
				transform: rotate(360deg);
			}
		}
	</style>
</head>
<body>
	<?= Flasher::getFlash()?>


	<div class="container border rounded-3 d-flex justify-content-center overflow-hidden gx-0 position-relative" style="max-width: 350px;">
	<form id="form-register" action="<?= Constant::BASEURL ?>register/daftar" method="post" class="py-3 px-4 order-3 border-start z-3" style="flex-basis: 100%;" autocomplete="off">
			<h2 class="font-tilana text-shadow text-danger text-center">Register</h2>
			<div class="form-group mt-5 mb-4 position-relative">
				<input type="text" name="username" id="username" class="form-control pt-2 font-poppins focus-ring focus-ring-light" style="padding-right: 38px; font-size: 15px;" required>
				<label for="username" class="position-absolute font-poppins" style="bottom: 8px; left: 12px;">Username</label>
				<i class="fa fa-user position-absolute fs-5" style="right: 13px; bottom: 10px;"></i>
			</div>
			<div class="form-group mb-4 position-relative">
				<input type="text" name="username2" id="username2" class="form-control pt-2 font-poppins focus-ring focus-ring-light" style="padding-right: 38px; font-size: 15px;" required>
				<label for="username2" class="position-absolute font-poppins" style="bottom: 8px; left: 12px;">Nama Lengkap</label>
				<i class="fa fa-user position-absolute fs-5" style="right: 13px; bottom: 10px;"></i>
			</div>
			<div class="form-group mb-4 position-relative">
				<input type="text" name="email" id="email" class="form-control pt-2 font-poppins focus-ring focus-ring-light" style="padding-right: 38px; font-size: 15px;" required>
				<label for="email" class="position-absolute font-poppins" style="bottom: 8px; left: 12px;">Email</label>
				<i class="fa fa-at position-absolute fs-5" style="right: 13px; bottom: 10px;"></i>
			</div>
			<div class="form-group mb-4 position-relative">
				<input type="password" name="password" id="password" class="form-control pt-2 font-poppins focus-ring focus-ring-light" style="padding-right: 38px; font-size: 15px;" required>
				<label for="password" class="position-absolute font-poppins" style="bottom: 8px; left: 12px;">Password</label>
				<i id="icon1" class="fa fa-eye-slash position-absolute fs-5" style="right: 12px; bottom: 10px;"></i>
			</div>
			<div class="form-group mb-4 position-relative">
				<input type="password" name="password2" id="password2" class="form-control pt-2 font-poppins focus-ring focus-ring-light" style="padding-right: 38px; font-size: 15px;" required>
				<label for="password2" class="position-absolute font-poppins" style="bottom: 8px; left: 12px;">Confirm Password</label>
				<i id="icon2" class="fa fa-eye-slash position-absolute fs-5" style="right: 12px; bottom: 10px;"></i>
			</div>
			<button class="btn btn-outline-danger font-poppins mt-1" style="width: 100%;">Register</button>
			<div class="d-flex justify-content-between align-items-center my-3 font-poppins">
				<hr class="border border-black" style="width: 40%;">OR<hr class="border border-black" style="width: 40%;">
			</div>
			<a href="<?= Constant::BASEURL ?>login" id="tombol-register" class="btn btn-outline-primary font-poppins mt-1 mb-2" style="width: 100%;">Login</a>
		</form>
	</div>

	<!-- BOOTSTRAP -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

	<!-- MYSCRIPT -->
	<script>
		const icon = document.querySelector('#icon1')
		const input = document.querySelector('#password')
		const icon2 = document.querySelector('#icon2')
		const input2 = document.querySelector('#password2')

		
		 icon.addEventListener('click', function() {
		  if (input.type === 'password') {
		    input.setAttribute('type','text');
		    icon.classList.add('fa-eye');
		    icon.classList.remove('fa-eye-slash');
		  } else {
		    input.setAttribute('type','password');	
		    icon.classList.add('fa-eye-slash');
		    icon.classList.remove('fa-eye');
		  }

		})
		 icon2.addEventListener('click', function() {
		  if (input2.type === 'password') {
		    input2.setAttribute('type','text');
		    icon2.classList.add('fa-eye');
		    icon2.classList.remove('fa-eye-slash');
		  } else {
		    input2.setAttribute('type','password');	
		    icon2.classList.add('fa-eye-slash');
		    icon2.classList.remove('fa-eye');
		  }

		})
		
	</script>
</body>
</html>