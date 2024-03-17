
<?php 
$id = $_GET['id'];

if(!empty($id)){
$sqlubah = $koneksilama->query("select * from tb_barang where id = '$id'");
$tampil = $sqlubah->fetch_assoc();
}
?>
<div class=" h4 text-center text-uppercase">
<?php 
echo $page;
$date = date("Y-m-d");
?></div>
<div class="mb-3">

<div class="container">
 <form action="" method="post">


  <div class="input-group">
    <span class="input-group-text "  id="basic-addon3">nama_barang</span>
    <input name="nama_barang" value="<?= $tampil['nama_barang'] ?>" type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
  </div>

  <div class="input-group">
    <span class="input-group-text"  id="basic-addon3">stok</span>
    <input name="stok" value="<?= $tampil['stok'] ?>" type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
  </div>

  <div class="input-group">
    <span class="input-group-text"  id="basic-addon3">harga_beli</span>
    <input name="harga_beli" value="<?= $tampil['harga_beli'] ?>" type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
  </div>

  <div class="input-group">
    <span class="input-group-text"  id="basic-addon3">harga_jual</span>
    <input name="harga_jual" value="<?= $tampil['harga_jual'] ?>" type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
  </div>

  <div class="input-group">
    <span class="input-group-text"  id="basic-addon3">h_reseller</span>
    <input name="h_reseller" value="<?= $tampil['h_reseller'] ?>" type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
  </div>

  <div class="input-group">
    <span class="input-group-text"  id="basic-addon3">harga_ecer</span>
    <input name="harga_ecer" value="<?= $tampil['harga_ecer'] ?>" type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
  </div>

  <div class="input-group">
    <span class="input-group-text"  id="basic-addon3">profit</span>
    <input name="profit" value="<?= $tampil['profit'] ?>" type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
  </div>
  
  <div class="input-group">
    <span class="input-group-text"  id="basic-addon3">Berat</span>
    <input name="berat" value="<?= $tampil['berat'] ?>" type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
  </div>

  <?php if(empty($id)){?>

    <input name="tambah" type="submit" value="Tambah" style="width:200px;" class="btn mt-1 btn-sm btn-outline-success">

    <?php  }else { ?>

    <input name="ubah" type="submit" value="Ubah"  style="width:200px;" class="btn mt-1 btn-sm btn-outline-success">
    <?php  }?>

  </form>
</div>

<?php 
if(isset($_POST['tambah'])){
  $nama_barang = $_POST['nama_barang'];
  $stok = $_POST['stok'];
  $harga_beli = $_POST['harga_beli'];
  $harga_jual = $_POST['harga_jual'];
  $h_reseller = $_POST['h_reseller'];
  $harga_ecer = $_POST['harga_ecer'];
  $profit = $_POST['profit'];
    $berat = $_POST['berat'];

  

  $sql = $koneksilama->query("insert into tb_barang 
  (nama_barang,
  stok,
  harga_beli,
  harga_jual,
  h_reseller,
  harga_ecer,
  profit,
  berat
  ) values(
    '$nama_barang',
    '$stok',
    '$harga_beli',
    '$harga_jual',
    '$h_reseller',
    '$harga_ecer',
    '$profit',
      '$berat'
    ) ");
  

}else 

if(isset($_POST['ubah'])){
  $nama_barang = $_POST['nama_barang'];
  $stok = $_POST['stok'];
  $harga_beli = $_POST['harga_beli'];
  $harga_jual = $_POST['harga_jual'];
  $h_reseller = $_POST['h_reseller'];
  $harga_ecer = $_POST['harga_ecer'];
  $profit = $_POST['profit'];
      $berat = $_POST['berat'];


  $sqlupdate = $koneksilama->query("update tb_barang set
  nama_barang = '$nama_barang',
    stok = '$stok',
    harga_beli = '$harga_beli',
    harga_jual = '$harga_jual',
    h_reseller = '$h_reseller',
    harga_ecer = '$harga_ecer',
    profit = '$profit',
    berat= '$berat'

   where id='$id'
   ");
  
  if($sqlupdate) {
    $id = "";

      ?>
      <script type="text/javascript">
          alert("Transaksi Berhasil Diubah");
          window.location.href="?page=produk";
      </script>
<?php

  }
}


?>



<hr>
<label for="" class="h4">Tabel <?= $page ?></label>
<div class="table-responsive-sm">
<table class="table table-sm display" id="" style="line-height: 0.5;">
  <thead>
    <tr >
      <th scope="col">No</th>
      <th scope="col">Nama Barang</th>
      <th scope="col">Massa</th>
      <th scope="col">Stok</th>
      <th scope="col">harga_beli</th>
      <th scope="col">Harga Distributor</th>
      <th scope="col">Harga Reseller</th>
      <th scope="col">Harga Ecer</th>
      <th scope="col">Profit</th>
      <!-- <th scope="col">Aksi</th> -->
    </tr>
  </thead>
  <tbody>
    <?php 
    $no=1;
    $sql = $koneksilama->query("select * from tb_barang order by nama_barang asc");
      while ($data = $sql->fetch_assoc()){
    ?>  
    <tr  <?php if( $data['stok']<1){ echo "class='bg-danger text-light'";}?>>
        <td><?php echo $no++ ?></td>
        <td><?php echo $data['nama_barang'] ?></td>
        <td><?php echo $data['berat'] ?></td>
          <td><?php echo $data['stok'] ?></td>
        <td><?php echo number_format($data['harga_beli']); ?></td>
        <td><?php echo number_format($data['harga_jual']); ?></td>
        <td><?php echo number_format($data['h_reseller']) ?></td>
        <td><?php echo number_format($data['harga_ecer']) ?></td>
        <td><?php echo number_format($data['profit']) ?></td>
        <td>
          <a style="color:red"; onclick="return confirm('Yakin akan dihapus?')" href="?page=produk&aksi=hapus&id=<?php echo $data['id'] ?>" class="material-symbols-outlined" style="width:50px;">delete  </a>
          <a href="?page=produk&aksi=ubah&id=<?php echo $data['id'] ?>" class="material-symbols-outlined">edit</a>
        </td>

    </tr>
    <?php } ?>
  </tbody>
</table>
      </div>
      </div>
