<div class="container pb-5">
<a href="?page=produksi&aksi=rencana" class="d-print-none">back</a>    
<br>
<?php 
$hari_ini = date('Y-m-d');
?>
    <b class="d-print-none">Produksi Tgl : <?= $_GET['tgl_produksi'] ?></b><br>

    <form action="" method="post" class="d-print-none">
        <div class="input-group">
    <span class="input-group-text"  id="basic-addon3">Tanggal Awal</span>
            <input type="date" name="tgl_awal" class="form-control" value="<?= $hari_ini ?>">
        </div>
         <div class="input-group">
    <span class="input-group-text"  id="basic-addon3">Tanggal Akhir</span>
            <input type="date" name="tgl_akhir" class="form-control" value="<?= $hari_ini ?>">
        </div>

        <input type="submit" name="proses" value="Proses" class="btn btn-sm btn-primary mt-1 mb-2">
    </form>
<?php 
if(isset($_POST['proses'])){
$tgl_awal = $_POST['tgl_awal'];
$tgl_akhir = $_POST['tgl_akhir'];

}

?>
<div class="card">
    <div class="ms-2 mb-2 mt-2">
<b>Produksi <?= $tgl_awal." s/d ".$tgl_akhir ?>:</b><br>
<table class="table table-striped table-bordered" style="line-height: 0.5;">
<thead>
        <tr>
            <th>#</th>
            <th>Tanggal</th>
            <th>Produk</th>
            <th>Jumlah</th>
        </tr>
    </thead>
    <tbody>

<?php 
$no = 1;

$sql_detil = $koneksilama->query("select * from tb_rencana_produksi
 where tgl_produksi between '$tgl_awal' and '$tgl_akhir' group by tgl_produksi,produk order by tgl_produksi asc");
while($tampil_detil = $sql_detil->fetch_assoc()){
    ?>

  
    <tr>
        <td><?= $no++ ?></td>
        <td><?= $tampil_detil['tgl_produksi'] ?></td>
        <td><?= $tampil_detil['produk'] ?></td>
        <td><?= $tampil_detil['jumlah_produk'] ?> Pack</td>
    </tr>

    <?php
}
?>
    </tbody>
</table>
Rekap Produk : <br>
<?php
$no2 = 1;
$sql_detil2 = $koneksilama->query("select *,sum(jumlah) as jumlah_produk from tb_rencana_rekap
 where tanggal between '$tgl_awal' and '$tgl_akhir' group by produk ");
while($tampil_detil2 = $sql_detil2->fetch_assoc()){
    ?>
        <thead>
        <th><?= $no2++ ?></th>. 
        <th><?= $tampil_detil2['produk'] ?></th>=
        <th><?= $tampil_detil2['jumlah_produk'] ?> Pack</th>
    </thead>
    <br>
    
    <?php
}
?>

</div>
</div>

<b>Belanja Bahan :</b>

<table class="table table-bordered" >
    <thead class=" text-center align-middle">
        <th rowspan="2">#</th>
        <th rowspan="2" style="width: 20%;">Nama Bahan</th>
        <th rowspan="2" style="width: fit-content;">Qty</th>
        <th rowspan="2" style="width: fit-content;">Harga</th>
        <th colspan="2">Realisasi Belanja</th>
    </thead>
    <tbody>
    <tr class="text-center">
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>Rp Belanja</td>
        <td>Jml Belanja</td>
    </tr>
<?php 
$no = 1;
$total_bahan = [];

$sql_detil_bahan = $koneksilama->query("select *, sum(harga) as total from tb_rencana_produksi where  tgl_produksi between '$tgl_awal' and '$tgl_akhir' group by nama_bahan");
while($tampil_detil_bahan = $sql_detil_bahan->fetch_assoc()){
  
    $produk = $tampil_detil_bahan['produk'];
    $sql_detil_rekap = $koneksilama->query("select *,sum(jumlah) as jum from tb_rencana_rekap
    where produk = '$produk' and tanggal between '$tgl_awal' and '$tgl_akhir' group by produk ");
    $tampil_detil_rekap = $sql_detil_rekap->fetch_assoc();

array_push($total_bahan,($tampil_detil_bahan['harga']*$tampil_detil_rekap['jum']));
?>
    <td><?= $no++ ?></td>
    <td><?= $tampil_detil_bahan['nama_bahan'] ?></td>
    <td><?= number_format($tampil_detil_bahan['berat_bahan']*$tampil_detil_rekap['jum'])." ".$tampil_detil_bahan['satuan'] ?></td>
    <td><?= "Rp. ".number_format($tampil_detil_bahan['harga']*$tampil_detil_rekap['jum']) ?></td>
    <td></td>
    <td></td>


    </tbody>

    <?php }
     $sql_tots = $koneksilama->query("select *, sum(harga) as tots from tb_rencana_produksi where  tgl_produksi between '$tgl_awal' and '$tgl_akhir'");

    $tampil_tots = $sql_tots->fetch_assoc();

    ?>
    <th colspan="3" class="text-center bg-dark text-light">TOTAL</th>
    <th class=" bg-dark text-light"><?= "Rp. ".number_format($tampil_tots['tots']*$tampil_detil_rekap['jum']) ?></th>
    <th></th>
    <th></th>
    <tr>
    <?php 
     $sql_tots2 = $koneksilama->query("select *, sum(harga) as tots from tb_rencana_produksi where  tgl_produksi between '$tgl_awal' and '$tgl_akhir' and nama_bahan not like '%emasa%'");

    $tampil_tots2 = $sql_tots2->fetch_assoc();

    ?>
    <th colspan="3" class="text-center bg-dark text-light">TOTAL HANYA BAHAN</th>
    <th class=" bg-dark text-light"><?= "Rp. ".number_format($tampil_tots2['tots']*$tampil_detil_rekap['jum']) ?></th>
    <th></th>
    <th></th>
    </tr>
</table>


</div>