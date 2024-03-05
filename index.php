<?php 

if (empty(session_id())) session_start();


// MEMANGGIL INTI APP WEBSITE
require_once 'app/init.php';

// MENGINSTANCE CLASS APP UNTUK MEMBUAT OBJEK
if (file_exists('app/core/App.php')) {
	$Mywebsite = new App;
}
	
	