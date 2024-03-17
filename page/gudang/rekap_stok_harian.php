

<?php
// include('../koneksi/koneksi.php');
$hari_ini = date('Y-m-d');


$packing = 'y1';

if(isset($_POST['pilih'])){
    $tgl_kirim_fix = $_POST['tgl'];
    // echo $tgl_kirim_fix;

$sqljumlah = $koneksilama->query("select *, sum(jumlah) as jum from sales where gudang like'y%' and tgl_kirim_fix = '$tgl_kirim_fix' group by no_inv order by no_inv desc");
$datajumlah = $sqljumlah->fetch_assoc();

$jumlah = mysqli_num_rows($sqljumlah);
    if($_POST['packing'] == ''){
        $packing = 'y1';
        
    }else{
        $packing = $_POST['packing'];
    }}



?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rekap Harian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
    <div class="card bg-secondary  d-print-none ">
    <div class="ms-2 mt-2 mb-2 input-group">
  <a href="?page=gudang" class="btn btn-sm btn-warning">back</a>
    <!-- <a href="?page=gudang&aksi=print" class="btn btn-sm btn-success  d-print-none">Print Packing</a> -->
    <!-- <a href="?page=gudang&aksi=berita_acara" class="btn btn-sm d-print-none btn-primary ">Berita Acara</a> -->
    <b class="ms-5 text-light text-center">Jumlah Resi Hari ini : <?php echo $jumlah." Resi";?></b>

</div></div>
    
    <!-- <a href="https://ciwideyfood.com/app/penjualan/unpack_all.php?no_inv=<?= $data['no_inv'] ?>" class="btn btn-sm btn-outline-danger d-print-none">Clear Packing</a> -->
   
   <div class="d-print-none">
            <div class="row  mb-3">
                <div class="col">
                    <div class=" text-center">

                    <form action="" method="post">
                        <div class="input-group col-md-6">
                        <input type="date" class="form-date" name="tgl" value="<?= $hari_ini ?>">
                        <select name="packing" id=""  class="form-select text-center">
                        <!-- <option value="" selected disabled>Pilih Batch</option> -->
                            <option value="1">Batch 1</option>
                            <option value="2">Batch 2</option>
                            <option value="3">Batch 3</option>
                            <option value="4">Batch 4</option>
                            <option value="5">Batch 5</option>
                            <!-- <option value="y3">Sore</option> -->
                        </select>
                        <input type="submit" value="pilih" width="70px" name="pilih" class="btn  btn-sm btn-primary">
                        </div>
                    </form>

                    </div>
                </div>
            </div>


    <div class="">

        <div class="row">
            <div class="col-md-6">
                <h5 class="text-center">REKAP PENGIRIMAN TANGGAL <?= $tgl_kirim_fix ?></h3>

                    <table class="table  table-sm" >
                        <thead>
                            <th>#</th>
                            <th>Produk</th>
                            <th>Jumlah</th>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            $sqlpagi = $koneksilama->query("select *, sum(jumlah) as jum from sales ,tb_barang where produk != ' Ongkir' and sales.produk = tb_barang.nama_barang and gudang like 'y%' and tgl_kirim_fix = '$tgl_kirim_fix' and produk != 'DISKON' group by produk order by produk asc");
                            while ($data = $sqlpagi->fetch_assoc()) {
                            ?>
                            <tr
                            <?php 
                            if($data['jum']>$data['stok']){
                                ?>
                                class="bg-danger text-light" 
                                <?php 
                            }
                            ?>
                            >
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $data['produk'] ?></td>
                                <td><?php echo $data['jum']." (Stok : ".$data['stok'].")" ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                <div class="col-md-6 d-print-none">
                     <h5 class="text-center">REKAP JADWAL PACKING </h5>

                    <table class="table table-striped table-sm" >
                        <thead>
                            <th>#</th>
                            <th>Tanggal</th>
                            <th>Jumlah Pack</th>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            $sql_tanggal = $koneksilama->query("select *, sum(jumlah) as jum from sales where waktu_fix != '0000-00-00' group by tgl_kirim_fix order by tgl_kirim_fix desc limit 10");
                            while ($data_tanggal = $sql_tanggal->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $data_tanggal['tgl_kirim_fix'] ?></td>
                                <td><?php 
                                $tgl = $data_tanggal['tgl_kirim_fix'];
                                $sqlresi = $koneksilama->query("select *, count(no_inv) as jumlah_resi from sales where  tgl_kirim_fix = '$tgl' group by no_inv");
                    $jumlah_resi=mysqli_num_rows($sqlresi);
                                
                                echo $jumlah_resi ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                </div>

                <!-- <div class="col-6 d-print-none">
                <h3>REKAP PEMBELI</h3>
                    <table class="table table-striped table-sm">
                        <thead>
                            <th>#</th>
                            <th>Produk</th>
                            <th>Jumlah</th>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            $sqlpelanggan = $koneksilama->query("select *,sum(jumlah*satuan) as tot, sum(jumlah) as jum from sales where gudang like 'y%' and produk != ' Ongkir' and tgl_kirim_fix = '$tgl_kirim_fix' and produk != 'DISKON' group by no_inv order by id desc");
                            while ($data_pelanggan = $sqlpelanggan->fetch_assoc()) {
                            ?>
                            <tr style="font-size: 9px;">
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $data_pelanggan['pelanggan']."<br>".$data_pelanggan['produks'] ?></td>
                                <td><?php echo $data_pelanggan['jum']." -> ".number_format($data_pelanggan['tot']) ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div> -->
            </div>
    </div>



<?php 
    if(isset($_POST['pilih'])){
        $packing = $_POST['packing'];
        ?>
        <div class="card">
            <h4 class="text-center">Rekap produk Packing Batch <?= $packing ?>
            <?php 
                $sql_resi_all = $koneksilama->query("select * from sales where  gudang ='y$packing'  and tgl_kirim_fix = '$tgl_kirim_fix'  group by no_inv");
                $jumlah_resi_all = mysqli_num_rows($sql_resi_all);
                echo "(".$jumlah_resi_all." paket)";
            ?>
        </h4>
            <h5 class="text-center">Tanggal <?= $tgl_kirim_fix ?></h5>
                <table class="table table-sm table-bordered  border" >
                        <thead>
                            <th>#</th>
                            <th>Produk</th>
                            <th>Jumlah</th>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            $sqlsiang = $koneksilama->query("select *, sum(jumlah) as jum from sales,tb_barang where sales.produk = tb_barang.nama_barang and gudang ='y$packing' and produk != ' Ongkir' and tgl_kirim_fix = '$tgl_kirim_fix' group by produk order by produk asc");
                            while ($data = $sqlsiang->fetch_assoc()) {
                            ?>
                            <tr style="font-size: 12px;" 
                            <?php 
                            if($data['jum']>$data['stok']){
                                ?>
                                class="text-danger"
                                <?php 
                            }
                            ?>
                            >
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $data['produk'] ?></td>
                                <td><?php echo $data['jum']." (Stok : ".$data['stok'].")" ?> </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>

        </div>
        <div class="card mt-3">
            <h4 class="text-center">Rekap Ekspedisi Batch <?= $packing ?>
            <?php 
                             $sql_resi_all = $koneksilama->query("select * from sales where  gudang ='y$packing'  and tgl_kirim_fix = '$tgl_kirim_fix'  group by no_inv");
                             $jumlah_resi_all = mysqli_num_rows($sql_resi_all);
                             echo "(".$jumlah_resi_all." paket)";
                            ?>
        </h4>
            <h5 class="text-center">Tanggal <?= $tgl_kirim_fix ?></h5>
                <table class="table table-sm table-striped  border" >
                        <thead>
                            <th>#</th>
                            <th>Kurir</th>
                            <th>Produk</th>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            $sqlsiang = $koneksilama->query("select *, sum(jumlah) as jum from sales where  gudang ='y$packing' and produk != ' Ongkir' and tgl_kirim_fix = '$tgl_kirim_fix' group by kurir");
                            while ($data = $sqlsiang->fetch_assoc()) {
                            ?>
                            <tr style="font-size: 18px;" >
                                <td><?php echo $no++ ?></td>
                                <td>
                                <a href="page/gudang/detil_ekspedisi.php?kurir=<?= $data['kurir'] ?>&tgl_kirim_fix=<?= $tgl_kirim_fix ?>&batch=<?= $packing ?>">   
                                <?php echo $data['kurir'] ?>
                            <?php 
                                $kurir = $data['kurir'];
                             $sql_resi = $koneksilama->query("select *, count(no_inv) as jum_resi from sales where  gudang ='y$packing'  and tgl_kirim_fix = '$tgl_kirim_fix' and kurir = '$kurir' group by no_inv");
                             $jumlah_resi_kurir = mysqli_num_rows($sql_resi);
                             echo "(".$jumlah_resi_kurir." paket)";
                            ?></a> 
                            </td>

                                <td><?php 
                                $noo = 1;
                                $kurir = $data['kurir'];
                                $sql_kurir = $koneksilama->query("select *, sum(jumlah) as jum from sales where   gudang ='y$packing' and produk != ' Ongkir' and tgl_kirim_fix = '$tgl_kirim_fix' and kurir = '$kurir' group by produk");
                                while ($data_kurir = $sql_kurir->fetch_assoc()) {
                                echo $noo++. ". ". $data_kurir['produk']." = ". $data_kurir['jum']. " Pcs <br>";
                                }
                                ?>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>


        <?php
    }
?>

</div>





</div>
<div class="mb-5"></div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>