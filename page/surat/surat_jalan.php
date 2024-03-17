<?php
$id = $_GET['id'];

$sqldata = $koneksilama->query("select * from tb_surat where id = '$id' ");
$data = $sqldata->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Jalan</title>
</head>
<body>


<!-- kop surat -->
<div class="">
        <div class="row me-3 border rounded ">
            <div class="col-3 text-center">
                <img src="https://ciwideyfood.com/gamma2023/page/surat/logo_cf.jpg" style="width: 150px; height:150px" alt="logo cf" class="ms-2 rounded-circle">
            </div>
            <div class="col  mb-3 align-middle">
                <p class="ms-3 mt-2" style="font-size: 12px;"><b class=""><br>CV CIWIDEY FOOD (Food Manufacturing and Distribution) </b><br>
                NIB : 022000069191974 AHU-0030448-AH.01.14 Tahun 2020 <br>
                Perum Puri Indah Ciwidey Blok Puri Ayu No. 30 Kec. Pasirjambu Kab. Bandung <br>
                Instagram : @bandengisiciwidey <br>
                WhatsApp : 08112182201</p>
            </div>
            </div>
        </div>
    <!-- kop surat -->


    <div class="container-md">
       <b> <h5><?= $data['judul'] ?></h5></b>
        <p>Nomor : <?= $data['no_surat'] ?></p>
        <hr>
    </div>




    <div class="container" style="font-size: 12px;">
        Yang bertanda tangan di bawah ini : <br>
        <div class="row">
            <div class="col-2">Nama</div>
            <div class="col">: <?= $data['nama_pengirim'] ?></div>
        </div>
        <div class="row">
            <div class="col-2">Jabatan</div>
            <div class="col">: <?= $data['jabatan_pengirim'] ?></div>
        </div>
            Menugaskan :
        <div class="row">
            <div class="col-2">Instansi</div>
            <div class="col">: <?= $data['instansi_pelaksana'] ?></div>
        </div>
        <div class="row">
            <div class="col-2">Jabatan</div>
            <div class="col">: <?= $data['jabatan_pelaksana'] ?></div>
        </div>
        Untuk Melaksanakan kegiatan Pengiriman Pemesanan Bandeng Presto (BANPRES)
        sebanyak <?= $data['jumlah'] ?> pcs oleh CV.Ciwidey Food pada :
        <div class="row">
            <div class="col-2">Hari/Tanggal</div>
            <div class="col">: <?= $data['waktu_kirim'] ?></div>
        </div>
        <div class="row">
            <div class="col-2">Tujuan</div>
            <div class="col">: <?= $data['tujuan'] ?></div>
        </div>
        <div class="row">
            <div class="col-2">Jumlah Paket</div>
            <div class="col">: <?= $data['jumlah'] ?></div>
        </div>
        <div class="row">
            <div class="col-2">No. PO</div>
            <div class="col">: <?= $data['nomor_po'] ?></div>
        </div>
        <br>
        Demikian surat tugas ini dibuat untuk dilaksanakan.
    </div>

    <div class="container mt-4" style="font-size: 12px;">
        <div class="row">
            <div class="col-4"></div>
            <div class="col-4"></div>
            <div class="col-4 text-center">
                Bandung, <?= $data['waktu_kirim'] ?> <br>
                CV Ciwidey Food <br>
                <br><br><br><br>
                <b><?= $data['nama_pengirim'] ?></b>
            </div>
        </div>
    </div>
</body>
</html>