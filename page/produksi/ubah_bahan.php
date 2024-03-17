
<?php 
$id = $_GET['id'];
$produk = $_GET['produk'];


$sqlubah = $koneksilama->query("select * from tb_bahan where id = '$id'");
$tampil = $sqlubah->fetch_assoc();

?>

<div class=" h4 text-center text-uppercase mt-1">
<?php 
echo "Ubah Bahan <br> ".$produk;

$date = date("Y-m-d");
?></div>
<div class="mb-3">
<div class="container">
    <a href="?page=produksi&aksi=hpp">back</a>    


 <form action="" method="post">

     <input name="produk" required  value="<?= $tampil['produk'] ?>"  type="text"  class="form-control" >

  <div class="input-group">
    <span class="input-group-text"  id="basic-addon3">Nama Bahan</span>
    <input name="bahan" req\uired  value="<?= $tampil['bahan'] ?>"  type="text"  class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
  </div>

  <div class="input-group">
    <span class="input-group-text"  id="basic-addon3">Harga Beli</span>
    <input name="harga" required  value="<?= $tampil['harga'] ?>" min="0" type="number" min='0' class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
  </div>
  untuk
  <div class="input-group">
    <span class="input-group-text"  id="basic-addon3">Hasil Pack</span>
    <input name="hasil_pack" required value="<?= abs($tampil['hasil_pack']) ?>" min="0" type="number" min='0' class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
  </div>
  dengan
  <div class="input-group">
    <span class="input-group-text"  id="basic-addon3">Jumlah Resep</span>
    <input name="jumlah_resep" required value="<?= abs($tampil['jumlah_resep']) ?>" min="0" type="number" min='0' class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
  </div>

  <div class="input-group">
    <span class="input-group-text"  id="basic-addon3">Satuan</span>
    <input name="satuan" required value="<?= $tampil['satuan'] ?>"  type="text" placeholder=" " class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
  </div>
  <div class="input-group">
    <span class="input-group-text"  id="basic-addon3">Stok</span>
    <input name="stok"  value="<?= $tampil['stok'] ?>"  type="text" placeholder="" class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
  </div>

    <input name="ubah" type="submit" value="Ubah"  style="width:200px;" class="btn mt-1 btn-sm btn-outline-success">

</form>
</div>

<?php 
if(isset($_POST['ubah'])){
    $produk = $_POST['produk'];
    $bahan = $_POST['bahan'];
    $stok = $_POST['stok'];
    $harga = $_POST['harga'];
    $satuan = $_POST['satuan'];
    $hasil_pack = $_POST['hasil_pack'];
    $jumlah_resep = $_POST['jumlah_resep'];

  
    $sql_ubah = $koneksilama->query("update tb_bahan set
    produk = '$produk',
    bahan = '$bahan',
    harga = '$harga',
    satuan = '$satuan',
    hasil_pack = '$hasil_pack',
    jumlah_resep = '$jumlah_resep',
    stok = '$stok'
    
    where id = '$id'
    ");


    if($sql_ubah){
    ?>
        <script type="text/javascript">
            alert("Transaksi Berhasil Diubah");
            window.location.href="?page=produksi&aksi=hpp";
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
          