<?php 

    $config = mysqli_connect("localhost", "root", "", "absensi") or die;

    function add($data) {
        global $config;
        $nama = htmlspecialchars($data["nama"]);
        $emailSign = mysqli_real_escape_string($config, htmlspecialchars($data["emailSign"]));
        $passwordSign = htmlspecialchars($data["passwordSign"]);
        $id_level = $data["id_level"];
        $passwordSign = password_hash($passwordSign, PASSWORD_DEFAULT);

        $result = mysqli_query($config, "SELECT * FROM tb_users WHERE email = '$emailSign' ");
        if (mysqli_num_rows($result) == 1) {
            return false;
        }

        $query = "INSERT INTO  tb_users (nama, email, password, id_level)
                  VALUES ('$nama', '$emailSign', '$passwordSign', '$id_level')
                 ";
        mysqli_query($config, $query);

        return mysqli_affected_rows($config);
    }

    function hapusUsers($id) {
        global $config;

        $result = mysqli_query($config, "SELECT * FROM pekerja INNER JOIN tb_users ON tb_users.id = pekerja.users_id WHERE users_id = $id");

        $data = mysqli_fetch_assoc($result);
        $users = $data["photo"];
      
 
        $query = "DELETE FROM tb_users WHERE id = $id";

        mysqli_query($config, $query);
        unlink("../assets/image/".$users);

        return mysqli_affected_rows($config);
    }

    function login($data) {
        global $config;
        $email = mysqli_real_escape_string($config, htmlspecialchars($_POST["email"]));
        $password = htmlspecialchars($_POST["password"]);

        $result = mysqli_query($config, "SELECT * FROM tb_users WHERE email = '$email'");

        if(mysqli_num_rows($result) == 1 ) {
            $row = mysqli_fetch_assoc($result);
            if(password_verify($password, $row["password"])) {
                if($row["id_level"] == 2) {
                    session_start();
                    $_SESSION["email"] = $row["email"];
                    $_SESSION["nama"] = $row["nama"];
                    $_SESSION["id"] = $row["id"];
                    $_SESSION["password"] = $row["password"];
                    header("Location: home.php");
                    exit;
                } else if($row["id_level"] == 1) {
                    session_start();
                    $_SESSION["nama"] = $row["nama"];
                    $_SESSION["email"] = $row["email"];
                    $_SESSION["id"] = $row["id"];
                    $_SESSION["password"] = $row["password"];
                    header("Location: admin/admin.php");
                    exit;
                }
            } 
        }
    }

    function addKegiatan($data) {
        global $config;
        $users_id = htmlspecialchars($data["users_id"]);
        $namaKegiatan = htmlspecialchars($data["kegiatan"]);
        $tgl_kegiatan = htmlspecialchars($data["tgl_kegiatan"]);
        $jam = htmlspecialchars($data["jam"]);

        $query = "INSERT INTO kegiatan (users_id, kegiatan, tgl_kegiatan, jam)
                    VALUES 
                  ('$users_id', '$namaKegiatan','$tgl_kegiatan', '$jam')
                 ";

        mysqli_query($config, $query);         

        return mysqli_affected_rows($config);
    }

    function query($query) {
        global $config;
        $result = mysqli_query($config, $query);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }

        return $rows;
    }

    function delete($id) {
        global $config;

        $query = "DELETE FROM kegiatan WHERE kegiatan_id = $id";

        mysqli_query($config, $query);

        return mysqli_affected_rows($config);
    }

    function updateKegiatan($data) {
        global $config;
        $id = $data["kegiatan_id"];
        $users_id = htmlspecialchars($data["users_id"]);
        $nameKegiatan = htmlspecialchars($data["kegiatan"]);
        $tgl_kegiatan = htmlspecialchars($data["tgl_kegiatan"]);
        $jam = htmlspecialchars($data["jam"]);

        $query = "UPDATE kegiatan SET users_id = $users_id, kegiatan = '$nameKegiatan', tgl_kegiatan = '$tgl_kegiatan', jam = '$jam' WHERE kegiatan_id = $id";

        mysqli_query($config, $query);

        return mysqli_affected_rows($config);
    }

    function addProfil($data) {
        global $config;
        $users_id = $data["users_id"];
        $id_jk = $data["id_jk"];
        $id_jabatan = $data["id_jabatan"];
        $photo = upload();
        
        if( !$photo ) {
            // echo $errors["photo"] = "silahkan upload photo";
            return false;
        }

        $query = "INSERT INTO pekerja (users_id, id_jk, id_jabatan, photo)
                    VALUES 
                  ('$users_id','$id_jk','$id_jabatan', '$photo')  
                 ";
        mysqli_query($config, $query);

        return mysqli_affected_rows($config);
    }

    function upload() {
        $namaFile = $_FILES["photo"]["name"];
        $sizeFile = $_FILES["photo"]["size"];
        $tmpName = $_FILES["photo"]["tmp_name"];
        $error = $_FILES["photo"]["error"];
        

        if($error === 4) {
            echo $errors["photo"] = "silahkan upload terlebih dahulu";
            return false;
        }
        
        $fileValid = ['jpg', 'jpeg','png'];
        $extensiValid = explode(".", $namaFile);
        $extensiValid = strtolower(end($extensiValid) );
        
        if(!in_array($extensiValid, $fileValid)) {
            echo "yang anda upload bukan gambar";
            return false;
        }

        if($sizeFile > 1000000) {
            echo "ukuran file terlalu besar";
            return false;
        }

        $namaFileBaru = uniqid();
        $namaFileBaru .= ".";
        $namaFileBaru .= $extensiValid;

        // move_uploaded_file($tmpName, 'assets/image/'. $namaFileBaru );
        if(!move_uploaded_file($tmpName, 'assets/image/'. $namaFileBaru)) {
            move_uploaded_file($tmpName, '../assets/image/'. $namaFileBaru);
        }
         
        return $namaFileBaru;
    }

    function addJabatan($data) {
        global $config;

        $jabatan_name = htmlspecialchars($data["jabatan_name"]);

        $query = "INSERT INTO jabatan (jabatan_name)
                    VALUES
                    ('$jabatan_name');
                ";
        mysqli_query($config, $query);
        
        return mysqli_affected_rows($config);
    }

    function hapusJabatan($id) {
        global $config;

        $query = "DELETE FROM jabatan WHERE id =$id ";
        mysqli_query($config, $query);

        return mysqli_affected_rows($config);
    }

    function absenMasuk($data) {
        global $config;
        $users_id = $data["users_id"];
        $jam_masuk = $data["jam_masuk"];

        $query = "INSERT INTO absen (users_id, jam_masuk)
                    VALUES 
                    ('$users_id', '$jam_masuk')
                 ";
        mysqli_query($config, $query);
        
        return mysqli_affected_rows($config);
    }
    function absenPulang($data) {
        global $config;
        $absen_id = $data["absen_id"];
        $users_id = $data["users_id"];
        $jam_masuk = $data["jam_masuk"];
        $jam_pulang = $data["jam_pulang"];

        $query = "UPDATE absen SET users_id = '$users_id', jam_masuk = '$jam_masuk', jam_pulang = '$jam_pulang' WHERE absen_id = $absen_id;
                                    ";
        mysqli_query($config, $query);
        
        return mysqli_affected_rows($config);
    }

    function hapusAbsen($id) {
        global $config;
        $query = "DELETE FROM absen WHERE absen_id = $id";

        mysqli_query($config, $query);

        return mysqli_affected_rows($config);
    }
?>