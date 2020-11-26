<?php include "template/header.php" ?>
<?php 
    
    $id = $_GET["id"];
    

    if( delete ($id) > 0) {
        echo "berhasil";
        header("Location: kegiatan.php");
        exit;
    } else {
        echo "data gagal dihapus". mysqli_error($config);
        // header("Location: kegiatan.php");
        // exit;
    }

?>
<?php include "template/footer.php" ?>