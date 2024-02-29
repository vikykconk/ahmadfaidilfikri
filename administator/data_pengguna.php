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
                <th>Nama petugas</th>
                <th>username</th>
                <th>akses petugas</th>
                <th>aksi</th>
            </tr>
    </thead>
<tbody>
    <?php
    include '../koneksi.php';
    $no = 1;
    $data = mysqli_query($koneksi,"select * from petugas");
    while($d = mysqli_fetch_array($data)){
        ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $d['nama_petugas'];?></td>
            <td><?php echo $d['username'];?></td>
    <td>

    <?php 
    if ($d['level'] == '1') {?>
    administator
<?php } else { ?>
    petugas
    <?php } ?>
</td>
<td>

        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit-data<?php echo $d['id_petugas']; ?>">
        edit
    </button>
    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapus-data<?php echo $d['id_petugas']; ?>">
    hapus
    </button>
    </td>
    </tr>

    <!-- modal edit data-->
    <div class="modal fade" id="edit-data<?php echo $d['id_petugas']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">edit data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
    </div>
    <form action="proses_update_petugas.php" method="post">
        <div class="modal-body">             
            <div class="form-group">

                <label>Nama petugas</label>
                <input type="hidden" name="id_petugas" value="<?php echo $d['id_petugas'];?> ">
                <input type="text" name="nama_petugas" class="form-control" value="<?php echo $d['nama_petugas'];?>">
    </div>
    <div class="form-group">
        <label>username</label>
        <input type="text" name="username" class="form-control" value="<?php echo $d['username'];?>">
    </div>
    <div class="form-group">
        <label>password</label>
        <input type="number" name="password" class="form-control">
        <small class="text-danger text-sm"> * kosongkan kalau tidak merubah password</small>
    </div>
<div class="form-group">
    <label>akses petugas</label>
    <select name="level" class="form-control">
        <option>---pilih akses---</option>
        <option value="1" <?php if ($d['level']== '1') {echo "selected";} ?>>administator</option>
        <option value="2" <?php if ($d['level']== '2') {echo "selected";} ?>>petugas</option>
    </select>
    </div>
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
   <div class="modal fade" id="hapus-data<?php echo $d['id_petugas']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">hapus data</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="close"></button>
    </div>
    <form method="post" action="proses_hapus_petugas.php">
        <div class="modal-body">
            <input type="hidden" name="id_petugas" value="<?php echo $d['id_petugas'];?>">
            apakah anda yakin akan menghapus data <b><?php echo $d['nama_petugas'];?></b>
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
    <form action="proses_simpan_petugas.php" method="post">
        <div class="modal-body">
            <div class="form-group">
                <label>nama petugas</label>
                <input type="text" name="nama_petugas" class="form-control">
    </div>
    <div class="form-group">
                <label>username</label>
                <input type="text" name="username" class="form-control">
    </div>
    <div class="form-group">
                <label>password</label>
                <input type="text" name="password" class="form-control">
    </div>
    <div class="form-group">
        <label>akses petugas</label>
        <select name="lavel" class="form-control">
            <option>---akses petugas---</option>
            <option value="1">administator</option>
            <option value="2">petugas</option>
    </select>
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

    