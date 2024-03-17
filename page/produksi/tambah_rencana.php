
<?php 
$id = $_GET['id'];
$produk = $_POST['produk'];
$jumlah_produk = $_POST['jumlah_produk'];


$sqltambah = $koneksilama->query("select * from tb_bahan where id = '$id'");
$tampil = $sqltambah->fetch_assoc();

?>

<div class=" h4 text-center text-uppercase mt-1">
<?php 
echo "Tambah Rencana ".$jumlah_produk." ".$produk;

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
    <input name="jumlah_produk" required   type="text"  class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
    <div class="btn">pack</div>
  </div>
<!-- 
 <div class="input-group">
    <span class="input-group-text"  id="basic-addon3">Bahan</span>
<select name="bahan" id="" class="form-control">
    <option value="" selected disabled>Pilih Bahan</option>
    <?php 
    
    $sql_tambah = $koneksilama->query("select * from tb_bahan 
    group by bahan
    ");
    while($data_tambah = $sql_tambah->fetch_assoc()){

    ?>
    <option value="<?= $data_tambah['bahan']?>"><?= $data_tambah['bahan']?></option>
    <?php }?>
</select>
    </div>



 <div class="input-group">
    <span class="input-group-text"  id="basic-addon3">Jumlah bahan</span>
    <input name="jumlah_bahan" required   type="text"  class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
    <div class="btn">pack</div>
  </div>

 <div class="input-group">
    <span class="input-group-text"  id="basic-addon3">Harga Satuan bahan</span>
    <input name="harga" required   type="text"  class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
  </div>

    <input name="satuan" hidden  value="<?= $tampil['satuan']?>"  type="text"  class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4"> -->

    <input name="tambah" type="submit" value="tambah"  style="width:200px;" class="btn mt-1 btn-sm btn-outline-success">

</form>
</div>

<?php 
if(isset($_POST['tambah'])){
//     $produk = $_POST['produk']; 
//     $jumlah_produk = $_POST['jumlah_produk'];
//     $satuan = $_POST['satuan'];
//     $nama_bahan = $_POST['nama_bahan'];
//     $tgl_produksi = $_POST['tgl_produksi'];
//     $harga = $_POST['harga'];
//     $berat_bahan = $_POST['berat_bahan'];

  
//     $sql_tambah = $koneksilama->query("insert into tb_rencana_produksi 
//     (tgl_produksi,
//     produk,
//     jumlah_produk,
//     nama_bahan,
//     harga,
//     berat_bahan,
//     satuan
//     )
//     values
//    ('$tgl_produksi',
//     '$produk',
//     '$jumlah_produk',
//     '$bahan_detil',
//     '$harga',
//     '$jumlah_resep',
//     '$satuan'
//     )");
    

    if($jum_data==0){
    ?>
        <script type="text/javascript">
            alert("Transaksi Berhasil Ditambah");
            window.location.href="?page=produksi&aksi=tambah_rencana";
        </script>
  <?php
    }
  }
  

?>


</div>

<div class="container">

<table class="table table-striped" style="line-height: 0.5;">
  <thead>
    <th>#</th>
    <th>Tanggal Produksi</th>
    <!-- <th>Total   Biaya</th> -->
    <th>Aksi</th>
  </thead>
  <tbody >
    <?php 
    $no = 1;
    $sql_rencana = $koneksilama->query("select *,sum(harga) as tots from tb_rencana_produksi group by tgl_produksi order by id desc");
    while($data_rencana = $sql_rencana->fetch_assoc()){
      ?>
      <tr style="line-height: 1;">
      <td><?= $no++ ?></td>
      <td><b><?= $data_rencana['tgl_produksi'] ?></b><br>
      <?php 
      $nomor = 1;
      $tgl = $data_rencana['tgl_produksi'];
        $prod = $data_rencana['produk'];

        $sql_produk_rekap = $koneksilama->query("select *, sum(jumlah) as jum from tb_rencana_rekap where tanggal = '$tgl'  group by produk order by id desc");
    while($data_produk = $sql_produk_rekap->fetch_assoc()){
       
      ?>  
      <?= $nomor++.". ".$data_produk['produk']." = ".$data_produk['jum'] ?> pack
      <a class="text-danger mb-1" href="?page=produksi&aksi=hapus_rencana&tgl_produksi=<?= $data_produk['tanggal'] ?>&produk=<?= $data_produk['produk'] ?>" onclick="return confirm('Yakin produksi <?= $data_produk['produk']?> akan dihapus?')"> <span class="material-symbols-outlined">
            delete
            </span></a>
<br>
    <?php 
    
  }?>
    </td>
      <!-- <td>
           <?php 
  echo number_format($data_rencana['tots']);

?>
</td> -->
<td><a class="btn btn-sm btn-primary" href="?page=produksi&aksi=detil_belanja&tgl_produksi=<?= $tgl ?>">Detil Belanja Harian</a></td>
    </tr>
    <?php }?>
  </tbody>
</table>
</div>

          