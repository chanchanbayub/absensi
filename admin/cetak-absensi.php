<?php

require_once __DIR__ . '/../vendor/autoload.php';
include "../function.php";
$absensi = query("SELECT * FROM absen INNER JOIN tb_users ON tb_users.id = absen.users_id");

$mpdf = new \Mpdf\Mpdf();
$html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Daftar Absensi </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/app.css">
</head>
<body>
<h2 class="section-title">Daftar Absen</h2>
<hr>
<div class="table">
<table>
    <tr>
        <th>no</th>
        <th>nama</th>
        <th>Jam Masuk</th>
        <th>Jam Pulang</th>
    </tr>';
    
    $i = 1;
    foreach($absensi as $absens) {
        $html .= '<tr>
            <td>'.$i++ .'</td>
            <td>'. $absens["nama"].'</td>
            <td>'. $absens["jam_masuk"].'</td>
            <td>'. $absens["jam_pulang"].'</td>
        </tr>';
    }

$html .= '</table>
  </div>
</body>
</html>';

$mpdf->WriteHTML($html);
$mpdf->Output("absensi.pdf",\Mpdf\Output\Destination::INLINE);

?>