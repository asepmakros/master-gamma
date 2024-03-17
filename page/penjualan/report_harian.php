<?php
   $tgl_awal = $_POST['awal'];
   $tgl_akhir = $_POST['akhir'];
?>
    <title>Report Harian</title>
<?php 
if(isset($_POST['submit'])){
    $judul = "LAPORAN HARIAN PENJUALAN";
}
if(isset($_POST['hasil_marketing'])){
    $judul = "LAPORAN HARIAN HASIL MARKETING";
}
?>
<h3 class="text-center"><?= $judul ?><br>
    CV CIWIDEY FOOD <?= $tgl_awal ?>
</h3>
    <div class="card bg-secondary">
        <div class="ms-2 mt-2 mb-2 input-group">
    <a href="https://ciwideyfood.com/gamma2023/export/export_penjualan.php" class=" btn btn-success btn-sm d-print-none me-2" >Download Penjualan Lengkap</a>

    <form action="" method="post" class="d-print-none">
        Tanggal : <input type="date" name="awal" value="<?= date("Y-m-d"); ?>">
        <!-- Tanggal Akhir<input type="date" name="akhir" value="<?= date("Y-m-d"); ?>"> -->
        <input type="submit" class="btn btn-sm btn-primary" name="submit" value="Lihat Penjualan">
        <input type="submit" class="btn btn-sm btn-danger" name="hasil_marketing" value="Lihat Hasil Marketing Harian">
</div>
    </div>

    </form>
    <!-- <a href="https://ciwideyfood.com/gamma2023/export/export_penjualan_mingguan.php" class="btn text-start btn-sm btn-outline-primary mb-1 d-print-none">download Report</a> -->

    <?php
    if(isset($_POST['submit'])){
        $tgl_awal = $_POST['awal'];
        $tgl_akhir = $_POST['akhir'];
    
    ?>

<table class="table table-sm table-striped mt-2" bordered="1" >  
                <tr>  
                    <th>No</th>
                    <th>Produk</th>
                    <th>DB</th>
                    <th>RES</th>
                    <th>Ecer</th>
                    <th>TIK</th>
                    <th>SHO</th>
                    <th>TKP</th>
                    <th>MAR</th>
                    <th>Ganti Rugi</th>

                    <th class="text-center">Total</th>          
                </tr>

    <?php  
$no = 1;
$total_db = [];
$total_res = [];
$total_ecer = [];
$total_tiktok = [];
$total_shopee = [];
$total_tokped = [];
$total_marketing = [];
$total_gantirugi = [];
$total_semua = [];

    $sql = $koneksilama->query("select * from sales where approve ='Y' and produk not like 'Z%' and produk not like '%ngkir%' and produk != 'DISKON'
    and tgl_kirim_fix = '$tgl_awal'
    group by produk order by produk asc");

  while($row = $sql->fetch_assoc()) {
  $produk = $row["produk"];
  $pelanggan = $row["pelanggan"];


  $sql_db = $koneksilama->query("select *, sum(jumlah) as jum_db from sales where 
  j_harga = 'distributor' and 
  pelanggan not like '%gantirugi%' and
  pelanggan not like '%marketing%' and
  produk = '$produk' and 
  approve ='Y' and 
  produk not like 'Z%' and tgl_kirim_fix = '$tgl_awal'
  group by j_harga");
  $data_db = $sql_db->fetch_assoc();

  $sql_res = $koneksilama->query("select *, sum(jumlah) as jum_res from sales where 
  j_harga = 'reseller' and 
  produk = '$produk' and 
  approve ='Y' and 
  produk not like 'Z%'  and tgl_kirim_fix = '$tgl_awal'
  group by j_harga");
  $data_res = $sql_res->fetch_assoc();

  $sql_ecer = $koneksilama->query("select *, sum(jumlah) as jum_ecer from sales where 
  j_harga = 'ecer' and 
  produk = '$produk' and 
  approve ='Y' and 
  produk not like 'Z%'  and tgl_kirim_fix = '$tgl_awal'
  group by j_harga");
  $data_ecer = $sql_ecer->fetch_assoc();

  $sql_tiktok = $koneksilama->query("select *, sum(jumlah) as jum_tiktok from sales where 
  pelanggan like '%tiktok%' and 
  produk = '$produk' and 
  approve ='Y' and 
  produk not like 'Z%'  and tgl_kirim_fix = '$tgl_awal'
  group by j_harga");
  $data_tiktok = $sql_tiktok->fetch_assoc();

  $sql_shopee = $koneksilama->query("select *, sum(jumlah) as jum_shopee from sales where 
  pelanggan like '%shopee%' and 
  produk = '$produk' and 
  approve ='Y' and 
  produk not like 'Z%'  and tgl_kirim_fix = '$tgl_awal'
  group by j_harga"); 
  $data_shopee = $sql_shopee->fetch_assoc();

  $sql_tokped = $koneksilama->query("select *, sum(jumlah) as jum_tokped from sales where 
  pelanggan like '%tokped%' and 
  produk = '$produk' and 
  approve ='Y' and 
  produk not like 'Z%'  and tgl_kirim_fix = '$tgl_awal'
  group by j_harga"); 
  $data_tokped = $sql_tokped->fetch_assoc();

  $sql_marketing = $koneksilama->query("select *, sum(jumlah) as jum_marketing from sales where 
  
  pelanggan like '%marketing%' and
  produk = '$produk' and 
  approve ='Y' and 
  produk not like 'Z%'  and tgl_kirim_fix = '$tgl_awal'
  group by j_harga");
  $data_marketing= $sql_marketing->fetch_assoc();

  $sql_gantirugi = $koneksilama->query("select *, sum(jumlah) as jum_gantirugi from sales where 
  pelanggan like '%gantirugi%' and 
  produk = '$produk' and 
  approve ='Y' and 
  produk not like 'Z%'  and tgl_kirim_fix = '$tgl_awal' 
  group by j_harga");
  $data_gantirugi= $sql_gantirugi->fetch_assoc();


?>
    <tr>  
            <td><?= $no ?></td> 
            <td><?= $row["produk"]?></td> 
            <td><?= number_format($data_db["jum_db"])?></td> 
            <td><?= number_format($data_res["jum_res"])?></td> 
            <td><?= number_format($data_ecer["jum_ecer"])?></td>    
            <td><?= number_format($data_tiktok["jum_tiktok"])?></td>    
            <td><?= number_format($data_shopee["jum_shopee"])?></td>   
            <td><?= number_format($data_tokped["jum_tokped"])?></td>   
            <td class="bg-danger"><?= number_format($data_marketing["jum_marketing"])?></td>    
            <td class="bg-danger"><?= number_format($data_gantirugi["jum_gantirugi"])?></td>     
            <td><?= number_format($data_db["jum_db"]+$data_res["jum_res"]+$data_ecer["jum_ecer"]+$data_tiktok["jum_tiktok"]+$data_shopee["jum_shopee"]+$data_tokped["jum_tokped"]+$data_marketing["jum_marketing"]+$data_gantirugi["jum_gantirugi"])?></td> 
    
    </tr>

    <?php 
    array_push($total_db,$data_db["jum_db"]);
    array_push($total_res,$data_res["jum_res"]);
    array_push($total_ecer,$data_ecer["jum_ecer"]);
    array_push($total_tiktok,$data_tiktok["jum_tiktok"]);
    array_push($total_shopee,$data_shopee["jum_shopee"]);
    array_push($total_tokped,$data_tokped["jum_tokped"]);
    array_push($total_marketing,$data_marketing["jum_marketing"]);
    array_push($total_gantirugi,$data_gantirugi["jum_gantirugi"]);
    array_push($total_semua,$data_db["jum_db"]+$data_res["jum_res"]+$data_ecer["jum_ecer"]+$data_tiktok["jum_tiktok"]+$data_shopee["jum_shopee"]+$data_tokped["jum_tokped"]+$data_marketing["jum_marketing"]+$data_gantirugi["jum_gantirugi"]);

    $no++ ;
} ?>

<tr>  
                    <th colspan="2">TOTAL</th>
                    <th><?= number_format(array_sum($total_db)) ?></th>
                    <th><?= number_format(array_sum($total_res)) ?></th>
                    <th><?= number_format(array_sum($total_ecer)) ?></th>
                    <th><?= number_format(array_sum($total_tiktok)) ?></th>
                    <th><?= number_format(array_sum($total_shopee)) ?></th>
                    <th><?= number_format(array_sum($total_tokped)) ?></th>
                    <th><?= number_format(array_sum($total_marketing)) ?></th>
                    <th><?= number_format(array_sum($total_gantirugi)) ?></th>
                    <th><?= number_format(array_sum($total_semua)) ?></th>

                                </tr>

<!-- ===================AKHIR JUMLAH SAJA ===================== -->


<table class="table table-sm table-striped mt-3" >  
                <tr>  
                    <th>No</th>
                    <th>Produk</th>
                    <th>DB</th>
                    <th>RES</th>
                    <th>Ecer</th>
                    <th>TIK</th>
                    <th>SHO</th>
                    <th>TKP</th>
                    <th class="text-center">Total</th>          
                </tr>

    <?php  
$no = 1;
$total_db = [];
$total_res = [];
$total_ecer = [];
$total_tiktok = [];
$total_shopee = [];
$total_tokped = [];
$total_semua = [];

    $sql = $koneksilama->query("select * from sales where approve ='Y' and produk not like 'Z%' and produk not like '%ngkir%'  and produk != 'DISKON'
    and tgl_kirim_fix = '$tgl_awal'
    group by produk order by produk asc");
  while($row = $sql->fetch_assoc()) {
  $produk = $row["produk"];

  $sql_db = $koneksilama->query("select *, sum(jumlah*satuan) as jum_db from sales where 
  j_harga = 'distributor' and 
  produk = '$produk' and 
  approve ='Y' and 
  produk not like 'Z%' and tgl_kirim_fix = '$tgl_awal'
  group by j_harga");
  $data_db = $sql_db->fetch_assoc();

  $sql_res = $koneksilama->query("select *, sum(jumlah*satuan) as jum_res from sales where 
  j_harga = 'reseller' and 
  produk = '$produk' and 
  approve ='Y' and 
  produk not like 'Z%'  and tgl_kirim_fix = '$tgl_awal'
  group by j_harga");
  $data_res = $sql_res->fetch_assoc();

  $sql_ecer = $koneksilama->query("select *, sum(jumlah*satuan) as jum_ecer from sales where 
  j_harga = 'ecer' and 
  produk = '$produk' and 
  approve ='Y' and 
  produk not like 'Z%'  and tgl_kirim_fix = '$tgl_awal'
  group by j_harga");
  $data_ecer = $sql_ecer->fetch_assoc();

  $sql_tiktok = $koneksilama->query("select *, sum(jumlah*satuan) as jum_tiktok from sales where 
  pelanggan like '%tktok%' and 
  produk = '$produk' and 
  approve ='Y' and 
  produk not like 'Z%'  and tgl_kirim_fix = '$tgl_awal'
  group by j_harga");
  $data_tiktok = $sql_tiktok->fetch_assoc();

  $sql_shopee = $koneksilama->query("select *, sum(jumlah*satuan) as jum_shopee from sales where 
  pelanggan like '%shopee%' and 
  produk = '$produk' and 
  approve ='Y' and 
  produk not like 'Z%'  and tgl_kirim_fix = '$tgl_awal'
  group by j_harga");
  $data_shopee = $sql_shopee->fetch_assoc();

  $sql_tokped = $koneksilama->query("select *, sum(jumlah*satuan) as jum_tokped from sales where 
  pelanggan like '%tokped%' and 
  produk = '$produk' and 
  approve ='Y' and 
  produk not like 'Z%'  and tgl_kirim_fix = '$tgl_awal'
  group by j_harga");
  $data_tokped = $sql_tokped->fetch_assoc();



?>
    <tr>  
            <td><?= $no ?></td> 
            <td><?= $row["produk"]?></td> 
            <td><?= number_format($data_db["jum_db"])?></td> 
            <td><?= number_format($data_res["jum_res"])?></td> 
            <td><?= number_format($data_ecer["jum_ecer"])?></td>    
            <td><?= number_format($data_tiktok["jum_tiktok"])?></td>    
            <td><?= number_format($data_shopee["jum_shopee"])?></td>    
            <td><?= number_format($data_tokped["jum_tokped"])?></td>    
            <td><?= number_format($data_db["jum_db"]+$data_res["jum_res"]+$data_ecer["jum_ecer"]+$data_tiktok["jum_tiktok"]+$data_shopee["jum_shopee"]+$data_tokped["jum_tokped"])?></td> 
    
    </tr>

    <?php 
    array_push($total_db,$data_db["jum_db"]);
    array_push($total_res,$data_res["jum_res"]);
    array_push($total_ecer,$data_ecer["jum_ecer"]);
    array_push($total_tiktok,$data_tiktok["jum_tiktok"]);
    array_push($total_shopee,$data_shopee["jum_shopee"]);
    array_push($total_tokped,$data_tokped["jum_tokped"]);
    array_push($total_semua,$data_db["jum_db"]+$data_res["jum_res"]+$data_ecer["jum_ecer"]+$data_tiktok["jum_tiktok"]+$data_shopee["jum_shopee"]+$data_tokped["jum_tokped"]);

    $no++ ;
} ?>

<tr>  
                    <th colspan="2">TOTAL</th>
                    <th><?= number_format(array_sum($total_db)) ?></th>
                    <th><?= number_format(array_sum($total_res)) ?></th>
                    <th><?= number_format(array_sum($total_ecer)) ?></th>
                    <th><?= number_format(array_sum($total_tiktok)) ?></th>
                    <th><?= number_format(array_sum($total_shopee)) ?></th>
                    <th><?= number_format(array_sum($total_tokped)) ?></th>
                    <th><?= number_format(array_sum($total_semua)) ?></th>

                                </tr>

<?php
    }

      if(isset($_POST['hasil_marketing'])){
        $tgl_awal = $_POST['awal'];
        $tgl_akhir = $_POST['akhir'];
    
    ?>

<table class="table table-sm table-striped mt-2" bordered="1" >  
                <tr>  
                    <th>No</th>
                    <th>Produk</th>
                    <th>DB</th>
                    <th>RES</th>
                    <th>Ecer</th>
                    <th>TIK</th>
                    <th>SHO</th>
                    <th>TKP</th>
                    <th>MAR</th>
                    <th>Ganti Rugi</th>

                    <th class="text-center">Total</th>          
                </tr>

    <?php  
$no = 1;
$total_db = [];
$total_res = [];
$total_ecer = [];
$total_tiktok = [];
$total_shopee = [];
$total_tokped = [];
$total_marketing = [];
$total_gantirugi = [];
$total_semua = [];

    $sql = $koneksilama->query("select * from sales where approve ='Y' and produk not like 'Z%' and produk not like '%ngkir%' and produk != 'DISKON'
    and waktu_fix = '$tgl_awal'
    group by produk order by produk asc");
  while($row = $sql->fetch_assoc()) {
  $produk = $row["produk"];
  $pelanggan = $row["pelanggan"];


  $sql_db = $koneksilama->query("select *, sum(jumlah) as jum_db from sales where 
  j_harga = 'distributor' and 
  pelanggan not like '%gantirugi%' and
  pelanggan not like '%marketing%' and
  produk = '$produk' and 
  approve ='Y' and 
  produk not like 'Z%' and waktu_fix = '$tgl_awal'
  group by j_harga");
  $data_db = $sql_db->fetch_assoc();

  $sql_res = $koneksilama->query("select *, sum(jumlah) as jum_res from sales where 
  j_harga = 'reseller' and 
  produk = '$produk' and 
  approve ='Y' and 
  produk not like 'Z%'  and waktu_fix = '$tgl_awal'
  group by j_harga");
  $data_res = $sql_res->fetch_assoc();

  $sql_ecer = $koneksilama->query("select *, sum(jumlah) as jum_ecer from sales where 
  j_harga = 'ecer' and 
  produk = '$produk' and 
  approve ='Y' and 
  produk not like 'Z%'  and waktu_fix = '$tgl_awal'
  group by j_harga");
  $data_ecer = $sql_ecer->fetch_assoc();

  $sql_tiktok = $koneksilama->query("select *, sum(jumlah) as jum_tiktok from sales where 
  pelanggan like '%tiktok%' and 
  produk = '$produk' and 
  approve ='Y' and 
  produk not like 'Z%'  and waktu_fix = '$tgl_awal'
  group by j_harga");
  $data_tiktok = $sql_tiktok->fetch_assoc();

  $sql_shopee = $koneksilama->query("select *, sum(jumlah) as jum_shopee from sales where 
  pelanggan like '%shopee%' and 
  produk = '$produk' and 
  approve ='Y' and 
  produk not like 'Z%'  and waktu_fix = '$tgl_awal'
  group by j_harga"); 
  $data_shopee = $sql_shopee->fetch_assoc();

  $sql_tokped = $koneksilama->query("select *, sum(jumlah) as jum_tokped from sales where 
  pelanggan like '%tokped%' and 
  produk = '$produk' and 
  approve ='Y' and 
  produk not like 'Z%'  and waktu_fix = '$tgl_awal'
  group by j_harga"); 
  $data_tokped = $sql_tokped->fetch_assoc();

  $sql_marketing = $koneksilama->query("select *, sum(jumlah) as jum_marketing from sales where 
  
  pelanggan like '%marketing%' and
  produk = '$produk' and 
  approve ='Y' and 
  produk not like 'Z%'  and waktu_fix = '$tgl_awal'
  group by j_harga");
  $data_marketing= $sql_marketing->fetch_assoc();

  $sql_gantirugi = $koneksilama->query("select *, sum(jumlah) as jum_gantirugi from sales where 
  pelanggan like '%gantirugi%' and 
  produk = '$produk' and 
  approve ='Y' and 
  produk not like 'Z%'  and waktu_fix = '$tgl_awal'
  group by j_harga");
  $data_gantirugi= $sql_gantirugi->fetch_assoc();


?>
    <tr>  
            <td><?= $no ?></td> 
            <td><?= $row["produk"]?></td> 
            <td><?= number_format($data_db["jum_db"])?></td> 
            <td><?= number_format($data_res["jum_res"])?></td> 
            <td><?= number_format($data_ecer["jum_ecer"])?></td>    
            <td><?= number_format($data_tiktok["jum_tiktok"])?></td>    
            <td><?= number_format($data_shopee["jum_shopee"])?></td>   
            <td><?= number_format($data_tokped["jum_tokped"])?></td>   
            <td><?= number_format($data_marketing["jum_marketing"])?></td>    
            <td><?= number_format($data_gantirugi["jum_gantirugi"])?></td>     
            <td><?= number_format($data_db["jum_db"]+$data_res["jum_res"]+$data_ecer["jum_ecer"]+$data_tiktok["jum_tiktok"]+$data_shopee["jum_shopee"]+$data_marketing["jum_marketing"]+$data_gantirugi["jum_gantirugi"])?></td> 
    
    </tr>

    <?php 
    array_push($total_db,$data_db["jum_db"]);
    array_push($total_res,$data_res["jum_res"]);
    array_push($total_ecer,$data_ecer["jum_ecer"]);
    array_push($total_tiktok,$data_tiktok["jum_tiktok"]);
    array_push($total_shopee,$data_shopee["jum_shopee"]);
    array_push($total_tokped,$data_tokped["jum_tokped"]);
    array_push($total_marketing,$data_marketing["jum_marketing"]);
    array_push($total_gantirugi,$data_gantirugi["jum_gantirugi"]);
    array_push($total_semua,$data_db["jum_db"]+$data_res["jum_res"]+$data_ecer["jum_ecer"]+$data_tiktok["jum_tiktok"]+$data_shopee["jum_shopee"]+$data_marketing["jum_marketing"]+$data_gantirugi["jum_gantirugi"]);

    $no++ ;
} 
?>

<tr>  
                    <th colspan="2">TOTAL</th>
                    <th><?= number_format(array_sum($total_db)) ?></th>
                    <th><?= number_format(array_sum($total_res)) ?></th>
                    <th><?= number_format(array_sum($total_ecer)) ?></th>
                    <th><?= number_format(array_sum($total_tiktok)) ?></th>
                    <th><?= number_format(array_sum($total_shopee)) ?></th>
                    <th><?= number_format(array_sum($total_tokped)) ?></th>
                    <th><?= number_format(array_sum($total_marketing)) ?></th>
                    <th><?= number_format(array_sum($total_gantirugi)) ?></th>
                    <th><?= number_format(array_sum($total_semua)) ?></th>

                                </tr>

<!-- ===================AKHIR JUMLAH SAJA ===================== -->


<table class="table table-sm table-striped mt-3" >  
                <tr>  
                    <th>No</th>
                    <th>Produk</th>
                    <th>DB</th>
                    <th>RES</th>
                    <th>Ecer</th>
                    <th>TIK</th>
                    <th>SHO</th>
                    <th>TKP</th>
                    <th class="text-center">Total</th>          
                </tr>

    <?php  
$no = 1;
$total_db = [];
$total_res = [];
$total_ecer = [];
$total_tiktok = [];
$total_shopee = [];
$total_tokped = [];
$total_semua = [];

    $sql = $koneksilama->query("select * from sales where approve ='Y' and produk not like 'Z%' and produk not like '%ngkir%'
    and waktu_fix = '$tgl_awal'
    group by produk order by produk asc");
  while($row = $sql->fetch_assoc()) {
  $produk = $row["produk"];

  $sql_db = $koneksilama->query("select *, sum(jumlah*satuan) as jum_db from sales where 
  j_harga = 'distributor' and 
  produk = '$produk' and 
  approve ='Y' and 
  produk not like 'Z%' and waktu_fix = '$tgl_awal'
  group by j_harga");
  $data_db = $sql_db->fetch_assoc();

  $sql_res = $koneksilama->query("select *, sum(jumlah*satuan) as jum_res from sales where 
  j_harga = 'reseller' and 
  produk = '$produk' and 
  approve ='Y' and 
  produk not like 'Z%'  and waktu_fix = '$tgl_awal'
  group by j_harga");
  $data_res = $sql_res->fetch_assoc();

  $sql_ecer = $koneksilama->query("select *, sum(jumlah*satuan) as jum_ecer from sales where 
  j_harga = 'ecer' and 
  produk = '$produk' and 
  approve ='Y' and 
  produk not like 'Z%'  and waktu_fix = '$tgl_awal'
  group by j_harga");
  $data_ecer = $sql_ecer->fetch_assoc();

  $sql_tiktok = $koneksilama->query("select *, sum(jumlah*satuan) as jum_tiktok from sales where 
  j_harga = 'tiktok' and 
  produk = '$produk' and 
  approve ='Y' and 
  produk not like 'Z%'  and waktu_fix = '$tgl_awal'
  group by j_harga");
  $data_tiktok = $sql_tiktok->fetch_assoc();

  $sql_shopee = $koneksilama->query("select *, sum(jumlah*satuan) as jum_shopee from sales where 
  j_harga = 'shopee' and 
  produk = '$produk' and 
  approve ='Y' and 
  produk not like 'Z%'  and waktu_fix = '$tgl_awal'
  group by j_harga");
  $data_shopee = $sql_shopee->fetch_assoc();

  $sql_tokped = $koneksilama->query("select *, sum(jumlah*satuan) as jum_tokped from sales where 
  j_harga = 'tokped' and 
  produk = '$produk' and 
  approve ='Y' and 
  produk not like 'Z%'  and waktu_fix = '$tgl_awal'
  group by j_harga");
  $data_tokped = $sql_tokped->fetch_assoc();



?>
    <tr>  
            <td><?= $no ?></td> 
            <td><?= $row["produk"]?></td> 
            <td><?= number_format($data_db["jum_db"])?></td> 
            <td><?= number_format($data_res["jum_res"])?></td> 
            <td><?= number_format($data_ecer["jum_ecer"])?></td>    
            <td><?= number_format($data_tiktok["jum_tiktok"])?></td>    
            <td><?= number_format($data_shopee["jum_shopee"])?></td>    
            <td><?= number_format($data_tokped["jum_tokped"])?></td>    
            <td><?= number_format($data_db["jum_db"]+$data_res["jum_res"]+$data_ecer["jum_ecer"]+$data_tiktok["jum_tiktok"]+$data_shopee["jum_shopee"]+$data_tokped["jum_tokped"])?></td> 
    
    </tr>

    <?php 
    array_push($total_db,$data_db["jum_db"]);
    array_push($total_res,$data_res["jum_res"]);
    array_push($total_ecer,$data_ecer["jum_ecer"]);
    array_push($total_tiktok,$data_tiktok["jum_tiktok"]);
    array_push($total_shopee,$data_shopee["jum_shopee"]);
    array_push($total_tokped,$data_tokped["jum_tokped"]);
    array_push($total_semua,$data_db["jum_db"]+$data_res["jum_res"]+$data_ecer["jum_ecer"]+$data_tiktok["jum_tiktok"]+$data_shopee["jum_shopee"]+$data_tokped["jum_tokped"]);

    $no++ ;
} ?>

<tr>  
                    <th colspan="2">TOTAL</th>
                    <th><?= number_format(array_sum($total_db)) ?></th>
                    <th><?= number_format(array_sum($total_res)) ?></th>
                    <th><?= number_format(array_sum($total_ecer)) ?></th>
                    <th><?= number_format(array_sum($total_tiktok)) ?></th>
                    <th><?= number_format(array_sum($total_shopee)) ?></th>
                    <th><?= number_format(array_sum($total_tokped)) ?></th>
                    <th><?= number_format(array_sum($total_semua)) ?></th>

                                </tr>

<?php
    }

?>

