<?php 

    include "function.php";

    $nama = $emailSign = $passwordSign = "";
    $errors = ["nama" => "", "emailSign" => "", "passwordSign" => ""];
    if(isset($_POST["sign"])) {
        $nama = htmlspecialchars($_POST["nama"]);
        $emailSign = mysqli_real_escape_string($config, htmlspecialchars($_POST["emailSign"]));
        $passwordSign = htmlspecialchars($_POST["passwordSign"]);

        if(empty($nama)) {
            $errors["nama"] = " name not null "; 
        } 
        if(empty($emailSign)) {
            $errors["emailSign"] = " email not null ";  
        }  
        if(!filter_var($emailSign, FILTER_VALIDATE_EMAIL)) {
            $errors["emailSign"] = " email not valid ";
        }
        if(empty($passwordSign)) {
            $errors["passwordSign"] = " password not null ";
        } 
        if(!array_filter($errors) ){
            if( add ($_POST) > 0)  {
                echo "berhasil";
            } else {
                echo "gagal" . mysqli_error($config);
            }
        }
        
    }

    $email = $password ="";
    $error = ["email" => "", "password" => ""];
    if(isset($_POST["login"])) {
        $email = mysqli_real_escape_string($config, htmlspecialchars($_POST["email"]));
        $password = htmlspecialchars($_POST["password"]);

        if(empty($email)) {
            $error["email"] = " email not null ";  
        } else 
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error["email"] = " email not valid ";
        }
        
        if(empty($password)) {
            $error["password"] = " password not null ";
        } 
        if(!array_filter($error) ){
            if( login ($_POST) > 0)  {
                echo $berhasil;
            } else {
                $errorss = true; 
            }
        }
    }

    // get Level 
    $level = query("SELECT * FROM level WHERE level_id = 2 ");
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Absensi Pegawai</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="container">
        <div class="boxlogin">
        <?php if (isset($errorss)) : ?>
                <div class='getGagal'>
                        <p>Username or Password Salah !!</p>
                    </div>
            <?php endif; ?> 
            <div class="header-login">
                <img src="assets/image/logo.png" alt="" >
            </div>
            <div class="body-login">
            <?php if (isset($berhasil)) : ?>
                <div class='getBerhasil'>
                        <p>berhasil Login</p>
                    </div>
            <?php endif; ?> 
            
                    <form action="" method="post" autocomplete="off">
                        <label for="email">email :</label>
                        <span class="dangers"><?= $error["email"] ?></span>
                        <div class="form-group">
                            <i class="fa fa-envelope-o"></i>
                            <input type="text" name="email" id="email" value="<?= $email ?>" class="form-control">
                            <br>
                        </div>
                        <label for="password">password :</label>
                        <span class="dangers"><?= $error["password"] ?></span>
                        <div class="form-group">
                            <i class="fa fa-key" aria-hidden="true"></i>
                            <input type="password" name="password" id="password" value="<?= $password ?>" class="form-control">
                        </div>
                        <div class="remember">
                            <input type="checkbox" name="remember" id="remember" class="remember-me">
                            <label for="remember">remember me</label>
                        </div>
                        <div class="btn-wrapper">
                            <button class="btn login" name="login" type="submit">Login</button>
                        </div>
                        <div class="sign-up">
                            <p>belum punya akun ? <a href="#" class="show-add">daftar</a> </p>
                        </div>
                    </form>
            </div>
        </div>
    </div>
    <!-- slide-login -->
        <div class="boxsign">
            <div class="header-login">
                <img src="assets/image/logo.png" alt="" >
            </div>
            <div class="body-login">
                    <form action="" method="post" autocomplete="off">
                        <label for="email">nama :</label>
                        <span class="dangers"><?= $errors["nama"] ?></span>
                        <div class="form-group">
                            <i class="fa fa-user-circle"></i>
                            <input type="text" name="nama" id="nama" value="<?= $nama ?>" class="form-control">
                        </div>
                        <label for="emailSign">email :</label>
                        <span class="dangers"><?= $errors["emailSign"] ?></span>
                        <div class="form-group">
                            <i class="fa fa-user-circle"></i>
                            <input type="text" name="emailSign" id="emailSign" value="<?= $emailSign ?>" class="form-control">
                        </div>
                        <label for="passwordSign">password :</label>
                        <span class="dangers"><?= $errors["passwordSign"] ?></span>
                        <div class="form-group">
                            <i class="fa fa-key" aria-hidden="true"></i>
                            <input type="password" name="passwordSign" id="passwordSign" value="<?= $passwordSign ?>" class="form-control">
                        </div>
                        <select name="id_level" id="id_level" hidden>
                        <?php foreach ($level as $level) : ?>
                            <option value="<?= $level["level_id"] ?>"><?= $level["level_name"] ?></option>
                        <?php endforeach; ?>    
                        </select>
                        <div class="btn-wrapper">
                            <button class="btn login" name="sign" type="submit">Sign Up</button>
                        </div>
                        <div class="sign-up">
                            <p>sudah punya akun <a href="#" class="close">masuk</a> </p>
                        </div>
                    </form>
            </div>
        </div>
    <script src="js/app.js"></script>
</body>
</html>