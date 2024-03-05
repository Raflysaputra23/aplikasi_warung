<?php 



class Flasher {

	public static function setFlash($title, $pesan, $type) {
		$_SESSION['flash'] = [
			"title" => $title,
			"pesan" => $pesan,
			"type" => $type
		];
	}
	public static function getFlash() {
		if (isset($_SESSION['flash'])) {
			echo '<script>
			const Toast = Swal.mixin({
			  toast: true,
			  position: "top",
			  showConfirmButton: false,
			  timer: 3000,
			  timerProgressBar: true,
			  didOpen: (toast) => {
			    toast.onmouseenter = Swal.stopTimer;
			    toast.onmouseleave = Swal.resumeTimer;
			  }
			});
			Toast.fire({
			  icon: "'.$_SESSION['flash']['type'].'",
			  title: "'.$_SESSION['flash']['title'].', '.$_SESSION['flash']['pesan'].'",
			});
			</script>';
		}
		unset($_SESSION['flash']);
	}
}