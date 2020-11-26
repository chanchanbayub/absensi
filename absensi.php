<?php include "template/header.php" ?>

<?php 

    if(isset($_POST["absen"])) {
        if(absenMasuk ($_POST) > 0 ) {
            echo "<div class='getBerhasil'>
            <p>Terimakasih Absen berhasil !</p>
        </div>";
        } else {
            echo "gagal". mysqli_error($config);
        }
    }
    if(isset($_POST["absen_pulang"])) {
        if(absenPulang ($_POST) > 0 ) {
            echo "<div class='getBerhasil'>
            <p>Terimakasih Absen Pulang berhasil !</p>
        </div>";
        } else {
            echo "gagal absen" .mysqli_error($config);
        }
        
    }
    $dataPerPage = 5;
    $jumlahData = count(query("SELECT * FROM absen WHERE users_id = $id"));
    $jumlahHalaman = ceil($jumlahData / $dataPerPage);
    $isActive = (isset($_GET["page"])) ? $_GET["page"] : 1 ; 
    $awalData = ($dataPerPage * $isActive ) - $dataPerPage;
    
    $absens = query("SELECT * FROM absen INNER JOIN tb_users ON tb_users.id = absen.users_id WHERE users_id = $id LIMIT $awalData, $dataPerPage");
    
?>

<div class="jam">
    <h2>Silahkan Absen Terlebih Dahulu</h2>
    <?php date_default_timezone_set("Asia/Jakarta") ?>
    <h2><?= date(" d M Y"); ?> <?= date("H:i"); ?> WIB</h2>
</div>
<div class="table-of-absen">
    <form action="" method="post">
        <input type="hidden" name="users_id" id="users_id" value="<?= $id ?>">
        <input type="hidden" name="jam_masuk" id="jam_masuk" value="<?= date("d M Y H:i:s")  ?>">
        <button class="btn masuk" name ="absen" type ="submit">Masuk</button>
    </form>
</div>
<div class="table">
        <table>
            <tr>
                <th>no</th>
                <th>Nama</th>
                <th>Jam Masuk</th>
                <th>Jam Pulang</th>
            </tr>
            <?php $no = 1; ?>
            <?php if (empty($absens)) : ?>
                <tr>
                    <td colspan ="5">tidak ada data</td>
                </tr>
            <?php endif; ?>
            <?php foreach ($absens as $absens) : ?>
                
              <tr>
              <?php if(empty($absens )) : ?>
                    <td colspan="5"> TIDAK ADA DATA </td>
                <?php endif; ?>
                    <td><?= $no++ ?>.</td>
                    <td><?= $absens["nama"] ?></td>
                    <td><?= $absens["jam_masuk"] ?></td>
                    <?php if(empty($absens["jam_pulang"])) : ?>
                        <form action="" method="post">
                         <input type="hidden" name="absen_id" id="absen_id" value = "<?= $absens["absen_id"] ?>">
                        <input type="hidden" name="users_id" id="users_id" value="<?= $id ?>">
                        <input type="hidden" name="jam_masuk" id="jam_masuk" value="<?= $absens["jam_masuk"] ?>">
                        <input type="hidden" name="jam_pulang" id="jam_pulang" value="<?= date("d M Y H:i:s")  ?>">
                        <td><button class="btn pulang" name ="absen_pulang" type="submit">Pulang</button></td>
                        </form>
                    <?php else: ?>
                        <td><?= $absens["jam_pulang"] ?></td>
                    <?php endif; ?>
                </tr> 
            <?php endforeach; ?>
        </table>
        <div class="pagination">
                <?php if ($isActive > 1) : ?>    
                    <a href="?page=<?= $isActive - 1  ?>" class="page">&laquo</a>
                <?php endif; ?>
                    <?php for($i=1; $i <= $jumlahHalaman; $i++) : ?>
                        <?php if($i == $isActive) : ?>
                            <a class="page" style="background-color:red;" href="?page=<?=$i ?>"><?= $i?></a>
                        <?php else : ?>
                            <a class="page" href="?page=<?=$i ?>"><?= $i?></a>
                        <?php endif; ?>
                        
                    <?php endfor; ?>
                <?php if($isActive < $jumlahHalaman) : ?>
                    <a href="?page=<?= $isActive + 1 ?>" class="page">&raquo</a>
                <?php endif; ?>
    </div>
</div>

<?php include "template/footer.php" ?>