<?php include "template/header.php" ?>
<?php 
    
    $id = $_SESSION["id"];
    $namaKegiatan = $tgl_kegiatan = $jam = "";
    $errors = ["namaKegiatan" => "", "tgl_kegiatan"=> "", "jam"=>""];
    if(isset($_POST["add-kegiatan"])) {
        $users_id = $_POST["users_id"];
        $namaKegiatan = htmlspecialchars($_POST["kegiatan"]);
        $tgl_kegiatan = htmlspecialchars($_POST["tgl_kegiatan"]);
        $jam = htmlspecialchars( $_POST["jam"] );

        if(empty($namaKegiatan)) {
            $errors["namaKegiatan"] = "Name Kegiatan Tidak boleh Kosong";
        }
        if(empty($tgl_kegiatan)) {
            $errors["tgl_kegiatan"] = "tanggal kegiatan tidak boleh kosong";
        }
        if(empty($jam)) {
            $errors["jam"] = "jam tidak boleh kosong";
        }
        if(!array_filter($errors)) {
            if(addKegiatan ($_POST) > 0) {
                echo "<div class='getBerhasil'>
                        <p>data berhasil ditambahkan!</p>
                    </div>";
                    
            } else {
                echo "gagal" . mysqli_error($config);
            }
        }
        
    }
    $kegiatan = query("SELECT * FROM kegiatan WHERE users_id = $id ORDER BY kegiatan_id DESC ");
    // var_dump($kegiatan); die;

?>
<div class="table-content">
    <h2 class="section-title">Daftar Kegiatan</h2>
        <div class="btn-add">
            <a href="#" class="add-kegiatan"><i class="fa fa-plus-circle" aria-hidden="true"></i>Tambah Kegiatan</a>
        </div>
    <div class="table">
        <table>
        <?php if(isset($berhasil)) : ?>
        <div class="getBerhasil">
            <p>data berhasil ditambahkan!</p>
        </div>
        <?php endif; ?>
            <tr>
                <th>no</th>
                <th>Nama Kegiatan</th>
                <th>tgl Pelaksanaan</th>
                <th>jam Pelaksanaan</th>
                <th>action</th>
                </tr>
            <?php $no = 1;  ?> 
            <?php if (empty($kegiatan)) : ?>
                <tr>
                    <td colspan ="5">tidak ada jadwal kegiatan</td>
                </tr>
            <?php  else: ?>
                <?php foreach ($kegiatan as $kegiatan) : ?>
                <tr>
                    <td><?= $no++; ?>.</td>
                    <td><?= $kegiatan["kegiatan"] ?></td>
                    <td><?= $kegiatan["tgl_kegiatan"] ?></td>
                    <td><?= $kegiatan["jam"] ?></td>
                    <td><a href="hapus.php?id=<?= $kegiatan["kegiatan_id"] ?>" onclick = "return confirm('apakah anda yakin ?')" ><i class="fa fa-trash"></i></a>
                        <a href="edit.php?id=<?= $kegiatan["kegiatan_id"] ?>"><i class="fa fa-pencil-square" aria-hidden="true"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>    
            <?php endif; ?>  
        </table>
    </div>
</div>
        </div>
    </div>
    <!-- modal add kegiatan -->
    <div class="container-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>add kegiatan</h2>
            </div>
            <div class="body-modal">
                <form action="" method="POST" autocomplete="off" class="form-modal">
                    <div class="form-group">
                        <input type="hidden" name="users_id" class="form-control" value="<?= $id ?>">
                        <label for="kegiatan">Nama Kegiatan :</label>
                        <span class="dangers"> <?= $errors["namaKegiatan"] ?></span>
                        <input type="text" name="kegiatan" id="kegiatan" class="form-control" value="<?= $namaKegiatan ?>">
                     </div>
                    <div class="form-group">
                        <label for="tgl_kegiatan">Tanggal Pelaksanaan :</label>
                        <span class="dangers"> <?= $errors["tgl_kegiatan"] ?></span>
                        <input type="date" name="tgl_kegiatan" id="tgl_kegiatan" class="form-control" value="<?= $tgl_kegiatan ?>">
                    </div>
                    <div class="form-group">
                        <label for="jam">Jam Pelaksanaan :</label>
                        <span class="dangers"> <?= $errors["jam"] ?></span>
                        <input type="time" name="jam" id="jam" class="form-control" value="<?= $jam ?>">
                    </div>
                    <div class="btn-wrapper modal">
                        <button class="new-kegiatan" name="add-kegiatan" type="submit"> add kegiatan </button>
                        <button class="close-kegiatan"> batal </button>
                    </div>
                </form>
            </div>
<?php include "template/footer.php" ?>