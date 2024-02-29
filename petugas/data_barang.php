<?php
include "header.php";
include "navbar.php";
?>

<div class="card mt-2">
    <div class="card-body">
        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tambah-data">
            Tambah Data
</button>
</div>
<div class="card-body">
    <?php
    if(isset($_GET['pesan'])){
        if($_GET['pesan']=="simpan"){?>
        <div class="alert alert-success" role="alert">
            data berhasil di simplexml_load_string
        </div>
    <?php }?>
    <?php if($_GET['pesan']=="update"){?>
    <div class="alert alert-success" role="alert">
        data berhasil di update
    </div>
<?php }?>
<?php if($_GET['pesan']=="hapus"){?>
<div class="alert alert-success" role="alert">
    data berhasil di hapus
</div>
<?php }?>
<?php 
    }
    ?>

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produkk</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Aksi</th>
</tr>
</thead>
<tbody>
    <?php
    include '../koneksi.php';
    $no = 1;
    $data = mysqli_query($koneksi,"select * from produk");
    while($d = mysqli_fetch_array($data)){
        ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $d['nama_produk'];?></td>
            <td>Rp. <?php echo $d['harga'];?></td>
            <td><?php echo $d['stok'];?></td>
    <td>
        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit-data<?php echo $d['produk_id']; ?>">
        edit
    </button>
    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapus-data<?php echo $d['produk_id']; ?>">
    hapus
    </button>
    </td>
    </tr>

    <!-- modal edit data-->
    <div class="modal fade" id="edit-data<?php echo $d['produk_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">edit data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
    </div>
    <form action="proses_update_barang.php" method="post">
        <div class="modal-body">
            <div class="form-group">

                <label>Nama Produk</label>
                <input type="hidden" name="produk_id" value="<?php echo $d['produk_id'];?> ">
                <input type="text" name="nama_produk" class="form-control" value="<?php echo $d['nama_produk'];?>">
    </div>
    <div class="form-group">
        <label>Harga Produk</label>
        <input type="number" name="harga" class="form-control" value="<?php echo $d['harga'];?>">
    </div>
    <div class="form-group">
        <label>Stok Produk</label>
        <input type="number" name="stok" class="form-control" value="<?php  echo $d['stok'];?>">
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">close</button>
        <button type="submit" class="btn btn-primary">update</button>
    </div>
    </form>
    </div>
    </div>
    </div>

    <!--modal hapus data-->
   <div class="modal fade" id="hapus-data<?php echo $d['produk_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">hapus data</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="close"></button>
    </div>
    <form method="post" action="proses_hapus_barang.php">
        <div class="modal-body">
            <input type="hidden" name="produk_id" value="<?php echo $d['produk_id'];?>">
            apakah anda yakin akan menghapus data <b><?php echo $d['nama_produk'];?></b>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">close</button>
        <button type="submit" class="btn btn-primary">hapus</button>
    </div>
    </form>
    </div>
    </div>
    </div>
    <?php } ?>
    </tbody>
    </table>
    </div>
    </div> 

    <!-- modal tambah data-->
    <div class="modal fade" id="tambah-data" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel" >tambah data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
    </div>
    <form action="proses_simpan_barang.php" method="post">
        <div class="modal-body">
            <div class="form-group">
                <label>nama produk</label>
                <input type="text" name="nama_produk" class="form-control">
    </div>
    <div class="form-group">
                <label>harga produk</label>
                <input type="number" name="harga" class="form-control">
    </div>
    <div class="form-group">
                <label>stok produk</label>
                <input type="number" name="stok" class="form-control">
    </div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" >keluar</button>
        <button type="submit" class="btn btn-primary">simpan</button>
    </div>
    </form>
    </div>
    </div>
    </div>
    <?php
    include "footer.php";
    ?>

    