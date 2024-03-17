
<?php 
$id = $_GET['id'];
$produk = $_GET['produk'];


$sqltambah = $koneksilama->query("select * from tb_bahan where id = '$id'");
$tampil = $sqltambah->fetch_assoc();

?>

<div class=" h4 text-center text-uppercase mt-1">
<?php 
echo "tambah Bahan <br> ".$produk;

$date = date("Y-m-d");
?></div>
<div class="mb-3">
<div class="container">

 <form action="" method="post">

    <input name="produk" required hidden value="<?= $produk ?>" type="text"  class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
  <!-- <div class="input-group">
    <span class="input-group-text"  id="basic-addon3">Nama Bahan</span>
    <input name="bahan" required   type="text"  class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
  </div> -->

  <div class="input-group">
    <!-- <span class="input-group-text "id="basic-addon3">Nama Bahan</span> -->
    <select name="bahan"  class="form-select js-example-basic-single" id="">
        <option selected disabled>Pilih Bahan</option>
            <?php  
            $no=1;
            $sqlproduk = $koneksilama->query("select * from tb_bahan ");
                while ($dataproduk = $sqlproduk->fetch_assoc()){
            ?>
        <option value="<?= $dataproduk['bahan'] ?>"><?= $dataproduk['bahan'] ?></option>
                <?php } ?>
    </select>
    </div>

  <div class="input-group">
    <span class="input-group-text"  id="basic-addon3">Harga Beli</span>
    <input name="harga" required   min="0" type="number" min='0' class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
  </div>
  untuk
  <div class="input-group">
    <span class="input-group-text"  id="basic-addon3">Hasil Pack</span>
    <input name="hasil_pack" required   min="0" type="number" min='0' class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
  </div>
  dengan
  <div class="input-group">
    <span class="input-group-text"  id="basic-addon3">Jumlah Resep</span>
    <input name="jumlah_resep" required   min="0" type="number" min='0' class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
  </div>

  <div class="input-group">
    <span class="input-group-text"  id="basic-addon3">Satuan</span>
    <input name="satuan" required   type="text" placeholder=" " class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
  </div>
  <div class="input-group">
    <span class="input-group-text"  id="basic-addon3">Stok</span>
    <input name="stok"    type="text" placeholder="" class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
  </div>

    <input name="tambah" type="submit" value="tambah"  style="width:200px;" class="btn mt-1 btn-sm btn-outline-success">

</form>
</div>

<?php 
if(isset($_POST['tambah'])){
    $produk = $_POST['produk'];
    $bahan = $_POST['bahan'];
    $stok = $_POST['stok'];
    $harga = $_POST['harga'];
    $satuan = $_POST['satuan'];
    $hasil_pack = $_POST['hasil_pack'];
    $jumlah_resep = $_POST['jumlah_resep'];

  
    $sql_tambah = $koneksilama->query("insert into tb_bahan 

    (produk, bahan, harga, satuan, hasil_pack, jumlah_resep, stok)
    values
    ('$produk','$bahan','$harga','$satuan','$hasil_pack','$jumlah_resep','$stok')
    ");


    if($sql_tambah){
    ?>
        <script type="text/javascript">
            alert("Transaksi Berhasil Ditambah");
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
          