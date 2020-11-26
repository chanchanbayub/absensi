<?php include "template/header-admin.php" ?>
<?php 

    $id_users = $_GET["id"];
    if (hapusUsers ($id_users) > 0 ) {
        echo "berhasil";
        header("Location: users-management.php");
        exit;
    } else {
        echo "gagal" .mysqli_error($config);
        // header("Location: users-management.php");
        // exit;
    }

?>
<?php include "template/footer.php" ?>