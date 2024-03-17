
<?php 
$id = $_GET['id'];

if(!empty($id)){
$sqlubah = $koneksilama->query("select * from tb_surat where id = '$id'");
$tampil = $sqlubah->fetch_assoc();
}
?>
<div class=" h4 text-center text-uppercase mt-1">
<?php 
echo "Daftar Surat";
echo "<br>CV CIWIDEY FOOD";

$date = date("Y-m-d");
?></div>
<div class="mb-3">

 <form action="" method="post">
 <div class="input-group">
    <span class="input-group-text"  id="basic-addon3">Judul</span>
    <input name="judul" required value="<?= $tampil['judul'] ?>"  type="text" min='0' class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
  </div>

  <div class="input-group">
    <span class="input-group-text"  id="basic-addon3">no_masuk</span>
    <input name="no_masuk" required value="<?= $tampil['no_masuk'] ?>"  type="text" min='0' class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
  </div>

  <div class="input-group">
    <span class="input-group-text"  id="basic-addon3">no_keluar</span>
    <input name="no_keluar" required value="<?= $tampil['no_keluar'] ?>"  type="text" min='0' class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
  </div>

  <div class="input-group">
    <span class="input-group-text"  id="basic-addon3">no_invoice</span>
    <input name="no_invoice" required value="<?= $tampil['no_invoice'] ?>"  type="text" min='0' class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
  </div>

  <div class="input-group ">
    <span class="input-group-text"id="basic-addon3">Tanggal Kirim</span>
    <input name="tgl_kirim" type="date"  value="<?= $date ?>" 
    class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
  </div>

  <div class="input-group ">
    <span class="input-group-text"id="basic-addon3">Tanggal Tukar Faktur</span>
    <input name="tgl_tukar_faktur" type="date"  value="<?= $date ?>" 
    class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
  </div>

  </div>

  <div class="input-group">
    <span class="input-group-text"  id="basic-addon3">Jumlah</span>
    <input name="qty" required value="<?= $tampil['qty'] ?>" min="0" type="number" min='0' class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
  </div>

  <div class="input-group">
    <span class="input-group-text"  id="basic-addon3">satuan</span>
    <input name="satuan" required value="<?= $tampil['satuan'] ?>"  type="number" min='0' class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
  </div>

  <div class="input-group">
    <span class="input-group-text"  id="basic-addon3">total</span>
    <input name="total" required value="<?= $tampil['total'] ?>"  type="number" min='0' class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
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
  $judul = $_POST['judul'];
  $no_masuk = $_POST['no_masuk'];
  $no_keluar = $_POST['no_keluar'];
  $no_invoice = $_POST['no_invoice'];
  $tgl_kirim = $_POST['tgl_kirim'];
  $qty = $_POST['qty'];
  $satuan = $_POST['satuan'];
  $total = $_POST['total'];
  $tgl_tukar_faktur = $_POST['tgl_tukar_faktur'];  
  

  $sql = $koneksilama->query("insert into tb_surat 
  (
    judul,
    no_masuk,
    no_keluar,
    no_invoice,
    tgl_kirim,
    qty,
    satuan,
    total,
    tgl_tukar_faktur

  ) values(
    '$judul',
    '$no_masuk',
    '$no_keluar',
    '$no_invoice',
    '$tgl_kirim',
    '$qty',
    '$satuan',
    '$total',
    '$tgl_tukar_faktur',
    ) ");
  
  if($sql){
  ?>
      <script type="text/javascript">
          alert("Transaksi Berhasil Ditambah");
          window.location.href="?page=dapur_solo";
      </script>
<?php
  }
}


?>


<div class="container">
<hr>
<div class="row mt-3">
    <div class="col-md-6">
<label for="" class="h4">Tabel Surat</label>
<div class="table-responsive-sm">
<table class="table table-sm table-striped">
  <thead>
    <tr class="text-center">
      <th>No</th>
      <th>Judul</th>
      <th>No Masuk</th>
      <th>No Keluar</th>
      <th>No Invoice</th>
      <th>Tanggal Kirim</th>
      <th>Tanggal tukar Faktur</th>
      <th>Jumlah</th>
      <th>Satuan</th>
      <th>Total</th>

    </tr>
  </thead>
  <tbody>
    <?php 
    $no1=1;
    $sqldata = $koneksilama->query("select * from tb_surat   order by id desc ");
      while ($data = $sqldata->fetch_assoc()){
    ?> 
     
    <tr>
        <td><b><?php echo $no1++ ?>
        <a style="color:red; font-size: 12px;"; onclick="return confirm('Yakin akan dihapus?')" href="?page=tb_surat&aksi=hapus&id=<?php echo $data['id'] ?>&produk=<?php echo $data['produk'] ?>&jumlah=<?php echo $data['jumlah'] ?>" class="material-symbols-outlined " >delete  </a>
        </td>
        <td><?= $data['judul']?></td>
        <td><?= $data['no_masuk']?></td>
        <td><?= $data['no_keluar']?></td>
        <td><?= $data['no_invoice']?></td>
        <td><?= $data['tgl_kirim']?></td>
        <td><?= $data['tgl_tukar_faktur']?></td>
        <td><?= $data['jumlah']?></td>
        <td><?= $data['satuan']?></td>
        <td><?= $data['total']?></td>

    </tr>
    <?php  }?>
  </tbody>
</table>
</div>
</div>
</div>



</div>
      </div>
