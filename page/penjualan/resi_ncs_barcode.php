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
    <title>Resi Pagi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.6/dist/JsBarcode.all.min.js"></script>

</head>
  <body class="card">
  <div class="container  print " >
  <form action="" method="post" class="d-print-none">
            <input type="date" name="tgl" value="<?=$hari_ini?>">
            <input type="submit" name="pilih" value="Pilih Tanggal Fix"  class="btn btn-sm btn-primary">
        </form>
<?php
$no = 1;
$sqlinvoice = $koneksilama->query("select * from sales where tgl_kirim_fix = '$hari_ini'  and gudang = 'y1' group by no_inv order by kurir,pelanggan asc");
if(isset($_POST['pilih'])){
    $tgl = $_POST['tgl'];
$sqlinvoice = $koneksilama->query("select * from sales where tgl_kirim_fix = '$tgl'  and gudang = 'y1' group by no_inv  order by kurir,pelanggan asc");
}
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
    <div class="col-7 ">
    <!-- // awal qr -->
    <svg  width="100" height="100" id="barcode<?= $no?>"></svg> 


    <div class="justify-content-center align-middle" id="qrcode<?= $no?>"></div>
    <script>
        // Get a reference to the container element
        var container = document.getElementById("qrcode<?=$no?>");
        
        // Text or data to encode in the QR code
        var qrText = "<?=  $no.". ".explode(" -",$datainvoice['pelanggan'])[0]?>";
        
        JsBarcode("#barcode<?=$no?>", qrText, {
        // format: "pharmacode",
        // lineColor: "#0aa",
        width: 1,
        height: 50,
        displayValue: true
        });

       
    </script>

    <!-- // akhir qr -->
    </div>
    
    <div class="col-4">
        <div class="mb-0" style="line-height: 1;">
            <div class="  ">
                <div class="input-group text-end ms-2 ">
                    <!-- <img  src="https://ciwideyfood.com/gamma2023/image/logo%20cf%20baru.jpg" width="50" alt=""></a> -->
                    <b>CV Ciwidey Food</b><br>
                    Perum Puri Indah Ciwidey  Blok Puri Ayu No. 30 Desa Pasirjambu kec Pasirjambu<br>
                    Kab. Bandung 085159759006<br>
                </div>
            </div>
        </div>
    </div>

        </div>

            <div style="font-size: 15px;" class="row m-0" >
                <div class="col-6" style="line-height: 1;">
                <b style="font-size: 15px;">Penerima : <?= $datainvoice['pelanggan']; ?></b><br>
                <b >Alamat :</b> <?= $datainvoice['alamat']; ?><br>
                <p><b>No Hp :</b> 0<?= $datainvoice['no_hp']; ?><br>
<b>
    <?php 
                $pel = $datainvoice['pelanggan'];

                if(strpos($pel, 'COD') !== false){ ?>
                   <div style="font-size: 20px;"><?= $no; ?>. COD BARANG + ONGKIR</div>
                   <?php
                }else {?>
                   <div style="font-size: 20px;"><?= $no; ?>. PAKET TRANSFER</div>
                <?php
                }


                ?>
                </b>
                    
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
            <div class="col-6 " style="line-height: 1;">
            <b>No Invoice :</b> <?= $no_inv; ?><br>
                    <b>Tgl Invoice :</b> <?= $datainvoice['tgl_kirim']; ?><br>
                <b>Keterangan :</b> <?= $datainvoice['keterangan']; ?><br>
                <b>Produk : </b>(Berat = 
                <!-- total berat -->
                <?php 
                $total_berat = [];
                 $sql_berat = $koneksilama->query("
                    select * from sales where no_inv = '$no_inv' and produk != ' Ongkir'
                    "); 
                    while($data_berat = $sql_berat->fetch_assoc()){
                    array_push($total_berat,$data_berat['berat']);
                    }
                    $hasil_berat= array_sum($total_berat);
                    echo $hasil_berat+100;
                ?>
                <!-- total berat -->
                 gram) <br>
<!-- list produk -->
                <?php 
                    $no_produk = 1;
                $sql_produk = $koneksilama->query("
                    select * from sales where no_inv = '$no_inv' and produk != ' Ongkir'
                    "); 
                    while($data_produk = $sql_produk->fetch_assoc()){
                        echo $no_produk++.". ";
                    echo $data_produk['produk'];
                    echo " (".$data_produk['jumlah'].')<br>';
                    }
                ?>
<!-- list produk -->
                </p>
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
       
   
       










<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>


<?php 
$no++;
} 
?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>