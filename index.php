
<?php 
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
$_SESSION['verifikasi'] = $_GET['veri'];
$kode = ["gudang", "penjualan", "keuangan", "produksi", "dapur", "Gudang", "Penjualan", "Keuangan", "Produksi", "Dapur", "GUDANG", "PENJUALAN", "KEUANGAN", "PRODUKSI", "DAPUR"];

$judul = "CF ".strtoupper($_SESSION['verifikasi']);

if( in_array($_SESSION['verifikasi'] , $kode)){
    ?>
    <div class="container-fluid bg-success text-light d-print-none">
    <div class="container">
    <?php
echo "Verifikasi Berhasil";
 ?>
  </div>
</div>
    <?php
}else{
      ?>
    <div class="container-fluid bg-danger text-light d-print-none">
    <div class="container">
    <?php
    echo "harap masukkan kode verifikasi";
     ?>
  </div>
</div>
    <?php
}
include_once "koneksi/koneksi.php";
$hari_ini = date('Y-m-d');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?= strtoupper($_SESSION['verifikasi'])?> CF Gamma 2023</title>
    <link rel="icon" type="image/x-icon" href="images/gamma.ico">

    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
        
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jqc-1.12.4/dt-1.13.4/b-2.3.6/sl-1.6.2/datatables.min.css"/>
    <link rel="stylesheet" type="text/css" href="Editor-2.1.2/css/editor.dataTables.css">
    
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jqc-1.12.4/dt-1.13.4/b-2.3.6/sl-1.6.2/datatables.min.js"></script>
    <script type="text/javascript" src="Editor-2.1.2/js/dataTables.editor.js"></script>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>





    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1"> -->
     <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>





      <script>
   $(document).ready( function () {
    $('#myTable').DataTable();
} );

$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
      </script>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
  </head>
  <body>
      <div class=" sticky-top    ">
      <!-- <nav  style="background-color:#0275d8;" class="navbar fixed-top  circle-rounded"> -->

        <div class="bg-dark  text-end  gradient-custom opacity-75  d-print-none" >
            <div class="container d-flex justify-content-between">
            <form action="" method="post" class="mt-2">
                <div class="input-group">
                <input type="text" name="verifikasi" placeholder="Kode Verifikasi" class="text-center rounded">
                <input type="submit" name="submit" value="OK" class="btn btn-sm btn-primary">
                </div>
            </form>
            <button class="btn btn-sm text-light me-3 mb-3 mt-2  btn-primary d-print-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions"><?= $judul ?></button>
        </div>
    </div>
        <!-- </nav> -->
        <div class="container d-print-none">
                <?php 
                if(isset($_POST['verifikasi'])){
                    // session_destroy();
                    // session_unset();
                    session_start();
                    $_SESSION['verifikasi']= $_POST['verifikasi'];
                        ?>
        <script type="text/javascript">
            window.location.href="?veri=<?= $_POST['verifikasi']; ?>";
        </script>
        <?php
                }
                ?>
        </div>
        <label for="" class="text-light h4"><?php echo $page ?></label>
      </div>

    <div class="container-fluid ">
    
      
      

      <div class="offcanvas offcanvas-end opacity-75 " data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
        <div class="offcanvas-header">
          <!-- <?php include "svg/svg-sidebar.php" ?> -->
          <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">Main Menu</h5>

          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <?php
        $date = pow(date('H'),3);
        $date1 = date('d')*3;

        $pinn = $date+$date1;
            ?>

        <div class="offcanvas-body bg-dark">
 
        <?php 
        $no = 1;
        ?>

        <?php 
        if($_SESSION['verifikasi']=='gudang'){
        ?>
        <label for="" class="d-grid mb-1 h5 text-light text-center">Gudang</label>
        <div class="alert alert-success">Diisi oleh karyawan Gudang Setiap hari Kerja</div>

            <!-- <a href="?page=gudang" class="btn text-start fw-bold m-1 btn-sm d-grid gap-2 btn-outline-primary mb-1">Packing</a> -->
            <a href="?page=gudang&aksi=rekap&veri=<?= $_SESSION['verifikasi'] ?>" class="btn text-start fw-bold m-1 btn-sm d-grid gap-2 btn-primary mb-1"><?= $no++ ?>. Rekap Stok Harian</a>
            <a href="?page=produk&veri=<?= $_SESSION['verifikasi'] ?>" class="btn text-start fw-bold m-1 btn-sm d-grid gap-2 btn-primary mb-1"><?= $no++ ?>. List Produk</a>
            <a href="?page=kontrol_produksi&veri=<?= $_SESSION['verifikasi'] ?>" class="btn text-start fw-bold m-1 btn-sm d-grid gap-2 btn-primary mb-1"><?= $no++ ?>. Kontrol Stok</a>
            <!-- <a href="?page=produk_keluar" class="btn text-start fw-bold m-1 btn-sm d-grid gap-2 btn-primary mb-1">Produk Keluar</a> -->
            <a href="?page=form&veri=<?= $_SESSION['verifikasi'] ?>" class="btn text-start fw-bold m-1 btn-sm d-grid gap-2 btn-primary mb-1"><?= $no++ ?>. Form Penerimaan</a>
            <a href="?page=stok_keluar&veri=<?= $_SESSION['verifikasi'] ?>" class="btn text-start fw-bold m-1 btn-sm d-grid gap-2 btn-primary mb-1"><?= $no++ ?>. Form Stok Keluar</a>

            <a href="https://ciwideyfood.com/gamma2023/page/penjualan/resi/scan_resi.php" class="btn text-start fw-bold m-1 btn-sm d-grid gap-2 btn-primary mb-1"><?= $no++ ?>. Scan Resi</a>
            <?php } ?>
   <?php 
        if($_SESSION['verifikasi']=='penjualan'){
        ?>
        <label for="" class="d-grid mb-1 h5 text-light text-center">Penjualan</label>
        <a href="?page=penjualan&aksi=fix_kirim_search&veri=<?= $_SESSION['verifikasi'] ?>" class="btn text-start fw-bold m-1 btn-sm d-grid gap-2 btn-primary mb-1"><?= $no++ ?>. Fix Kirim</a>
        <a href="?page=gudang&aksi=rekap&veri=<?= $_SESSION['verifikasi'] ?>" class="btn text-start fw-bold m-1 btn-sm d-grid gap-2 btn-primary mb-1"><?= $no++ ?>. Rekap Stok Harian</a>
        <a href="?page=gudang&aksi=berita_acara&veri=<?= $_SESSION['verifikasi'] ?>" class="btn text-start fw-bold m-1 btn-sm d-grid gap-2 btn-primary mb-1"><?= $no++ ?>. Berita Acara Pengiriman</a>
        <a href="?page=penjualan&aksi=fix_kirim&veri=<?= $_SESSION['verifikasi'] ?>" class="btn text-start fw-bold m-1 btn-sm d-grid gap-2 btn-primary mb-1"><?= $no++ ?>. Data Kiriman</a>
        

        <a href="https://ciwideyfood.com/app/penjualan/index_klip.php" class="btn text-start fw-bold m-1 btn-sm d-grid gap-2 btn-primary mb-1"><?= $no++ ?>. Aplikasi Penjualan</a>
        <a href="?page=penjualan&aksi=report_sales_harian&veri=<?= $_SESSION['verifikasi'] ?>" class="btn text-start fw-bold m-1 btn-sm d-grid gap-2 btn-primary mb-1"><?= $no++ ?>. Report Penjualan Harian</a>
        <a href="?page=penjualan&aksi=report_sales_mingguan&veri=<?= $_SESSION['verifikasi'] ?>" class="btn text-start fw-bold m-1 btn-sm d-grid gap-2 btn-primary mb-1"><?= $no++ ?>. Report Penjualan Mingguan</a>
        <!-- <a href="?page=penjualan&aksi=index_klip&veri=<?= $_SESSION['verifikasi'] ?>" class="btn text-start fw-bold m-1 btn-sm d-grid gap-2 btn-primary mb-1"><?= $no++ ?>. Invoice Maker</a> -->
        <!-- <a href="?page=penjualan&aksi=cek_invoice&veri=<?= $_SESSION['verifikasi'] ?>" class="btn text-start fw-bold m-1 btn-sm d-grid gap-2 btn-primary mb-1"><?= $no++ ?>. Cek Invoice</a> -->
        <!-- <a href="?page=penjualan&aksi=ranking&veri=<?= $_SESSION['verifikasi'] ?>" class="btn text-start fw-bold m-1 btn-sm d-grid gap-2 btn-primary mb-1"><?= $no++ ?>. Ranking</a> -->
        <!-- <a href="?page=penjualan&aksi=lacak_resi&veri=<?= $_SESSION['verifikasi'] ?>" class="btn text-start fw-bold m-1 btn-sm d-grid gap-2 btn-primary mb-1"><?= $no++ ?>. Lacak Resi NCS</a> -->
        <!-- <a href="?page=penjualan&aksi=fix_kirim2&veri=<?= $_SESSION['verifikasi'] ?>" class="btn text-start fw-bold m-1 btn-sm d-grid gap-2 btn-primary mb-1"><?= $no++ ?>. Fix Kirim (Test)</a> -->

    <?php } ?>
   <?php 
        if($_SESSION['verifikasi']=='dapur'){
        ?>
        <label for="" class="d-grid mb-1 h5 text-light text-center">Dapur Solo</label>
            <a href="?page=surat&aksi=daftar_po&veri=<?= $_SESSION['verifikasi'] ?>" class="btn text-start fw-bold m-1 btn-sm d-grid gap-2 btn-primary mb-1"><?= $no++ ?>. Daftar PO</a>
            <a href="?page=surat&veri=<?= $_SESSION['verifikasi'] ?>" class="btn text-start fw-bold m-1 btn-sm d-grid gap-2 btn-primary mb-1"><?= $no++ ?>. Surat Jalan</a>
            <a href="?page=surat&aksi=invoice&veri=<?= $_SESSION['verifikasi'] ?>" class="btn text-start fw-bold m-1 btn-sm d-grid gap-2 btn-primary mb-1"><?= $no++ ?>. Invoice</a>
            <a href="?page=surat&aksi=kwitansi&veri=<?= $_SESSION['verifikasi'] ?>" class="btn text-start fw-bold m-1 btn-sm d-grid gap-2 btn-primary mb-1"><?= $no++ ?>. Kwitansi</a>
            <!-- <a href="?page=surat&aksi=surat" class="btn text-start fw-bold m-1 btn-sm d-grid gap-2 btn-primary mb-1">Surat</a> -->
    <?php } ?>
   <?php 
        if($_SESSION['verifikasi']=='produksi'){
        ?>
        <label for="" class="d-grid mb-1 h5 text-light text-center">Produksi</label>
            <a href="?page=produksi&aksi=bahan&veri=<?= $_SESSION['verifikasi'] ?>" class="btn text-start fw-bold m-1 btn-sm d-grid gap-2 btn-primary mb-1"><?= $no++ ?>. Bahan</a>
            <br>
            <!-- <a href="?page=produksi&aksi=hpp&veri=<?= $_SESSION['verifikasi'] ?>" class="btn text-start fw-bold m-1 btn-sm d-grid gap-2 btn-primary mb-1"><?= $no++ ?>. HPP</a> -->
            <a href="?page=produksi&aksi=laporan_produksi&veri=<?= $_SESSION['verifikasi'] ?>" class="btn text-start fw-bold m-1 btn-sm d-grid gap-2 btn-primary mb-1"><?= $no++ ?>. Laporan Produksi Harian</a>
            <br>
            <a href="?page=produksi&aksi=arus_kas&veri=<?= $_SESSION['verifikasi'] ?>" class="btn text-start fw-bold m-1 btn-sm d-grid gap-2 btn-primary mb-1"><?= $no++ ?>. Arus Kas / Belanja</a>
       
    <?php } ?>
   <?php 
        if($_SESSION['verifikasi']=='keuangan'){
        ?>
                   <label for="" class="d-grid mb-1 h5 text-light text-center">Keuangan</label>
            <a href="?page=rekap&aksi=&veri=<?= $_SESSION['verifikasi'] ?>"  class="btn text-start fw-bold m-1 btn-sm d-grid gap-2 btn-primary mb-1"><?= $no++ ?>. Rekap</a>
            <a href="?page=produksi&aksi=rencana&veri=<?= $_SESSION['verifikasi'] ?>" class="btn text-start fw-bold m-1 btn-sm d-grid gap-2 btn-primary mb-1"><?= $no++ ?>. Rencana Produksi</a>
            <a href="?page=arus_kas&aksi=&veri=<?= $_SESSION['verifikasi'] ?>" class="btn text-start fw-bold m-1 btn-sm d-grid gap-2 btn-primary mb-1"><?= $no++ ?>. Arus Kas</a>
            <a href="?page=nota&aksi=&veri=<?= $_SESSION['verifikasi'] ?>"  class="btn text-start fw-bold m-1 btn-sm d-grid gap-2 btn-primary mb-1"><?= $no++ ?>. Nota Keluar</a>
            <a href="?page=gaji&aksi=&veri=<?= $_SESSION['verifikasi'] ?>"  class="btn text-start fw-bold m-1 btn-sm d-grid gap-2 btn-primary mb-1"><?= $no++ ?>. Gaji</a>
    <?php } ?>

          
        </div>
        </div>
      </div>
      <!-- akhir sidebar -->
    </div>
    
<div class="container-fluid">

<!-- perintah -->
        <?php
        $page = $_GET["page"];
        $aksi = $_GET["aksi"];
        include "link.php";
       
        ?>
</div>

<?php 
if($page==''){
?>
<!-- penjualan halaman  -->
<div class="container card ">
    <div class="col-md-auto">
<div>
    <h3 class="text-center mt-2">Grafik Penjualan Harian CF</h3>
  <canvas id="myChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: 
      <?php 
      $sql_x = $koneksilama->query("select * from sales group by tgl_kirim_fix order by tgl_kirim_fix desc limit 15");
      
      $data = [];
      while($data_x = $sql_x->fetch_assoc()){
        array_push($data,explode("-",$data_x['tgl_kirim_fix'])[2]."-".explode("-",$data_x['tgl_kirim_fix'])[1]);
      }
        echo json_encode($data);
      ?>
      ,
      datasets: [{
        label: '# Jumlah Produk',
        data: 
        <?php 
      $sql_y = $koneksilama->query("select tgl_kirim_fix,sum(jumlah) as jum_y from sales where produk != ' Ongkir' AND produk != 'DISKON' and gudang != '' group by tgl_kirim_fix order by tgl_kirim_fix desc limit 15; ");
      
      $data2 = [];
      while($data_y = $sql_y->fetch_assoc()){
        array_push($data2,$data_y['jum_y']);
      }
        echo json_encode($data2);
      ?>
        ,
        borderWidth: 1,
          backgroundColor:'rgba(255, 159, 64, 0.2)',
          
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
</div>
</div>

<!-- penjualan halaman  -->

<!-- tabel penjualan -->
<div class="container mt-5">
    <h4>Tabel Penjualan Harian CF</h4>
    <table class="table table-bordered table-striped border-warning">
        <tr>
        <thead>
            <th>#</th>
            <th>Tanggal</th>
            <th>Jumlah Produk</th>
            <th>Jumlah Invoice</th>
            <th>Rasio</th>
            <th>Omset</th>
            <th>Avg Harga</th>
        </thead>
        </tr>
        <tbody>
        <?php 
        $bulan_ini = date("m", time());
      $sql_penju = $koneksilama->query("select tgl_kirim_fix,sum(jumlah) as jum, sum(jumlah*satuan) as omset from sales where produk != ' Ongkir' AND produk != 'DISKON' and gudang != '' and tgl_kirim_fix like '%-$bulan_ini-%'  group by tgl_kirim_fix order by tgl_kirim_fix ");
      $no = 1;
      $total_omset = [];
      $rasio_rata = [];
      $total_produk = [];
      $total_invoice = [];
      while($data_penju = $sql_penju->fetch_assoc()){      
      ?>
            <tr
            <?php 
            if($hari_ini == $data_penju['tgl_kirim_fix']){
                ?>
                style="color: red;"
                <?php 
            }
            ?>
            >
                <td><?= $no++ ?></td>
                <td><?= $data_penju['tgl_kirim_fix']." ". date('l', strtotime($data_penju['tgl_kirim_fix'])); ?></td>
                <td><?= $data_penju['jum'] ?> Pack</td>
                <?php 
                    $tgl =$data_penju['tgl_kirim_fix'];
                    $sql_inv = $koneksilama->query("select * from sales where tgl_kirim_fix = '$tgl' and gudang != '' group by no_inv ");
                    $jum_inv = mysqli_num_rows($sql_inv);
                    ?>
                <td><?= $jum_inv ?> Paket</td>
                <td><?= number_format($data_penju['jum']/$jum_inv,2) ?></td>
                <td>Rp. <?= number_format($data_penju['omset']) ?></td>
                <td>Rp. <?= number_format($data_penju['omset']/$data_penju['jum']) ?></td>
            </tr>
        <?php 
    array_push($total_omset, $data_penju['omset']);
    array_push($total_produk, $data_penju['jum']);
    array_push($total_invoice, $jum_inv);
    array_push($rasio_rata, $data_penju['jum']/$jum_inv);
    } ?>
    <th colspan="2" class="text-center">Total</th>
    
    <th class="fw-bold"><?= number_format(array_sum($total_produk)) ?> Pack</th>
    <th class="fw-bold"><?= number_format(array_sum($total_invoice)) ?> Paket</th>
    <th class="fw-bold">avg = <?= number_format(array_sum($rasio_rata)/count($rasio_rata)) ?></th>
    <th class="fw-bold">Rp. <?= number_format(array_sum($total_omset)) ?></th>
    <th class="fw-bold">Rp. <?= number_format(array_sum($total_omset)/array_sum($total_produk)) ?></th>
        </tbody>
    </table>
</div>
<!-- tabel penjualan -->


<!-- tabel penjualan -->
<div class="container mt-3">
    <h4>Tabel Rencana Produksi CF</h4>
    <table class="table table-bordered border-warning">
        <tr>
        <thead>
            <th>#</th>
            <th>Tanggal</th>
            <th>Produk</th>
            <th>Jumlah</th>
        </thead>
        </tr>
        <tbody>
        <?php 
      $sql_penju = $koneksilama->query("select * from tb_rencana_rekap order by tanggal desc limit 20 ;");
      $no = 1;
      while($data_penju = $sql_penju->fetch_assoc()){      
      ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $data_penju['tanggal'] ?></td>
                <td><?= $data_penju['produk'] ?></td>
                <td><?= $data_penju['jumlah'] ?> Pack</td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
<!-- tabel penjualan -->

<!-- produk halaman  -->
<div class="container card mt-3">
    <div class="col-md-auto">
<div>
    <h3 class="text-center mt-2">Grafik Stok Produk CF</h3>
  <canvas id="grafik_produk" style="height: 800px;"></canvas>
</div>


<script>
  const ctx2 = document.getElementById('grafik_produk');

  new Chart(ctx2, {
    type: 'bar',
    axis: 'y',
    data: {
      labels: 
      <?php 
      $sql_x = $koneksilama->query("select * from tb_barang where nama_barang not like 'Z%' and nama_barang != 'DISKON' and nama_barang != ' Ongkir' order by nama_barang desc ");
      
      $data = [];
      while($data_x = $sql_x->fetch_assoc()){
        array_push($data,$data_x['nama_barang']);
      }
        echo json_encode($data);
      ?>
      ,
      datasets: [{
        label: '# Jumlah Produk',
        data: 
        <?php 
      $sql_y = $koneksilama->query("select * from tb_barang where nama_barang not like 'Z%' order by nama_barang desc  ");
      
      $data2 = [];
      while($data_y = $sql_y->fetch_assoc()){
        array_push($data2,$data_y['stok']);
      }
        echo json_encode($data2);
      ?>
        ,
        borderWidth: 1,
          backgroundColor:'rgba(255, 159, 64, 0.2)',
          
      }]
    },
    options: {
        indexAxis: 'y',
        scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
</div>
</div>

<!-- produk halaman  -->


<!-- tabel penjualan -->
<div class="container mt-5">
    <h4>Tabel Stok Produk CF</h4>
    <table class="table table-bordered border-warning">
        <tr>
        <thead>
            <th>#</th>
            <th>Produk</th>
            <th>Jumlah</th>
        </thead>
        </tr>
        <tbody>
        <?php 
      $sql_penju = $koneksilama->query("select * from tb_barang where nama_barang != ' Ongkir' and nama_barang != 'DISKON' order by nama_barang asc ;");
      $no = 1;
      while($data_penju = $sql_penju->fetch_assoc()){      
      ?>
            <tr
            <?php 
            if($data_penju['stok']<10){
                echo "class=\"bg-warning\"";
            }
            ?>
            >
                <td><?= $no++ ?></td>
                <td><?= $data_penju['nama_barang'] ?></td>
                <td><?= $data_penju['stok'] ?> Pack</td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
<!-- tabel penjualan -->

<div class="p-5"></div>
<?php } ?>

<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>
