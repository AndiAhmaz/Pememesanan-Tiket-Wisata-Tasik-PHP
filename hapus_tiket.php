<?php 

include('koneksi.php');

$id_rute = $_GET['id_rute'];

$hapus= mysqli_query($koneksi, "DELETE FROM tiket_onlybus WHERE id_rute='$id_rute'");

if($hapus)
	header('location: daftar_tiket.php');
else
	echo "Hapus data gagal";

 ?>