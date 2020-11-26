<?php include "template/header.php" ?>
<?php 

    $jumlahData = query("SELECT * FROM kegiatan WHERE users_id = $id");
    $jumlah = count($jumlahData);
    
    

?>
<div class="card">
    <div class="cardHeader">
        <h2>Jadwal Kegiatan Anda </h2>
        <?php if(empty($jumlah)) : ?>
            <p>tidak ada jadwal kegiataan</p>
        <?php else: ?>
            <p class="data">Jumlah Kegiatan anda : <?= $jumlah ?></p>
            <p class="data">cek selengkapnya di <a href="kegiatan.php">sini</a></p>
        </p>
        <?php endif;?>
    </div>
</div>
    <div class="card">
        <div class="cardHeader">
            <h2>Hello <?= $nama ?></h2>
            <?php date_default_timezone_set('Asia/Jakarta') ?>
            <p>Jam <?php echo date("H:i") ?></p>
        </div>
    </div>
    
        

<?php include "template/footer.php" ?>