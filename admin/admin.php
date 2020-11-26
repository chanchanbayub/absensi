<?php include "template/header-admin.php" ?>
<?php 

    $kegiatan = query("SELECT * FROM kegiatan");
    $jumlah = count($kegiatan);

    $jabatan = query("SELECT * FROM jabatan");
    $jumlahJabatan = count($jabatan);

    $users = query("SELECT * FROM tb_users");
    $jumlahUsers = count($users);

?>
<div class="card">
    <div class="cardHeader">
        <h2>Jumlah Kegiatan</h2>
           <p>jumlah semua kegiatan  adalah : <b><?= $jumlah ?></b> </p>
           <p>cek selengkapnya di <a href="kegiatan-admin.php">disini</a></p>
    </div>
    </div>
<div class="card">
    <div class="cardHeader">
        <h2>Jumlah Jabatan </h2>
        <p>jumlah semua jabatan adalah : <b><?= $jumlahJabatan ?></b> </p>
        <p>cek selengkapnya di <a href="jabatan.php">disini</a></p>
    </div>
</div>
<div class="card">
    <div class="cardHeader">
        <h2>Jumlah Users</h2>
        <p>jumlah semua users adalah : <b><?= $jumlahUsers ?></b> </p>
        <p>cek selengkapnya di <a href="users-management.php">disini</a></p>
    </div>
</div>
<?php include "template/footer.php" ?>