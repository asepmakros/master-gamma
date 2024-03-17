<div class="container pb-5">
<a href="?page=produksi&aksi=rencana">back</a>    
<br>
    <b>Produksi Tgl : <?= $_GET['tgl_produksi'] ?></b><br>
<?php 
$tgl_produksi = $_GET['tgl_produksi'];

$no = 1;
$sql_detil = $koneksilama->query("select *, sum(jumlah) as jum from tb_rencana_rekap
 where tanggal = '$tgl_produksi' group by produk");


while($tampil_detil = $sql_detil->fetch_assoc()){
    echo $no++.". ".$tampil_detil['produk'];
    echo " = ".$tampil_detil['jum'] ." Pack";
    echo "<br>";
}

?>
<b>Belanja Bahan :</b>

<table class="table table-striped" style="line-height: 0.5;">
    <thead>
        <th>#</th>
        <th>Nama Bahan</th>
        <th>Qty</th>
        <th>Harga</th>
    </thead>
    <tbody>
    
<?php 
$no = 1;

// $sql_detil_bahan = $koneksilama->query("select * from tb_rencana_produksi where  tgl_produksi = '$tgl_produksi' group by nama_bahan");
$sql_detil_bahan = $koneksilama->query("select *, sum(harga) as total from tb_rencana_produksi where tgl_produksi = '$tgl_produksi' group by nama_bahan");
while($tampil_detil_bahan = $sql_detil_bahan->fetch_assoc()){
    $prod = $tampil_detil_bahan['produk'];
    $tgl = $tampil_detil_bahan['tgl_produksi'];

    $sql_jum = $koneksilama->query("select *, sum(jumlah) as jum from tb_rencana_rekap
    where tanggal = '$tgl' and produk = '$prod' group by produk");
    $detil = $sql_jum->fetch_assoc();
?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= $tampil_detil_bahan['nama_bahan'] ?></td>*
    <td><?= number_format($tampil_detil_bahan['berat_bahan']*$detil['jum'])." ".$tampil_detil_bahan['satuan'] ?></td>
    <td><?= number_format($tampil_detil_bahan['harga']*$detil['jum']) ?></td>

</tr>
    </tbody>

    <?php } 
    $sql_tots = $koneksilama->query("select *, sum(harga) as tots from tb_rencana_produksi where  tgl_produksi = '$tgl_produksi' ");
    $tampil_tots = $sql_tots->fetch_assoc();
    
    $sql_tots_nokemasan = $koneksilama->query("select *, sum(harga) as tots from tb_rencana_produksi where  tgl_produksi = '$tgl_produksi' and nama_bahan not like '%emasa%' ");
    $tampil_tots_nokemasan = $sql_tots_nokemasan->fetch_assoc();

    ?>
    <th colspan="3" class="text-center bg-dark text-light">TOTAL</th>
    <th class=" bg-dark text-light"><?= "Rp. ".number_format($tampil_tots['tots']*$detil['jum']) ?></th>
    <tr>
    <th colspan="3" class="text-center bg-dark text-light">TOTAL TANPA KEMASAN</th>
    <th class=" bg-dark text-light"><?= "Rp. ".number_format($tampil_tots_nokemasan['tots']*$detil['jum']) ?></th>
    </tr>
</table>


</div>