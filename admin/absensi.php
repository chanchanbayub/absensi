<?php include "template/header-admin.php" ?>
<?php 

    $dataPerPage = 5;
    $jumlahData = count(query("SELECT * FROM absen"));
    $jumlahHalaman = ceil($jumlahData / $dataPerPage);
    $isActive = (isset($_GET["page"])) ? $_GET["page"] : 1 ; 
    $awalData = ($dataPerPage * $isActive ) - $dataPerPage;

    $absensi = query("SELECT * FROM absen 
                       INNER JOIN tb_users ON tb_users.id = absen.users_id ORDER BY absen_id DESC LIMIT $awalData, $dataPerPage                                       
                     ");
    

?>
<div class="table-content">
                    <h2 class="section-title">Daftar Absen</h2>
                    <div class="btn-add">
                        <a href="cetak-absensi.php" target = "_blank" class="cetak"> cetak data </a>
                    </div>
                <div class="table">
                    <table>
                        <tr>
                            <th>no</th>
                            <th>nama</th>
                            <th>Jam Masuk</th>
                            <th>Jam Pulang</th>
                            <th>hapus</th>
                        </tr>
                        
                        <tr>
                            <?php if(empty($absensi)) : ?>
                                <td colspan ="5">Tidak ada data</td>
                            <?php endif; ?>
                        <?php $no = 1; ?>
                        <?php foreach ( $absensi as $absen ) : ?> 
                            <td><?= $no++; ?>.</td>
                            <td><?= $absen["nama"] ?></td>
                            <td><?= $absen["jam_masuk"] ?></td>
                            <td><?= $absen["jam_pulang"] ?></td>
                            <td>
                            <a href="hapus-absen.php?id=<?= $absen["absen_id"] ?>" onclick = "return confirm('apakah anda yakin ?')" ><i class="fa fa-trash"></i></a>
                            </td>
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
                        <label for="users_id">Pilih Users</label>
                        <select name="users_id" id="users_id" class="form-control">
                            <option value=""> Silahkan Pilih</option>
                            <?php foreach($kegiatan as $users) : ?>
                            <option value="<?= $users["users_id"] ?>"><?= $users["nama"] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="kegiatan">Nama Kegiatan :</label>
                        <input type="text" name="kegiatan" id="kegiatan" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="tgl_kegiatan">TGL Kegiatan :</label>
                        <input type="date" name="tgl_kegiatan" id="tgl_kegiatan" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="jam">Jam Pelaksanaan :</label>
                        <input type="time" name="jam" id="jam" class="form-control">
                    </div>
                    <div class="btn-wrapper modal">
                        <button class="new-kegiatan" name="add" type="submit"> add kegiatan </button>
                        <button class="close-kegiatan"> batal </button>
                    </div>
                </form>
            </div>
<?php include "template/footer.php" ?>