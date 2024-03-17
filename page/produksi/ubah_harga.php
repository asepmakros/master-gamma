
<?php 
$id = $_GET['id'];
$bahan = $_GET['bahan'];


$sqlubah = $koneksilama->query("select * from tb_bahan where id = '$id'");
$tampil = $sqlubah->fetch_assoc();

?>

<div class=" h4 text-center text-uppercase mt-1">
<?php 
echo "Ubah Bahan <br> ".$tampil['produk'];

$date = date("Y-m-d");
?></div>
<div class="mb-3">
<div class="container">
<a href="?page=produksi&aksi=bahan">back</a>    

 <form action="" method="post">

  <div class="input-group">
    <span class="input-group-text"  id="basic-addon3">Nama Bahan</span>
    <input name="bahan" required disabled value="<?= $tampil['bahan'] ?>"  type="text"  class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
  </div>

  <div class="input-group">
    <span class="input-group-text"  id="basic-addon3">Harga Beli Rp. </span>
    <input name="harga" required  value="<?= abs($tampil['harga']) ?>" min="0" type="number" min='0' class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
  </div>
  
  <div class="input-group">
    <span class="input-group-text"  id="basic-addon3">Dibutuhkan</span>
    <input name="jumlah_resep"  value="<?= $tampil['jumlah_resep'] ?>"  type="text" placeholder="" class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
    <span class="input-group-text"  id="basic-addon3"><?= $tampil['satuan'] ?></span>
  </div>
  <div class="input-group">
    <span class="input-group-text"  id="basic-addon3">untuk produksi sejumlah</span>
    <input name="hasil_pack"  value="<?= $tampil['hasil_pack'] ?>"  type="text" placeholder="" class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
    <span class="input-group-text"  id="basic-addon3"><?= $tampil['satuan'] ?></span>
  </div>

    <input name="ubah" type="submit" value="Ubah"  style="width:200px;" class="btn mt-1 btn-sm btn-outline-success">

</form>
</div>

<?php 
if(isset($_POST['ubah'])){
   
    $stok = $_POST['stok'];
    $harga = $_POST['harga'];
    $jumlah_resep = $_POST['jumlah_resep'];
    $hasil_pack = $_POST['hasil_pack'];
    // $bahan = $_POST['bahan'];
   
  
    $sql_ubah = $koneksilama->query("update tb_bahan set

    harga = '$harga',
    jumlah_resep = '$jumlah_resep',
    hasil_pack = '$hasil_pack'
    
    where id = '$id'
    ");


    if($sql_ubah){
    ?>
        <script type="text/javascript">
            alert("Transaksi Berhasil Diubah");
            window.location.href="?page=produksi&aksi=bahan";
        </script>
  <?php
    }
  }
  

?>


</div>

</div>
      </div>
      </div>
      </div>
          