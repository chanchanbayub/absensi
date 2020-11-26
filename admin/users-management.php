<?php include "template/header-admin.php" ?>
<?php 

    $nama = $emailSign = $passwordSign = $id_level = "";
    $errors = ["nama" => "", "emailSign" => "", "passwordSign" => "", "id_level" => ""]; 
    if(isset($_POST["addUsers"])) {
        $nama = htmlspecialchars($_POST["nama"]);
        $emailSign = mysqli_real_escape_string($config, $_POST["emailSign"]);
        $passwordSign = htmlspecialchars($_POST["passwordSign"]);
        $id_level = $_POST["id_level"];

        if(empty($nama)) {
            $errors["nama"] = "name not null";
        } 
        if(empty($emailSign)) {
            $errors["emailSign"] = " email not null ";  
        } else 
        if(!filter_var($emailSign, FILTER_VALIDATE_EMAIL)) {
            $errors["emailSign"] = " email not valid ";
        }
        if(empty($passwordSign)) {
            $errors["passwordSign"] = " password not null ";
        }
        if(empty($id_level)) {
            $errors["id_level"] = "level not null";
        }
        if(!array_filter($errors)) {
            if(add ($_POST) > 0 ) {
                echo "berhasil"; 
                header("Location: users-management.php");
                exit;
            } else {
                echo "gagal" . mysqli_error($config);
            }
        }
    }
    $dataPerPage = 5;
    $jumlahData = count(query("SELECT * FROM tb_users"));
    $jumlahHalaman = ceil($jumlahData / $dataPerPage);
    $isActive = (isset($_GET["page"])) ? $_GET["page"] : 1 ; 
    $awalData = ($dataPerPage * $isActive ) - $dataPerPage;

    $users = query("SELECT * FROM tb_users INNER JOIN level ON level.level_id = tb_users.id_level ORDER BY id DESC LIMIT $awalData, $dataPerPage" );

    $level = query("SELECT * FROM level");


?>
        <div class="table-content">
                    <h2 class="section-title">Data Users Management</h2>
                    <div class="btn-add">
                        <a href="#" class="add-kegiatan">Tambah Data Users</a>
                    </div>
                <div class="table">
                    <table>
                        <tr>
                            <th>no</th>
                            <th>Nama</th>
                            <th>email</th>
                            <th>level</th>
                            <th>action</th>
                        </tr>
                        <tr>
                        <?php $no =1; ?>
                        <?php foreach($users as $users) : ?>
                            <td><?= $no++; ?></td>
                            <td><?= $users["nama"] ?></td>
                            <td><?= $users["email"]?></td>
                            <td><?= $users["level_name"] ?></td>
                            <td>
                            <a href="hapus-users.php?id=<?= $users["id"] ?>" onclick = "return confirm('apakah anda yakin ?')" ><i class="fa fa-trash"></i></a>
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
    <!-- modal -->
    <div class="container-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>add users</h2>
            </div>
            <div class="body-modal">
                <form action="" method="POST" autocomplete="off" class="form-modal">
                    <div class="form-group">
                        <label for="nama">Nama Lengkap :</label>
                        <span class="dangers"> <?= $errors["nama"] ?> </span>
                        <input type="text" name="nama" id="nama" class="form-control" value="<?= $nama ?>">
                    </div>
                    <div class="form-group">
                        <label for="emailSign">Email :</label>
                        <span class="dangers"> <?= $errors["emailSign"] ?> </span>
                        <input type="email" name="emailSign" id="emailSign" class="form-control" value ="<?= $emailSign ?>">
                    </div>
                    <div class="form-group">
                        <label for="password">password :</label>
                        <span class="dangers"> <?= $errors["passwordSign"] ?> </span>
                        <input type="password" name="passwordSign" id="passwordSign" class="form-control" value="<?= $passwordSign ?>">
                    </div>
                    <div class="form-group">
                        <label for="id_level">Level :</label>
                        <select name="id_level" id="id_level" class="form-control">
                            <option value=""> Silahkan Pilih</option>
                            <?php foreach ($level as $l) : ?>
                            <option value="<?= $l["level_id"] ?>"><?= $l["level_name"] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="btn-wrapper modal">
                        <button class="new-kegiatan" name="addUsers" type="submit"> add users </button>
                        <button class="close-kegiatan"> batal </button>
                    </div>
                </form>
            </div>
            
<?php include "template/footer.php" ?>