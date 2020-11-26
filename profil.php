<?php include "template/header.php" ?>
<?php 
    $users_id = $id_jk = $id_jabatan = $photo = "";
    $errors = ["id_jk" => "", "id_jabatan" => "", "photo" => ""];
    if(isset($_POST["send"])) {

        $users_id = $_POST["users_id"];
        $id_jk = $_POST["id_jk"];
        $id_jabatan = $_POST["id_jabatan"];
        $photo = $_FILES["photo"];
        
        if(empty($id_jk)) {
            $errors["id_jk"] = "jenis kelamin not null";
        } 
        if(empty($id_jabatan)) {
            $errors["id_jabatan"] = "jabatan not null";
        }
        if(empty($photo)) {
            $errors["photo"] = "photo not null";
        }
        if(!array_filter($errors)) {
            if(addProfil ($_POST) > 0) {
                echo "<div class='getBerhasil'>
                <p>data berhasil ditambahkan!</p>
            </div>";
            } else {
                echo "gagal";
            }
        }
        
    }

    // get jenis_kelamin
    $jenis_kelamin = query("SELECT * FROM jenis_kelamin");
    // get Jabatan
    $jabatan = query("SELECT * FROM jabatan");
    
    // get Profil
    $result = mysqli_query( $config, "SELECT * FROM pekerja 
                                      INNER JOIN jenis_kelamin ON jenis_kelamin.id = pekerja.id_jk
                                      INNER JOIN jabatan ON jabatan.id = pekerja.id_jabatan
                                        WHERE users_id = $id ");
    $petugas = mysqli_fetch_assoc($result);


    

?>

<h2 class="section-title">Profil Data Diri</h2>
    <form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="img">
        <?php if (empty($petugas["photo"])) : ?>
            <label for="photo"><img src="assets/image/nophoto.jpg" alt="" class="rounded"></label>
            <span class="dangers"> <?= $errors["photo"] ?></span>
            <input type="file" name="photo" id="photo" class="form-control">
        <?php else: ?>
            <img src="assets/image/<?= $petugas["photo"] ?>" alt="" class="rounded">
            <span class="dangers"> <?= $errors["photo"] ?></span>
            <input type="file" name="photo" id="photo" class="form-control" disabled>
        <?php endif; ?>
            
        </div>
        <div class="input">
           <label for="nama">Nama :</label>
           <input type="hidden" name="users_id" id="users_id" class="form-control" value="<?= $id?>" >
           <input type="text" name="nama" id="nama" class="form-control" value="<?= $nama ?>" disabled>
           <label for="email">email :</label>
           <input type="email" name="email" id="email" class="form-control" value="<?= $email ?>" disabled>
           <label for="password">password :</label>
           <input type="password" name="password" id="password" class="form-control" value = "<?= $password ?>" disabled>
           <label for="id_jk">jenis kelamin :</label>
           <span class="dangers"> <?= $errors["id_jk"] ?></span>
           <!-- jenis kelamin -->
           <?php if(empty($petugas["id_jk"])) : ?>
           <select name="id_jk" id="id_jk" class="form-control" >
           <option value="">Silahkan Pilih</option>
                <?php foreach ($jenis_kelamin as $jenis_kelamin) : ?>
                    <option value="<?= $jenis_kelamin["id"] ?>"><?=$jenis_kelamin["jk_name"] ?></option>
                <?php endforeach; ?>
            </select>
            <?php else : ?>
                <select name="id_jk" id="id_jk" class="form-control" disabled>
                    <option value="<?= $petugas["id_jk"] ?>"><?=$petugas["jk_name"] ?></option>
                </select>
            <?php endif; ?>
            <!-- end jenis kelamin -->
            <label for="id_jabatan">Jabatan :</label>
            <span class="dangers"> <?= $errors["id_jabatan"] ?></span>
            <!-- jabatan -->
            <?php if(empty($petugas["id_jabatan"])) : ?>
            <select name="id_jabatan" id="id_jabatan" class="form-control" >
                <option value="">Silahkan Pilih</option>
                <?php foreach ($jabatan as $jabatan) : ?>
                    <option value="<?= $jabatan["id"] ?>"><?=$jabatan["jabatan_name"] ?></option>
                <?php endforeach;?>
                </select>
            <?php else : ?>
                <select name="id_jabatan" id="id_jabatan" class="form-control" disabled>
                    <option value="<?= $petugas["id_jabatan"] ?>"><?=$petugas["jabatan_name"] ?></option>
                </select>
            <?php endif; ?>    
            <div class="btn-wrapper">
            <?php if(empty($petugas)) : ?>
                <button class="send" name="send" type="submit" >Kirim</button>
            <?php else: ?>
                <button class="send" name="send" type="submit" style="cursor:not-allowed">Kirim</button>
            <?php endif; ?>    
            </div>
        </div>
</form>
<?php include "template/footer.php" ?>