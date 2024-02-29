<?php
include '../koneksi.php';

$pelanggan_id = $_POST['pelanggan_id'];

mysqli_query($koneksi,"delete from pelanggan where pelanggan_id='$pelanggan_id'");
mysqli_query($koneksi,"delete from penjualan where pelanggan_id='$pelanggan_id'");

header("location:pembelian.php?pesan=hapus");
?>