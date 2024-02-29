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
                <th>id pelanggan</th>
                <th>nama pelanggan</th>
                <th>no telepon</th>
                <th>alamat</th>
                <th>total pembayaran</th>
                <th>aksi</th>
</tr>
</thead>
<tbody>
    <?php
    include '../koneksi.php';
    $no = 1;
    $data = mysqli_query($koneksi,"SELECT * FROM pelanggan INNER JOIN penjualan ON pelanggan.pelanggan_id=penjualan.pelanggan_id");
    while($d = mysqli_fetch_array($data)){
        ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $d['pelanggan_id'];?></td>
            <td><?php echo $d['nama_pelanggan'];?></td>
            <td><?php echo $d['nomor_telepon'];?></td>
            <td><?php echo $d['alamat'];?></td>
            <td>Rp. <?php echo $d['total_harga'];?></td>
    <td>
        <a class="btn btn-info btn-sm" href="detail_pembelian.php?pelanggan_id=<?php echo $d['pelanggan_id']; ?>">detail</a>
        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit-data<?php echo $d['pelanggan_id']; ?>">
        edit
    </button>
    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapus-data<?php echo $d['pelanggan_id']; ?>">
    hapus
    </button>
    </td>
    </tr>


    <!-- modal edit data-->
    <div class="modal fade" id="edit-data<?php echo $d['pelanggan_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">edit data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
    </div>
    <form action="proses_update_pembelian.php" method="post">
        <div class="modal-body">
            <div class="form-group">
                <input type="text" name="pelanggan_id" value="<?php echo $d['pelanggan_id'];?>" class="form-control" hidden>
                
    </div>
    <div class="form-group">
        <label>nama pelanggan</label>
        <input type="text" name="nama_pelanggan" value="<?php echo $d['nama_pelanggan'];?>" class="form-control" >
    </div>
    <div class="form-group">
        <label>nomor telepon</label>
        <input type="number" name="nomor_telepon" value="<?php  echo $d['nomor_telepon'];?>" class="form-control" >
    </div>
    <div class="form-group">
        <label>alamat</label>
        <input type="text" name="alamat" value="<?php  echo $d['alamat'];?>" class="form-control" >
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">keluar</button>
        <button type="submit" class="btn btn-primary">simpan</button>
    </div>
    </form>
    </div>
    </div>
    </div>

    <!--modal hapus data-->
    <div class="modal fade" id="hapus-data<?php echo $d['pelanggan_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hiddien="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel" >hapus data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close" ></button>
    </div>
    <form method="post" action="proses_hapus_barang">
        <div class="modal-body">
            <input type="hidden" name="produk_id" value="<?php echo $d['pelanggan_id'];?>">
            apakah anda yakin akan menghapus data <b><?php echo $d['nama_pelanggan'];?></b>
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
    <form action="proses_pembelian.php" method="post">
        <div class="modal-body">
            <div class="form-group">
                <label>id pelanggan</label>
                <input type="text" name="pelanggan_id"  value="<?php echo date("dmHis")?>" class="form-control" readonly>
    </div>
    <div class="form-group">
                <label>nama pelanggan</label>
                <input type="text" name="harga" class="form-control">
    </div>
    <div class="form-group">
                <label>no telepon</label>
                <input type="text" name="nomor_telepon" class="form-control">
    </div>
    <div class="form-group">
        <label>alamat</label>
       <input type="text" name="alamat" class="form-control">
        <input type="hidden" name="tanggal_penjualan" value="<?php echo date("Y-m-d") ?>" class="form-control">
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


    