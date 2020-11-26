<?php include "template/header-admin.php" ?>
<?php 

    $jabatan_name = "";
    $errors = ["jabatan_name" => ""];
    if(isset($_POST["jabatanAdd"])) {
        $jabatan_name = $_POST["jabatan_name"];

        if(empty($jabatan_name)) {
            $errors["jabatan_name"] = "jabatan not null";
        }
        if(!array_filter($errors)) {
            if( addJabatan ($_POST) > 0) {
                echo "berhasil";
                header("Location: jabatan.php");
                exit;
            } else {
                echo "gagal";
            }
        }
    }

    $dataPerPage = 5;
    $jumlahData = count(query("SELECT * FROM jabatan"));
    $jumlahHalaman = ceil($jumlahData / $dataPerPage);
    $isActive = (isset($_GET["page"])) ? $_GET["page"] : 1 ; 
    $awalData = ($dataPerPage * $isActive ) - $dataPerPage;

    $jabatan = query("SELECT * FROM jabatan ORDER BY id DESC LIMIT $awalData, $dataPerPage");


?>
<div class="table-content">
<h2 class="section-title">Data Jabatan</h2>
                    <div class="btn-add">
                        <a href="#" class="add-kegiatan">Tambah Jabatan</a>
                    </div>
                <div class="table">
                    <table>
                        <tr>
                            <th>no</th>
                            <th>Jabatan</th>
                            <th>action</th>
                        </tr>
                        <?php $no = 1; ?>
                        <?php foreach ($jabatan as $job) : ?>
                        <tr>
                            <td><?= $no++; ?>.</td>
                            <td><?= $job["jabatan_name"] ?></td>
                            <td><a href="hapus-jabatan.php?id=<?= $job["id"] ?>" onclick = "return confirm('apakah anda yakin ?')" ><i class="fa fa-trash"></i></a></td>
                        <?php endforeach; ?>    
                        </tr>
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
    <div class="container-modal ">
        <div class="modal-content">
            <div class="modal-header">
                <h2>add Jabatan</h2>
            </div>
            <div class="body-modal">
                <form action="" method="POST" autocomplete="off" class="form-modal">
                    <div class="form-group">
                        <label for="jabatan_name">Jabatan :</label>
                        <span class="dangers"><?= $errors["jabatan_name"] ?></span>
                        <input type="text" name="jabatan_name" id="jabatan_name" class="form-control" value="<?= $jabatan_name ?>">
                    </div>
                    <div class="btn-wrapper modal">
                        <button class="new-kegiatan" name="jabatanAdd" type="submit"> add kegiatan </button>
                        <button class="close-kegiatan"> batal </button>
                    </div>
                </form>
            </div>
<?php include "template/footer.php" ?>