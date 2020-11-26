<?php include "template/header.php" ?>
<?php 

    $id_kegiatan = $_GET["id"];
    $result = "SELECT * FROM kegiatan WHERE kegiatan_id = $id_kegiatan";
    $data = mysqli_query($config, $result);
    $kegiatan = mysqli_fetch_assoc($data);
    

    $nameKegiatan = $tgl_kegiatan = $jam = "";
    $errors = ["nameKegiatan" => "", "tgl_kegiatan" => "", "jam" => ""];
    if(isset($_POST["update"])) {
        $users_id = htmlspecialchars($_POST["users_id"]);
        $nameKegiatan = htmlspecialchars($_POST["kegiatan"]);
        $tgl_kegiatan = htmlspecialchars($_POST["tgl_kegiatan"]);
        $jam = htmlspecialchars($_POST["jam"]);

        if(empty($nameKegiatan)) {
            $errors["namaKegiatan"] = "kegiatan not null";
        } 
        if(empty($tgl_kegiatan)) {
            $errors["tgl_kegiatan"] = "tanggal kegiatan harus ditentukan";
        }
        if(empty($jam)) {
            $errors["jam"] = "jam kegiatan harus ditentukan";
        }
        if(!array_filter($errors)) {
            if (updateKegiatan ($_POST) > 0 ) {
                
                echo" <div class='getBerhasil'>
                        <p>data berhasil ditambahkan!</p>
                    </div>";
                header("Location: kegiatan.php");
                exit;
                
            } else {
                echo "gagal" .mysqli_error($config);
            }
        }

    }
    

?>

<h2 class="section-title"> Form Edit Kegiatan </h2>
    <form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="input">
        <?php if($kegiatan) : ?> 
           <label for="kegiatan">Nama Kegiatan :</label>
           <span class="danger"><?= $errors["nameKegiatan"] ?></span>
           <input type="hidden" name="kegiatan_id" id="kegiatan_id" class="form-control" value="<?= $id_kegiatan?>" >
           <input type="hidden" name="users_id" id="users_id" class="form-control" value="<?= $id?>" >
           <input type="text" name="kegiatan" id="kegiatan" class="form-control" value="<?= $kegiatan["kegiatan"] ?>" >
           <label for="tgl_kegiatan">TGL Pelaksanaan :</label>
           <span class="danger"><?= $errors["tgl_kegiatan"] ?></span>
           <input type="date" name="tgl_kegiatan" id="tgl_kegiatan" class="form-control" value="<?= $kegiatan["tgl_kegiatan"] ?>" >
           <label for="jam">Jam Pelaksanaan</label>
           <span class="danger"><?= $errors["jam"] ?></span>
           <input type="time" name="jam" id="jam" class="form-control" value = "<?= $kegiatan["jam"] ?>" >
            <div class="btn-wrapper">
                <button class="send" name="update" type="submit">Kirim</button>
                <a href="kegiatan.php" class=" close-kegiatan" >kembali</a>
            </div>
        <?php else: ?>
            <h2>Tidak ada data</h2>
        <?php endif; ?>
           
        </div>
        
</form>        
<?php include "template/footer.php" ?>