<?php include "template/header-admin.php" ?>
    <?php 
        $id = $_GET["id"];

        if( hapusJabatan ($id) > 0) {
            echo "berhasil";
            header("Location: jabatan.php");
            exit;
        } else {
            echo "gagal";
            
        }
    
    ?>
<?php include "template/footer.php" ?>