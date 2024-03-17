

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
    <div class="card bg-secondary">
    <div class="ms-2 mt-2 mb-2 input-group">
  <a href="?page=gudang" class="btn btn-sm d-print-none btn-warning">back</a>
    <!-- <a href="?page=gudang&aksi=print" class="btn btn-sm btn-success  d-print-none">Print Packing</a> -->
    <a href="?page=gudang&aksi=berita_acara" class="btn btn-sm d-print-none btn-primary ">Berita Acara</a>
</div></div>
    <div class=" mt-2">
    
    <!-- <a href="https://ciwideyfood.com/app/penjualan/unpack_all.php?no_inv=<?= $data['no_inv'] ?>" class="btn btn-sm btn-outline-danger d-print-none">Clear Packing</a> -->
   
   <div class="">
            <div class="row d-print-none mb-3">
                <div class="col">
                    <div class=" text-center">

                    <form action="" method="post">
                        <div class="input-group col-md-6">
                        <input type="date" class="form-date" name="tgl" value="<?= $hari_ini ?>">
                        <select name="packing" id=""  class="form-select text-center">
                        <option value="" selected disabled>Pilih Waktu Closing</option>
                            <option value="y1">Pagi</option>
                            <option value="y2">Siang</option>
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
                <h3 class="text-center">REKAP PENGIRIMAN TANGGAL <?= $tgl_kirim_fix ?></h3>
                    <b class="text-center">Jumlah Resi : <?php echo $jumlah." Resi";?></b>

                    <table class="table table-striped table-sm" style="line-height: 0.5;">
                        <thead>
                            <th>#</th>
                            <th>Produk</th>
                            <th>Jumlah</th>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            $sqlpagi = $koneksilama->query("select *, sum(jumlah) as jum from sales ,tb_barang where produk != ' Ongkir' and sales.produk = tb_barang.nama_barang and gudang like 'y%' and tgl_kirim_fix = '$tgl_kirim_fix' group by produk order by produk asc");
                            while ($data = $sqlpagi->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $data['produk'] ?></td>
                                <td><?php echo $data['jum']." (Stok : ".$data['stok'].")" ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                <div class="col-md-6 d-print-none">
                     <h3 class="text-center">REKAP JADWAL PACKING </h3>

                    <table class="table table-striped table-sm" style="line-height: 0.5;">
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
                            $sqlpelanggan = $koneksilama->query("select *,sum(jumlah*satuan) as tot, sum(jumlah) as jum from sales where gudang like 'y%' and produk != ' Ongkir' and tgl_kirim_fix = '$tgl_kirim_fix' group by no_inv order by id desc");
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

<div <?php if($packing != 'y1'){ echo "hidden";}?>>
    <h3 class="bg-danger">Packing Pagi</h3>
    <table class="table table-sm table-dark  border" style="line-height: 0.5;">
            <thead>
                <th>#</th>
                <th>Produk</th>
                <th>Jumlah</th>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                $sqlsiang = $koneksilama->query("select *, sum(jumlah) as jum from sales,tb_barang where sales.produk = tb_barang.nama_barang and gudang ='y1' and produk != ' Ongkir' and tgl_kirim_fix = '$tgl_kirim_fix' group by produk order by produk asc");
                while ($data = $sqlsiang->fetch_assoc()) {
                ?>
                <tr style="font-size: 12px;" class="fw-bold">
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $data['produk'] ?></td>
                    <td><?php echo $data['jum']." (Stok : ".$data['stok'].")" ?> </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        </div>

        <?php
        $sqlsore = $koneksilama->query("select *, sum(jumlah) as jum from sales ,tb_barang where sales.produk = tb_barang.nama_barang and gudang ='y2' and produk != ' Ongkir' and tgl_kirim_fix = '$tgl_kirim_fix' group by produk order by produk asc");
        if(mysqli_num_rows($sqlsore)>0){
        ?>

<div <?php if($packing != 'y2'){ echo "hidden";}?>>

        <h3 class="bg-warning">Packing Siang</h3>
    <table  class="table table-sm" >
            <thead>
                <th>#</th>
                <th>Produk</th>
                <th>Jumlah</th>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                while ($data = $sqlsore->fetch_assoc()) {
                ?>
                <tr style="font-size: 12px;" class="fw-bold">
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $data['produk'] ?></td>
                    <td><?php echo $data['jum']." (Stok : ".$data['stok'].")" ?></td>
                </tr>
                <?php }
                } ?>
            </tbody>
        </table>
</div>

<div <?php if($packing != 'y3'){ echo "hidden";}?>>

<?php
        $sql = $koneksilama->query("select *, sum(jumlah) as jum from sales ,tb_barang where sales.produk = tb_barang.nama_barang and gudang ='y3' and produk != ' Ongkir' and tgl_kirim_fix = '$tgl_kirim_fix' group by produk order by produk asc");
        if(mysqli_num_rows($sql)>0){

?>
        <h3 class="bg-success">Packing Sore</h3>
    <table  class="table table-sm" >
            <thead>
                <th>#</th>
                <th>Produk</th>
                <th>Jumlah</th>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                while ($data = $sql->fetch_assoc()) {
                ?>
                <tr style="font-size: 12px;" class="fw-bold">
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $data['produk'] ?></td>
                    <td><?php echo $data['jum']." (Stok : ".$data['stok'].")" ?></td>
                </tr>
                <?php } } ?>
            </tbody>
        </table>
</div>




    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>