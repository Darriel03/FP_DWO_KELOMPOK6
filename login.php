<?php
session_start();
$username = $_POST['username'];
$password = $_POST['password'];
$username_benar = "admin";
$password_benar = "admin";
if ($username==$username_benar&&$password==$password_benar) {
	echo "<script> 
		    alert('Login Berhasil!');
		    document.location.href = 'index.php';
		  </script>";
}else{
	echo "<script> 
		    alert('Login Gagal!');
		    document.location.href = 'login.html';
		  </script>";
}
?>