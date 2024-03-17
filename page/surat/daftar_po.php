
<?php 
$id = $_GET['id'];

if(!empty($id)){
$sqlubah = $koneksilama->query("select * from tb_po where id = '$id' ");
$tampil = $sqlubah->fetch_assoc();
}
?>
<div class=" h4 text-center text-uppercase mt-1">
<?php 
echo "Daftar Purchase Order Dapur Solo";
echo "<br>CV CIWIDEY FOOD";

$date = date("Y-m-d");
?></div>
<div class="container">
<div class="mb-3">

<?php
$array_bln = array(1=>"I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");

$bln = $array_bln[date('n')];
?>
 <form action="" method="post">

 <div class="input-group">
    <span class="input-group-text"  id="basic-addon3">Nomor PO</span>
    <input name="nomor_po" required value="<?= $tampil['nomor_po'] ?>"  type="text" min='0' class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
  </div>

<?php
$sql_id = $koneksilama->query("select * from tb_po order by id desc ");
$tampil_id = $sql_id->fetch_assoc();

$id_akhir= $tampil_id['id']+1;
?>

<div class="input-group ">
    <span class="input-group-text"id="basic-addon3">Jumlah PO</span>
    <input name="jumlah" type="text"  value="<?= $tampil['jumlah'] ?>" 
    class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
  </div>


  <div class="input-group">
    <span class="input-group-text"  id="basic-addon3">Nomor Invoice</span>
    <input name="no_invoice" required value="<?php
    if($tampil['no_invoice']==''){ echo $id_akhir."/CF-INV.DS/".$bln."/2024";}
    $tampil['no_invoice'] ?>"  type="text" min='0' class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
  </div>





  <div class="input-group">
    <span class="input-group-text"  id="basic-addon3">Tanggal Kirim</span>
    <input name="tgl_kirim" required value="<?= $date ?>" type="date" class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
  </div>
  

  <div class="input-group">
    <span class="input-group-text"  id="basic-addon3">Tanggal Tukar Faktur</span>
    <input name="tgl_tukar_faktur" required value="<?= date('Y-m-d', strtotime('+2 days')) ?>" type="date" class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
  </div>

<div class="input-group">
  <span class="input-group-text"  id="basic-addon3">Tanggal Pembayaran</span>
  <input name="tgl_pembayaran" required value="<?= date('Y-m-d', strtotime('+7 days')) ?>" type="date" class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
</div>




  <?php if(empty($id)){?>

    <input name="tambah" type="submit" value="Tambah" style="width:200px;" class="btn mt-1 btn-sm btn-outline-success">

    <?php  }else { ?>

    <input name="ubah" type="submit" value="Ubah"  style="width:200px;" class="btn mt-1 btn-sm btn-outline-success">
    <?php  }?>

  </form>
</div>
</div>

<?php 
if(isset($_POST['tambah'])){
    $nomor_po = $_POST['nomor_po'];
  $no_invoice = $_POST['no_invoice'];
  $jumlah = $_POST['jumlah'];
  $tgl_kirim = $_POST['tgl_kirim'];
  $tgl_tukar_faktur = $_POST['tgl_tukar_faktur'];
  $tgl_pembayaran = $_POST['tgl_pembayaran'];
 
  

  $sql = $koneksilama->query("insert into tb_po 
  (
    nomor_po,
    no_invoice,
    tgl_kirim,
    tgl_tukar_faktur,
    tgl_pembayaran,
    jumlah
  ) values(
    '$nomor_po',
    '$no_invoice',
    '$tgl_kirim',
    '$tgl_tukar_faktur',
    '$tgl_pembayaran',
    '$jumlah'
    ) ");
  
  if($sql){
  ?>
      <script type="text/javascript">
          alert("Transaksi Berhasil Ditambah");
          window.location.href="?page=surat&aksi=daftar_po";
      </script>
<?php
  }
}


?>


<div class="container">
<hr>
<div class="row mt-3">
    <div class="col-md" style="padding-bottom: 90px;">
<label for="" class="h4">Tabel Daftar PO</label>
<div class="table-responsive-sm">
<table class="table table-sm table-striped">
  <thead>
    <tr class="text-center">
         <th>No</th>
        <th>Data PO</th>
        <!-- <th>Print</th> -->
    </tr>
  </thead>
  <tbody>
    <?php 
    $no1=1;
    $sqldata = $koneksilama->query("select * from tb_po order by id desc ");
      while ($data = $sqldata->fetch_assoc()){
    ?> 
     
    <tr>
        <td><b><?php echo $no1++ ?>
        <a style="color:red; font-size: 12px;"; onclick="return confirm('Yakin akan dihapus?')" href="?page=surat&aksi=hapus_po&id=<?php echo $data['id'] ?>" class="material-symbols-outlined " >delete  </a>
        </td>
        <td>nomor_po : <?= $data['nomor_po']?>
        <br>no_invoice : <?= $data['no_invoice']?>
        <br>jumlah : <?= $data['jumlah']?>
        <br>tgl_kirim : <?= $data['tgl_kirim']?>
        <br>tgl_tukar : <?= $data['tgl_tukar_faktur']?>
        <br>tgl_pembayaran : <?= $data['tgl_pembayaran']?>
       </td>
        <!-- <td><a href="?page=surat&aksi=daftar_po&id=<?= $data['id']?>">Print</a></td> -->

    </tr>
    <?php  }?>
  </tbody>
</table>
</div>
</div>
</div>



</div>
      </div>
