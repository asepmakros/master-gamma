
<?php 
$id = $_GET['id'];

$visi_jalan = 'hidden'; 


if(!empty($id)){
$sqlubah = $koneksilama->query("select * from tb_surat where id = '$id' ");
$tampil = $sqlubah->fetch_assoc();
}
?>
<div class=" h4 text-center text-uppercase mt-1">
<?php 
echo "Daftar Surat Jalan";
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
    <span class="input-group-text"  id="basic-addon3">Judul</span>
    <input name="judul" required value="<?= $tampil['judul'] ?>"  type="text"  class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
  </div>

<?php
$sql_id = $koneksilama->query("select * from tb_surat order by id desc ");
$tampil_id = $sql_id->fetch_assoc();

$id_akhir= $tampil_id['id']+1;
?>


  <div class="input-group">
    <span class="input-group-text"  id="basic-addon3">no_surat</span>
    <input name="no_surat" required value="<?php
    if($tampil['no_surat']==''){ echo $id_akhir."/CF-SJLN/".$bln."/2023";}
    $tampil['no_surat'] ?>"  type="text"  class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
  </div>

  <div class="input-group">
    <span class="input-group-text"  id="basic-addon3">nama_pengirim</span>
    <input name="nama_pengirim" required value="<?= $tampil['nama_pengirim'] ?>"  type="text"  class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
  </div>

  <div class="input-group">
    <span class="input-group-text"  id="basic-addon3">jabatan_pengirim</span>
    <input name="jabatan_pengirim" required value="<?= $tampil['jabatan_pengirim'] ?>"  type="text"  class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
  </div>

  <div class="input-group ">
    <span class="input-group-text"id="basic-addon3">Instansi Ekspedisi</span>
    <input name="instansi_pelaksana" type="text"  value="<?= $tampil['instansi_pelaksana'] ?>" 
    class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
  </div>


  <div class="input-group ">
    <span class="input-group-text"id="basic-addon3">Jabatan Ekspedisi</span>
    <input name="jabatan_pelaksana" type="text"  value="<?= $tampil['jabatan_pelaksana'] ?>" 
    class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
  </div>
  </div>

  <div class="input-group">
    <span class="input-group-text"  id="basic-addon3">Waktu Kirim</span>
    <input name="waktu_kirim" required value="<?= $date ?>" type="date" class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
  </div>


  <div class="input-group ">
    <span class="input-group-text"id="basic-addon3">Tujuan</span>
    <input name="tujuan" type="text"  value=" (GUDANG WAHANA) Jl. Komp. Pergudangan Nusa Indah Jl. Husein Sastranegara No.37, RT.004/RW.003, Jurumudi, Kec. Benda, Kota Tangerang, Banten 15124" 
    class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
  </div>


  <div class="input-group ">
    <span class="input-group-text"id="basic-addon3">Nomor PO</span>
    <!-- <input name="nomor_po" type="text"  value="<?= $tampil['nomor_po'] ?>" 
    class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4"> -->

    <select name="nomor_po" id="" class="form-select">
        <option value="" selected disabled>Pilih Nomor PO</option>
        <?php $sql_po = $koneksilama->query("select * from tb_po order by id desc ");
            while($tampil_po = $sql_po->fetch_assoc()){ ?>
            <option value="<?= $tampil_po['nomor_po'] ?>"><?= $tampil_po['nomor_po']." (".$tampil_po['jumlah']." pack)" ?></option>
            <?php } ?>
    </select>
  </div>

  <div class="input-group ">
    <span class="input-group-text"id="basic-addon3">Jumlah Paket</span>
    <input name="jumlah" type="text"  value="<?= $tampil['jumlah'] ?>" 
    class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
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
  $judul = $_POST['judul'];
  $no_surat = $_POST['no_surat'];
  $nama_pengirim = $_POST['nama_pengirim'];
  $jabatan_pengirim = $_POST['jabatan_pengirim'];
  $instansi_pelaksana = $_POST['instansi_pelaksana'];
  $jabatan_pelaksana = $_POST['jabatan_pelaksana'];
  $tujuan = $_POST['tujuan'];
  $jumlah = $_POST['jumlah'];
  $waktu_kirim = $_POST['waktu_kirim'];

  $nomor_po = $_POST['nomor_po'];
 
  

  $sql = $koneksilama->query("insert into tb_surat 
  (
    judul,
    no_surat,
    nama_pengirim,
    jabatan_pengirim,
    instansi_pelaksana,
    jabatan_pelaksana,
    waktu_kirim,
    tujuan,
    jumlah,
    nomor_po

  ) values(
    '$judul',
    '$no_surat',
    '$nama_pengirim',
    '$jabatan_pengirim',
    '$instansi_pelaksana',
    '$jabatan_pelaksana',
    '$waktu_kirim',
    '$tujuan',
    '$jumlah',
    '$nomor_po'
    ) ");
  
  if($sql){
  ?>
      <script type="text/javascript">
          alert("Transaksi Berhasil Ditambah");
          window.location.href="?page=surat";
      </script>
<?php
  }
}


?>


<div class="container">
<hr>
<div class="row mt-3">
    <div class="col-md" style="padding-bottom: 90px;">
<label for="" class="h4">Tabel Surat</label>
<div class="table-responsive-sm">
<table class="table table-sm table-striped">
  <thead>
    <tr class="text-center">
         <th>No</th>
        <th>Data Surat</th>
        <th>Print</th>
      

    </tr>
  </thead>
  <tbody>
    <?php 
    $no1=1;
    $sqldata = $koneksilama->query("select * from tb_surat order by id desc ");
      while ($data = $sqldata->fetch_assoc()){
    ?> 
     
    <tr>
        <td><b><?php echo $no1++ ?>
        <a style="color:red; font-size: 12px;"; onclick="return confirm('Yakin akan dihapus?')" href="?page=surat&aksi=hapus&id=<?php echo $data['id'] ?>" class="material-symbols-outlined " >delete  </a>
        </td>
        <td>judul : <?= $data['judul']?>
        <br>no_surat : <?= $data['no_surat']?>
        <br>nama_pengirim : <?= $data['nama_pengirim']?>
        <br>jabatan_pengirim : <?= $data['jabatan_pengirim']?>
        <br>instansi_pelaksana : <?= $data['instansi_pelaksana']?>
        <br>jabatan_pelaksana : <?= $data['jabatan_pelaksana']?>
        <br>waktu_kirim : <?= $data['waktu_kirim']?>
        <br>tujuan : <?= $data['tujuan']?>
        <br>nomor_po : <?= $data['nomor_po']?>
        <br>jumlah : <?= $data['jumlah']?></td>
        <td><a href="?page=surat&aksi=surat_jalan&id=<?= $data['id']?>">Print</a></td>

    </tr>
    <?php  }?>
  </tbody>
</table>
</div>
</div>
</div>



</div>
      </div>
