
<?php 
$id = $_GET['id'];

if(!empty($id)){
$sqlubah = $koneksilama->query("select * from tb_akun where id = '$id'");
$tampil = $sqlubah->fetch_assoc();
}
?>

<div class="container">
<div class=" h4 text-center text-uppercase">
<?php 
echo $page;
$date = date("Y-m-d");
?></div>
<div class="mb-3">

 <form action="" method="post">


  <div class="input-group">
    <span class="input-group-text "  id="basic-addon3">Nama Akun</span>
    <input name="nama_akun" value="<?= $tampil['nama_akun'] ?>" required type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
  </div>


  <div class="input-group">
    <span class="input-group-text"  id="basic-addon3">Jenis Akun</span>
    <input name="jenis" value="<?= $tampil['jenis'] ?>" type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
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
  $nama_akun = $_POST['nama_akun'];
  $jenis = $_POST['jenis'];


  $sql = $koneksilama->query("insert into tb_akun 
  (nama_akun, jenis) values(
   '$nama_akun', '$jenis'
    ) ");
  

}else 

if(isset($_POST['ubah'])){
  $nama_akun = $_POST['nama_akun'];
  $jenis = $_POST['jenis'];

  $sqlupdate = $koneksilama->query("update tb_akun set
  nama_akun='$nama_akun',
   jenis='$jenis'


   where id='$id'
   ");
  
  if($sqlupdate) {
    $id = "";

      ?>
      <script type="text/javascript">
          alert("Transaksi Berhasil Diubah");
          window.location.href="?page=akun";
      </script>
<?php

  }
}


?>



<hr>
<label for="" class="h4">Tabel Daftar Akun</label>
<div class="table-responsive-sm">
<table class="table table-sm table-striped" id="">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Nama Akun</th>
      <th scope="col">Jenis Akun</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    $no=1;
    $sql = $koneksilama->query("select * from tb_akun order by id ASC");
      while ($data = $sql->fetch_assoc()){
    ?>  
    <tr>
        <td><?php echo $no++ ?></td>
        <td><?php echo $data['nama_akun'] ?></td>
        <td><?php echo $data['jenis'] ?></td>
       
        <td>
          <a style="color:red"; onclick="return confirm('Yakin akan dihapus?')" href="?page=akun&aksi=hapus&id=<?php echo $data['id'] ?>" class="material-symbols-outlined" style="width:50px;">delete  </a>
          <a href="?page=akun&aksi=ubah&id=<?php echo $data['id'] ?>" class="material-symbols-outlined">edit</a>
        </td>

    </tr>
    <?php } ?>
  </tbody>
</table>
      </div>
      </div>