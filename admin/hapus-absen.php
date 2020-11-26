<?php include "template/header-admin.php" ?>
<?php 

    $id = $_GET["id"];
    if( hapusAbsen($id) > 0 ) {
        echo header("Location: absensi.php");
        exit;
        
        } else {
            echo "<div class='getBerhasil'>
            <p>Terimakasih Absen Pulang berhasil !</p>
        </div>";
        }
    


?>