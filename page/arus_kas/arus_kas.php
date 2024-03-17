
<?php 
$id = $_GET['id'];

session_start();


if(!empty($id)){
$sqlubah = $koneksilama->query("select * from tb_arus_kas where id = '$id'");
$tampil = $sqlubah->fetch_assoc();
}
?>
        <script>
        $('#myTable').DataTable();
        </script>

<div class="container">
<div class=" h4 text-center text-uppercase">
<?php 
echo $page;
$date = date("Y-m-d");
?></div>
<div class="mb-3">

 <form action="" method="post">

  <div class="input-group ">
    <span class="input-group-text" style="width: 10%;" id="basic-addon3">Tanggal</span>
    <input name="tanggal" type="date" 
    <?php if(empty($id)){ ?>
    value="<?= $date ?>" 
    <?php } else { ?>
    value="<?= $tampil['tanggal'] ?>" 
      <?php } ?>
    class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
  </div>

  <div class="input-group">
    <span class="input-group-text" style="width: 10%;" id="basic-addon3">Transaksi</span>
    <input name="transaksi" value="<?= $tampil['transaksi'] ?>" required type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
  </div>

  <div class="input-group">
    <span class="input-group-text" style="width: 10%;" id="basic-addon3">Sumber Dana</span>
    <select name="sumber"  class="form-select" id="">
        <option 
        <?php if(!empty($id)){ ?>
            value="<?= $tampil['sumber'];?>"
   
          <?php }else { ?>
            value=""
            
            <?php echo "selected disabled";}?>
         >
          <?php if(!empty($id)){
            echo $tampil['sumber'];
            }else{
              echo "Pilih Sumber Dana";
            } ?>
            </option>

        <?php 
        $sqlakun = $koneksilama->query("select * from tb_akun");
        while ($dataakun = $sqlakun->fetch_assoc()){ ?>
        <option value="<?= $dataakun['nama_akun'] ?>"><?= $dataakun['nama_akun'] ?></option>
        <?php } ?>
    </select>
  </div>

  <div class="input-group">
    <span class="input-group-text" style="width: 10%;" id="basic-addon3">Jenis Transaksi</span>
    <select required name="jenis"  class="form-select" id="">
       <option value="" selected disabled>Pilih Jenis Transaksi</option>
       <option value="Pendapatan">Pendapatan</option>
       <option value="Operasional Rutin">Operasional Rutin</option>
       <option value="Operasional Non-Rutin">Operasional Non-Rutin</option>
       <option value="Operasional Transaksional">Operasional Transaksional</option>
       <option value="Operasional Pengiriman">Operasional Pengiriman</option>
       <option value="Prive">Prive</option>
    </select>
  </div>

  <div class="input-group">
    <span class="input-group-text" style="width: 10%;" id="basic-addon3">Masuk</span>
    <input name="masuk" value="<?= $tampil['masuk'] ?>" type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
  </div>

  <div class="input-group">
    <span class="input-group-text" style="width: 10%;" id="basic-addon3">Keluar</span>
    <input name="keluar" value="<?= $tampil['keluar'] ?>" type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
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
  $tanggal = $_POST['tanggal'];
  $transaksi = $_POST['transaksi'];
  $sumber = $_POST['sumber'];
  $masuk = $_POST['masuk'];
  $keluar = $_POST['keluar'];
  $jenis = $_POST['jenis'];

  $sql = $koneksilama->query("insert into tb_arus_kas 
  (tanggal, transaksi, sumber, masuk, keluar, jenis) values(
    '$tanggal', '$transaksi', '$sumber', '$masuk', '$keluar', '$jenis'
    ) ");
  
//   if($sql) {
//       ?>
//       <script type="text/javascript">
//           alert("Transaksi Berhasil Disimpan");
//           window.location.href="?page=arus_kas";
//       </script>
// <?php

//   }
}else 

if(isset($_POST['ubah'])){
  $tanggal = $_POST['tanggal'];
  $transaksi = $_POST['transaksi'];
  $sumber = $_POST['sumber'];
  $masuk = $_POST['masuk'];
  $keluar = $_POST['keluar'];
  $jenis = $_POST['jenis'];

  $sqlupdate = $koneksilama->query("update tb_arus_kas set
  tanggal='$tanggal',
   transaksi='$transaksi',
   sumber='$sumber',
   masuk='$masuk',
   jenis='$jenis',
   keluar='$keluar' 

   where id='$id'
   ");
  
  if($sqlupdate) {
    $id = "";

      ?>
      <script type="text/javascript">
          alert("Transaksi Berhasil Diubah");
          window.location.href="?page=arus_kas";
      </script>
<?php

  }
}


?>
<div class="card">
<form action="" method="post" class="mt-2 mb-2 ms-2 me-2">
  <div class="input-group">
    <span>Tanggal Awal :  </span>
    <input type="date" name="tanggal_awal" class="form-control" value="<?= date('Y-m-d')?>">
  </div>
  <div class="input-group">
    <span>Tanggal Akhir :  </span>
  <input type="date" name="tanggal_akhir" class="form-control" value="<?= date('Y-m-d')?>">
  </div>
  <div class="input-group">
  <input type="submit" name="lihat" value="Lihat" class="btn btn-sm btn-primary form-control mt-2">
  <input type="submit" name="lihat_semua" value="Lihat Semua" class="btn btn-sm btn-outline-primary form-control mt-2">
  </div>
</form>
</div>
<?php 
  if(isset($_POST['lihat'])){
    $tanggal_awal =$_POST['tanggal_awal'];
    $tanggal_akhir =$_POST['tanggal_akhir'];
    $sql = $koneksilama->query("select * from tb_arus_kas where tanggal between '$tanggal_awal' and '$tanggal_akhir' order by id desc ");
  } else if(isset($_POST['lihat_semua'])){
    $sql = $koneksilama->query("select * from tb_arus_kas order by id desc ");
  }
  else {
    $sql = $koneksilama->query("select * from tb_arus_kas order by id desc LIMIT 100");
  }
?>

<hr>
<label for="" class="h4">Tabel Arus kas keuangan</label>
<div class="table-responsive-sm">
<table class="display" id="myTable">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Tanggal</th>
      <th scope="col" style="max-width: 150px;">Transaksi</th>
      <th scope="col">Sumber Dana</th>
      <th scope="col">Jenis</th>
      <th scope="col">Jumlah Masuk</th>
      <th scope="col">Jumlah Keluar</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    $no=1;
      while ($data = $sql->fetch_assoc()){
    ?>  
    <tr>
        <td><?php echo $no++ ?></td>
        <td><?php echo $data['tanggal'] ?></td>
        <td><?php echo $data['transaksi'] ?></td>
        <td><?php echo $data['sumber'] ?></td>
        <td><?php echo $data['jenis'] ?></td>
        <td><?php echo number_format($data['masuk']); ?></td>
        <td><?php echo number_format($data['keluar']) ?></td>
        <td>
          <a style="color:red"; onclick="return confirm('Yakin akan dihapus?')" href="?page=arus_kas&aksi=hapus&id=<?php echo $data['id'] ?>" class="material-symbols-outlined" style="width:50px;">delete  </a>
          <a href="?page=arus_kas&aksi=ubah&id=<?php echo $data['id'] ?>" class="material-symbols-outlined">edit</a>
        </td>

    </tr>
    <?php } ?>
  </tbody>
</table>
      </div>
      </div>

      
