<?php 
include('../../koneksi/koneksi.php');

// $no_inv = $_GET['no_inv'];
$hari_ini = date('Y-m-d');

?>

<style>
    @media print {
  div {
    break-inside: avoid;
  }
}
</style>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Resi COD NCS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>

</head>
  <body>
  <div class="container  print " >
<?php
$no = 1;
$sqlinvoice = $koneksilama->query("select * from sales where tgl_kirim_fix = '$hari_ini' and pelanggan like 'TF%' group by no_inv");
$jumres =  mysqli_num_rows($sqlinvoice);
while($datainvoice = $sqlinvoice->fetch_assoc()){
    $no_inv = $datainvoice['no_inv'];

    $sqltotal = $koneksilama->query("
    select *,sum(jumlah*satuan) as total from sales where no_inv = '$no_inv'
    ");
    $datatotal1 = $sqltotal->fetch_assoc();
    ?>
    <hr>
<div class="row ">
    <div class="col-1 mt-2">
    <!-- // awal qr -->
    <div class="justify-content-center mb-3 align-middle" id="qrcode<?= $no?>"></div>
    <script>
        // Get a reference to the container element
        var container = document.getElementById("qrcode<?=$no?>");
        
        // Text or data to encode in the QR code
        var qrText = "<?=  $no.". ".$datainvoice['pelanggan']." ".number_format($datatotal1['total'])?>";
        
        // Options for QR code generation (optional)
        var options = {
            text: qrText,
            width: 70,
            height: 70,
        };
        
        // Create the QR code using the library
        var qrCode = new QRCode(container, options);
    </script>

    <!-- // akhir qr -->
    </div>
    <div class="col-4 text-end">
<b>
    <?php 
                $pel = $datainvoice['pelanggan'];

                if(strpos($pel, 'COD') !== false){ ?>
                   <div style="font-size: 25px;"><?= $no; ?>. COD BARANG + ONGKIR</div>
                   <?php
                }else {?>
                   <div style="font-size: 25px;"><?= $no; ?>. PAKET TRANSFER</div>
                <?php
                }


                ?>
                </b>
                </div>
                <div class="col-7">
        <div class="mb-0" style="line-height: 1;">
            <div class="card  ">
                <div class="input-group ms-2 mb-2">
                <img  src="https://ciwideyfood.com/gamma2023/image/logo%20cf%20baru.jpg" width="50" alt=""></a>
                <h2 class="text-center ms-3 mt-1">CV Ciwidey Food </h2><br>
                Perum Puri Indah Ciwidey  Blok Puri Ayu No. 30 Desa Pasirjambu kec Pasirjambu<br>
                Kab. Bandung 085159759006<br>
            </div>
            </div>
            </div>
            </div>
            <div class="row m-0">
                <div class="col-6">
                <b style="font-size: 20px;">Penerima : <?= $datainvoice['pelanggan']; ?></b><br>
                <b >Alamat :</b> <?= $datainvoice['alamat']; ?><br>
                <p><b>No Hp :</b> 0<?= $datainvoice['no_hp']; ?><br>

                    
                    <!-- <b>No Resi : </b><?php
                    $pelanggan =  $datainvoice['no_resi']; 
                    $sql_resi = $koneksilama->query("
                    select * from tb_resi_pos where penerima like '%$pelanggan%'
                    "); 
                    $data_resi = $sql_resi->fetch_assoc();
                    echo $data_resi['kode'];
                    ?> -->
                </div>
                <?php if(!empty($datainvoice['no_hp'])) {?>
            <div class="col-6">
            <b>No Invoice :</b> <?= $no_inv; ?><br>
                    <b>Tgl Invoice :</b> <?= $datainvoice['tgl_kirim']; ?><br>
                <b>Keterangan :</b> <?= $datainvoice['keterangan']; ?></p>
            </div>
        </div>
        <?php } ?>
        <div class="input-group">
            <div class="col-11">
            <div class=" text-center bg-warning align-middle " >
                <b><p>Total = Rp. <?php 
                $total = $koneksilama->query("
                select *,sum(jumlah*satuan) as total from sales where no_inv = '$no_inv'
                ");
                $datatotal = $total->fetch_assoc();
                echo number_format($datatotal['total'],2);
                ?></p></b>
            </div>
            </div>
            <div class="ms-1 ">
                  <?= $jumres ?>
            </div>
        </div>
       
   
       
        </div>










<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>


<?php 
$no++;
} 
?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>