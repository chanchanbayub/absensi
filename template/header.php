<?php 
    include "function.php";
    session_start();
    $nama = $_SESSION["nama"];
    $email = $_SESSION["email"];
    $password = $_SESSION['password'];
    $id = $_SESSION["id"];

    if(!isset($_SESSION["nama"] )) {
        header("Location: index.php");
        exit;
    }
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pegawai</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/app.css">
</head>
<body>
    <nav>
        <div class="logo">
            <h2>aplikasi absensi</h2>
        </div>
        <ul class="menu">
            <li><?= $nama  ?></li>
        </ul>
        <div class="burger">
            <div class="satu"></div>
            <div class="dua"></div>
            <div class="tiga"></div>
        </div>
    </nav>
    <div class="content">
        <ul class="sidemenu">
            <li><a href="home.php">Dashboard</a></li>
            <li><a href="profil.php">Profil</a></li>
            <li><a href="kegiatan.php">kegiatan</a></li>
            <li><a href="absensi.php">Absensi</a></li>
            <li><a href="logout.php" onclick= "return confirm('apakah anda yakin ?');" id="sign-up">sign out</a></li>
        </ul>
        <div class="container">
            <div class="body-content">



