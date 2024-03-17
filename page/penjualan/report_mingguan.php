<?php
   $tgl_awal = $_POST['awal'];
   $tgl_akhir = $_POST['akhir'];
?>
    <title>Report Mingguan</title>
<div class="container">
<h3>LAPORAN MINGGUAN PENJUALAN <br>
    CV CIWIDEY FOOD <?= $tgl_awal." s/d ".$tgl_akhir ?>
</h3>
    <form action="" method="post" class="d-print-none">
        Tanggal Awal<input type="date" name="awal" value="<?= date("Y-m-d"); ?>">
        Tanggal Akhir<input type="date" name="akhir" value="<?= date("Y-m-d"); ?>">
        <input type="submit" name="submit" value="Lihat">

    </form>
    <!-- <a href="https://ciwideyfood.com/gamma2023/export/export_penjualan_mingguan.php" class="btn text-start btn-sm btn-outline-primary mb-1 d-print-none">download Report</a> -->

    <?php



    if(isset($_POST['submit'])){
        $tgl_awal = $_POST['awal'];
        $tgl_akhir = $_POST['akhir'];
    }
    ?>

<table class="table table-sm table-striped mt-2" bordered="1" >  
                <tr>  
                    <th>No</th>
                    <th>Produk</th>
                    <th>Distributor</th>
                    <th>Reseller</th>
                    <th>Ecer</th>
                    <th>Tiktok</th>
                    <th>Shopee</th>
                    <th class="text-center">Total</th>          
                </tr>

    <?php  
$no = 1;
$total_db = [];
$total_res = [];
$total_ecer = [];
$total_tiktok = [];
$total_shopee = [];
$total_semua = [];

$total_db_jumlah = [];
$total_res_jumlah = [];
$total_ecer_jumlah = [];
$total_tiktok_jumlah = [];
$total_shopee_jumlah = [];
$total_semua_jumlah = [];

    $sql = $koneksilama->query("select * from sales where approve ='Y' and produk not like 'Z%' and produk not like '%ngkir%'
    and waktu_fix between '$tgl_awal' and '$tgl_akhir'
    group by produk order by produk asc");
  while($row = $sql->fetch_assoc()) {
  $produk = $row["produk"];

  $sql_db = $koneksilama->query("select *, sum(jumlah*satuan) as jum_db, sum(jumlah) as jum from sales where 
  j_harga = 'distributor' and 
  produk = '$produk' and 
  approve ='Y' and 
  produk not like 'Z%' and waktu_fix between '$tgl_awal' and '$tgl_akhir'
  group by j_harga");
  $data_db = $sql_db->fetch_assoc();

  $sql_res = $koneksilama->query("select *, sum(jumlah*satuan) as jum_res, sum(jumlah) as jum from sales where 
  j_harga = 'reseller' and 
  produk = '$produk' and 
  approve ='Y' and 
  produk not like 'Z%'  and waktu_fix between '$tgl_awal' and '$tgl_akhir'
  group by j_harga");
  $data_res = $sql_res->fetch_assoc();

  $sql_ecer = $koneksilama->query("select *, sum(jumlah*satuan) as jum_ecer, sum(jumlah) as jum from sales where 
  j_harga = 'ecer' and 
  produk = '$produk' and 
  approve ='Y' and 
  produk not like 'Z%'  and waktu_fix between '$tgl_awal' and '$tgl_akhir'
  group by j_harga");
  $data_ecer = $sql_ecer->fetch_assoc();

  $sql_tiktok = $koneksilama->query("select *, sum(jumlah*satuan) as jum_tiktok, sum(jumlah) as jum from sales where 
  pelanggan like '%tiktok%' and 
  produk = '$produk' and 
  approve ='Y' and 
  produk not like 'Z%'  and waktu_fix between '$tgl_awal' and '$tgl_akhir'
  group by j_harga");
  $data_tiktok = $sql_tiktok->fetch_assoc();

  $sql_shopee = $koneksilama->query("select *, sum(jumlah*satuan) as jum_shopee, sum(jumlah) as jum from sales where 
  pelanggan like '%shopee%' and 
  produk = '$produk' and 
  approve ='Y' and 
  produk not like 'Z%'  and waktu_fix between '$tgl_awal' and '$tgl_akhir'
  group by j_harga");
  $data_shopee = $sql_shopee->fetch_assoc();



?>
    <tr>  
       
            <td><?= $no ?></td> 
            <td><?= $row["produk"]?></td> 
            <td><?= $data_db['jum']." => ".number_format($data_db["jum_db"])?></td> 
            <td><?= $data_res['jum']." => ".number_format($data_res["jum_res"])?></td> 
            <td><?= $data_ecer['jum']." => ".number_format($data_ecer["jum_ecer"])?></td>    
            <td><?= $data_tiktok['jum']." => ".number_format($data_tiktok["jum_tiktok"])?></td>    
            <td><?= $data_shopee['jum']." => ".number_format($data_shopee["jum_shopee"])?></td>    
            <td><?= $data_db['jum']+$data_res["jum"]+$data_ecer["jum"]+$data_tiktok["jum"]+$data_shopee["jum"]." => ".number_format($data_db["jum_db"]+$data_res["jum_res"]+$data_ecer["jum_ecer"]+$data_tiktok["jum_tiktok"]+$data_shopee["jum_shopee"])?></td> 
    
    </tr>

    <?php 
    array_push($total_db,$data_db["jum_db"]);
    array_push($total_res,$data_res["jum_res"]);
    array_push($total_ecer,$data_ecer["jum_ecer"]);
    array_push($total_tiktok,$data_tiktok["jum_tiktok"]);
    array_push($total_shopee,$data_shopee["jum_shopee"]);
    array_push($total_semua,$data_db["jum_db"]+$data_res["jum_res"]+$data_ecer["jum_ecer"]+$data_tiktok["jum_tiktok"]+$data_shopee["jum_shopee"]);

    array_push($total_db_jumlah,$data_db["jum"]);
    array_push($total_res_jumlah,$data_res["jum"]);
    array_push($total_ecer_jumlah,$data_ecer["jum"]);
    array_push($total_tiktok_jumlah,$data_tiktok["jum"]);
    array_push($total_shopee_jumlah,$data_shopee["jum"]);
    array_push($total_semua_jumlah,$data_db["jum"]+$data_res["jum"]+$data_ecer["jum"]+$data_tiktok["jum"]+$data_shopee["jum"]);

    $no++ ;
} ?>

<tr>  
                    <th colspan="2">TOTAL</th>
                    <th><?= number_format(array_sum($total_db_jumlah)). "=> ".number_format(array_sum($total_db)) ?></th>
                    <th><?= number_format(array_sum($total_res_jumlah)). "=> ".number_format(array_sum($total_res)) ?></th>
                    <th><?= number_format(array_sum($total_ecer_jumlah)). "=> ".number_format(array_sum($total_ecer)) ?></th>
                    <th><?= number_format(array_sum($total_tiktok_jumlah)). "=> ".number_format(array_sum($total_tiktok)) ?></th>
                    <th><?= number_format(array_sum($total_shopee_jumlah)). "=> ".number_format(array_sum($total_shopee)) ?></th>
                    <th><?= number_format(array_sum($total_semua_jumlah)). "=> ".number_format(array_sum($total_semua)) ?></th>

                                </tr>

                                </div>