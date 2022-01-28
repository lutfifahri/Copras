<?php
session_start();
ob_start();
include "koneksi.php";
if(isset($_GET['aksi'])) {
	unset($_SESSION['id_pengguna']);
	unset($_SESSION['nama_admin']);
	unset($_SESSION['jabatan']);
	session_destroy();
	header('location:index.php');
	echo"<script> window.location.href='index.php';</script>";
	exit();
} else {
	$username = $_POST['username'];
	$pass = $_POST['password'];
	$login=mysqli_query($koneksi,"SELECT * FROM pengguna WHERE username='".$username."' AND password='".$pass."'");
	$ketemu=mysqli_num_rows($login);
	// Apabila username dan password ditemukan
	if ($ketemu > 0) {
		$r=mysqli_fetch_array($login);
		$_SESSION['id_pengguna']= $r['id_pengguna'];
		$_SESSION['nama_admin']= $r['nama'];
		$_SESSION['jabatan']= $r['hak_akses'];
		header('location:home.php');
	} else {
		$_SESSION['success']= 0;
		$_SESSION['message']= 'Username atau password salah';
		header('location:index.php');
	}
}
