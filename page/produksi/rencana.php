
<?php 
$id = $_GET['id'];
$produk = $_GET['produk'];


$sqltambah = $koneksilama->query("select * from tb_bahan where id = '$id'");
$tampil = $sqltambah->fetch_assoc();

function hari_ini(){
 $hari = date ("D");
 
 switch($hari){
 case 'Sun':
 $hari_ini = "Minggu";
 break;
 
 case 'Mon': 
 $hari_ini = "Senin";
 break;
 
 case 'Tue':
 $hari_ini = "Selasa";
 break;
 
 case 'Wed':
 $hari_ini = "Rabu";
 break;
 
 case 'Thu':
 $hari_ini = "Kamis";
 break;
 
 case 'Fri':
 $hari_ini = "Jumat";
 break;
 
 case 'Sat':
 $hari_ini = "Sabtu";
 break;
 
 default:
 $hari_ini = "Tidak di ketahui"; 
 break;
 }
 
 return  $hari_ini ;
 
}
 
 
?>
?>

<div class=" h4 text-center text-uppercase mt-1">
<?php 
echo "Rencana Produksi CF";

$date = date("Y-m-d");
?></div>
<div class="mb-3">
<div class="container my-6">

 <form action="" method="post" >

 <div class="input-group">
    <span class="input-group-text"  id="basic-addon3">Tanggal Produksi</span>
 <input type="date" value="<?= $date ?>" name="tgl_produksi" class="form-control">
 </div>

 <div class="input-group">
    <span class="input-group-text"  id="basic-addon3">Kode Minggu</span>
 <input type="text" name="minggu" class="form-control">
 </div>

 <div class="input-group">
    <span class="input-group-text"  id="basic-addon3">Jenis Produk</span>
        <select name="produk" id="" class="form-control">
            <option value="" selected disabled>Pilih Produk</option>
            <?php 
            
            $sql_tambah = $koneksilama->query("select * from tb_barang 
            where nama_barang not like 'Z%' and 
            nama_barang != ' Ongkir' and
            nama_barang != 'DISKON'
            group by nama_barang
            ");
            while($data_tambah = $sql_tambah->fetch_assoc()){

            ?>
            <option value="<?= $data_tambah['nama_barang']?>"><?= $data_tambah['nama_barang']?></option>
            <?php }?>
        </select>
    </div>

    <div class="input-group">
        <span class="input-group-text"  id="basic-addon3">Jumlah Produk</span>
        <input name="jumlah_produksi" required   type="text"  class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
         <div class="btn">pack</div>
    </div>
    <div class="input-group">
        <span class="input-group-text"  id="basic-addon3">Jumlah Bahan Baku</span>
        <input name="jumlah_bahan_baku" required   type="text"  class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
         <div class="btn">tiap box/kg</div>
    </div>
    <div class="input-group">
        <span class="input-group-text"  id="basic-addon3">Harga Bahan Baku Rp.</span>
        <input name="harga_bahan_baku" required   type="text"  class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
         <div class="btn">tiap box/kg</div>
    </div>
    <div class="input-group">
        <span class="input-group-text"  id="basic-addon3">Update HPP Perpack</span>
        <input name="hpp_update" required   type="text"  class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
  </div>

    <input name="tambah" type="submit" value="tambah"  style="width:200px;" class="btn mt-1 btn-sm btn-outline-success">

</form>
</div>

<?php 
if(isset($_POST['tambah'])){
    $tgl_produksi = $_POST['tgl_produksi'];
    $produk = $_POST['produk']; 
    $jumlah_produksi = $_POST['jumlah_produksi'];
    $jumlah_bahan_baku = $_POST['jumlah_bahan_baku'];
    $harga_bahan_baku = $_POST['harga_bahan_baku'];
    $hpp_update = $_POST['hpp_update'];
    $minggu = $_POST['minggu'];
  

  
    $sql_tambah = $koneksilama->query("insert into tb_rencana_produksi 
    (
    tgl_produksi,
    produk,
    jumlah_produksi,
    jumlah_bahan_baku,
    harga_bahan_baku,
    hpp_update,
    minggu
    )
    values
   (
    '$tgl_produksi',
    '$produk',
    '$jumlah_produksi',
    '$jumlah_bahan_baku',
    '$harga_bahan_baku',
    '$hpp_update',
    '$minggu'
    )");
    
  if($sql_tambah){
    ?>
        <script type="text/javascript">
            alert("Transaksi Berhasil Ditambah");
            window.location.href="?page=produksi&aksi=rencana";
        </script>
  <?php
    }

  }
  

?>


</div>

<div class="container">
<h2>Data Produksi</h2>
<table class="table table-striped" style="line-height: 1;">
  <thead>
    <th>#</th>
    <th>Tanggal </th>
    <th>Produk/HPP</th>
    <th>Jumlah Produksi</th>
    <th>Jumlah Bahan Baku</th>
    <th>Biaya Bahan Baku</th>
    <th>Biaya Bumbu</th>
    <th>Total Biaya</th>
    <th>Aksi</th>
  </thead>
  <tbody >
    <?php 
    $no = 1;
    $sql_rencana = $koneksilama->query("select * from tb_rencana_produksi  order by id desc limit 30");
    while($data_rencana = $sql_rencana->fetch_assoc()){
      ?>
      <tr style="line-height: 1;">
      <td><?= $no++ ?></td>
      <td><b><?= 'Minggu : '.$data_rencana['minggu']."<br>".hari_ini('D').", ".$data_rencana['tgl_produksi'] ?>
    </td>
    <td><?= $data_rencana['produk']."(Hpp = ". number_format($data_rencana['hpp_update']).")" ?></td>
    <td><?= $data_rencana['jumlah_produksi'] ?></td>
    <td><?= $data_rencana['jumlah_bahan_baku']." = ".number_format($data_rencana['harga_bahan_baku'])." perbox/perkg" ?></td>
    <td><?= number_format($data_rencana['jumlah_bahan_baku']*$data_rencana['harga_bahan_baku']) ?></td>
    <td><?= number_format($data_rencana['hpp_update']*$data_rencana['jumlah_produksi']-($data_rencana['jumlah_bahan_baku']*$data_rencana['harga_bahan_baku'])) ?></td>
    <td><?= number_format($data_rencana['hpp_update']*$data_rencana['jumlah_produksi']) ?></td>
      <!-- <td>
           <?php 
  echo number_format($data_rencana['tots']);

?>
</td> -->
<!-- <td><a class="btn btn-sm btn-primary" href="?page=produksi&aksi=detil_belanja&tgl_produksi=<?= $tgl ?>">Detil Belanja Harian</a></td> -->

<?php
$pesan = 'Assalamualaikum,%0AKebutuhan%20produksi%20hari%20'.hari_ini('D').'%20tanggal%20'.$data_rencana['tgl_produksi'].'%0A%0A'.$data_rencana['produk'].'%20=%20'.$data_rencana['jumlah_produksi'].'%20Pack%0A%0ABiaya%20Bahan%20Baku%20=%20Rp.'.number_format($data_rencana['jumlah_bahan_baku']*$data_rencana['harga_bahan_baku']).'%0A%0ABiaya%20bumbu%20=%20Rp.'.number_format($data_rencana['hpp_update']*$data_rencana['jumlah_produksi']-($data_rencana['jumlah_bahan_baku']*$data_rencana['harga_bahan_baku']));

// echo $pesan;
?>

<td><a href="https://wa.me/6282312602028?text=<?= $pesan ?>" class="btn btn-sm btn-success">Kirim Pa Uus</a><a href="?page=produksi&aksi=hapus_rencana&id=<?= $data_rencana['id'] ?>" class="btn btn-sm btn-danger">Hapus</a></td>
    </tr>
    <?php }?>
  </tbody>
</table>
</div>

<div class="container">
    <h2>Rekap Biaya Produksi</h2>
<table class="table table-striped" border="1">
        <thead>
            <th>#</th>
            <th>Minggu</th>
            <th>Biaya</th>
        </thead>
        <?php
        $no = 1;
        $sql_rekap = $koneksilama->query("select *, sum(jumlah_produksi*hpp_update) as total from tb_rencana_produksi group by minggu order by id desc limit 10");
        while($data_rekap = $sql_rekap->fetch_assoc()){
        ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $data_rekap['minggu'] ?></td>
            <td><?= "Rp. ".number_format($data_rekap['total']) ?></td>
        </tr>

        <?php } ?>
</table>
</div>

          