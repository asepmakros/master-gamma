
<?php 
$id = $_GET['id'];
$produk = $_GET['produk'];


$sqltambah = $koneksilama->query("select * from tb_bahan where id = '$id'");
$tampil = $sqltambah->fetch_assoc();

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
    <span class="input-group-text"  id="basic-addon3">Jenis Produk</span>
<select name="produk" id="" class="form-control">
    <option value="" selected disabled>Pilih Produk</option>
    <?php 
    
    $sql_tambah = $koneksilama->query("select * from tb_bahan group by produk");
    while($data_tambah = $sql_tambah->fetch_assoc()){

    ?>
    <option value="<?= $data_tambah['produk']?>"><?= $data_tambah['produk']?></option>
    <?php }?>
</select>
    </div>


 <div class="input-group">
    <span class="input-group-text"  id="basic-addon3">Jumlah Produk</span>
    <input name="jumlah_produk" required   type="text"  class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
    <div class="btn">pack</div>
  </div>

    <input name="tambah" type="submit" value="tambah"  style="width:200px;" class="btn mt-1 btn-sm btn-outline-success">

</form>
</div>

<?php 
if(isset($_POST['tambah'])){
    $tgl_produksi = $_POST['tgl_produksi'];
    $produk = $_POST['produk'];
    $jumlah_produk = $_POST['jumlah_produk'];
    $nama_bahan = $_POST['nama_bahan'];
    $biaya_produksi = $_POST['biaya_produksi'];
 

    $sql_bahan = $koneksilama->query("select * from tb_bahan where produk = '$produk'");
    $jum_data = mysqli_num_rows($sql_bahan);
    while($tambah_bahan = $sql_bahan->fetch_assoc()){
      $jum_data--;
      $bahan_detil = $tambah_bahan['bahan'];
      $jumlah_resep = $tambah_bahan['jumlah_resep'];
      $harga = $tambah_bahan['harga']/$tambah_bahan['hasil_pack']*$jumlah_produk;
    $sql_tambah = $koneksilama->query("insert into tb_rencana_produksi 
    (tgl_produksi,
    produk,
    jumlah_produk,
    nama_bahan,
    harga,
    berat_bahan)
    values
   ('$tgl_produksi',
    '$produk',
    '$jumlah_produk',
    '$bahan_detil',
    '$harga',
    '$jumlah_resep')");
    }

    if($jum_data==0){
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

<table class="table">
  <thead>
    <th>#</th>
    <th>Tanggal Produksi</th>
    <th>Produk</th>
    <th>Total   Biaya</th>
    <th>Aksi</th>
  </thead>
  <tbody>
    <?php 
    $no = 1;
    $sql_rencana = $koneksilama->query("select * from tb_rencana_produksi group by tgl_produksi order by id desc");
    while($data_rencana = $sql_rencana->fetch_assoc()){
      ?>
      <tr>
      <td><?= $no++ ?></td>
      <td><?= $data_rencana['tgl_produksi'] ?></td>
      <td>
      <?php 
      $nomor = 1;
      $tgl = $data_rencana['tgl_produksi'];
       $sql_produk = $koneksilama->query("select * from tb_rencana_produksi where tgl_produksi = '$tgl' group by produk order by id desc");
    while($data_produk = $sql_produk->fetch_assoc()){
      ?>  
      <?= $nomor++.". ".$data_produk['produk']." = ".$data_produk['jumlah_produk'] ?> pack
      <a class="btn btn-sm btn-outline-danger mb-1" href="?page=produksi&aksi=hapus_rencana&tgl_produksi=<?= $data_produk['tgl_produksi'] ?>&produk=<?= $data_produk['produk'] ?>" onclick="return confirm('Yakin produksi <?= $data_produk['produk']?> akan dihapus?')">Delete</a>
<br>
    <?php 
    array_push($biaya,$data_produk['harga']*$data_produk['jumlah_produk']);
  }?>
    </td>
      <td>
           <?php 
      $biaya = [];
      $tgl_total = $data_rencana['tgl_produksi'];
       $sql_produk = $koneksilama->query("select * from tb_rencana_produksi where tgl_produksi = '$tgl_total' ");
    while($data_produk = $sql_produk->fetch_assoc()){
      ?>  
    <?php 
    array_push($biaya,$data_produk['harga']);
  }?>Rp. 
  <?php
  echo number_format(array_sum($biaya));

?>
</td>
<td><a class="btn btn-sm btn-primary" href="?page=produksi&aksi=detil_belanja&tgl_produksi=<?= $tgl ?>">Detil Belanja</a></td>
    </tr>
    <?php }?>
  </tbody>
</table>
</div>

          