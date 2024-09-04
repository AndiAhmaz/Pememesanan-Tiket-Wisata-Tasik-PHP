<?php 
include('koneksi.php');

$id_rute = $_POST['id_rute'];
$nama_bus = $_POST['nama_bus'];
$jenis_rute = $_POST['jenis_rute'];
$stok_tiket = $_POST['stok_tiket'];
$harga_tiket = $_POST['harga_tiket'];
$nama_file = $_FILES['gambar']['name'];
$source = $_FILES['gambar']['tmp_name'];
$folder = './upload/';

move_uploaded_file($source, $folder.$nama_file);
$edit = mysqli_query($koneksi, "UPDATE tiket_onlybus SET nama_bus='$nama_bus', jenis_rute='$jenis_rute', stok_tiket='$stok_tiket', harga_tiket='$harga_tiket', gambar='$nama_file' WHERE id_rute='$id_rute' ");

if($edit)
	header('location: daftar_tiket.php');
else
	echo "Edit Menu Gagal";


 ?>