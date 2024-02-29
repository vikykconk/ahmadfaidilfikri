<?php
 include '../koneksi.php';

 $pelanggan_id = $_POST['pelanggan_id'];
 $penjualan_id = $_POST['penjualan_id'];

 mysqli_query($koneksi, "insert into detail_penjualan values('','$penjualan_id','','','')");

 header("location:detail_pembelian.php?pelanggan_id=$pelanggan_id");
 ?>