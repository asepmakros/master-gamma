
<?php 
$id = $_GET['id'];
session_start();


if(!empty($id)){
$sqlubah = $koneksilama->query("select * from tb_nota where id = '$id'");
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

  <div class="input-group ">
    <span class="input-group-text" id="basic-addon3">tgl</span>
    <input name="tgl" type="date" 
    <?php if(empty($id)){ ?>
    value="<?= $date ?>" 
    <?php } else { ?>
    value="<?= $tampil['tgl'] ?>" 
      <?php } ?>
    class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
  </div>

  <div class="input-group">
    <span class="input-group-text" id="basic-addon3">Kebutuhan</span>
    <input name="kebutuhan" value="<?= $tampil['kebutuhan'] ?>" required type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
  </div>

  <div class="input-group">
    <span class="input-group-text" id="basic-addon3">Sumber Dana</span>
    <select required name="sumber" id="" class="form-control">
        <option value="" selected disabled>Pilih Sumber</option>
        <?php 
         $sql_sumber = $koneksilama->query("select * from tb_akun order by jenis");
         while ($data_sumber = $sql_sumber->fetch_assoc()){
        ?>
        <option value="<?= $data_sumber['nama_akun']?>"><?= $data_sumber['nama_akun']?></option>
        <?php 
         }
        ?>
    </select>
  </div>

  

  <div class="input-group">
    <span class="input-group-text" id="basic-addon3">jumlah</span>
    <input name="jumlah" value="<?= $tampil['jumlah'] ?>" type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
  </div>

  <div class="input-group">
    <span class="input-group-text" id="basic-addon3">pengaju</span>
    <input name="pengaju" value="<?= $tampil['pengaju'] ?>" type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
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
  $tgl = $_POST['tgl'];
  $kebutuhan = $_POST['kebutuhan'];
  $jumlah = $_POST['jumlah'];
  $pengaju = $_POST['pengaju'];
  $sumber = $_POST['sumber'];

  $sql = $koneksilama->query("insert into tb_nota 
  (tgl, kebutuhan,  jumlah, pengaju, sumber) values(
    '$tgl', '$kebutuhan', '$jumlah', '$pengaju', '$sumber'
    ) ");
  
//   if($sql) {
//       ?>
//       <script type="text/javascript">
//           alert("kebutuhan Berhasil Disimpan");
//           window.location.href="?page=nota";
//       </script>
// <?php

//   }
}else 

if(isset($_POST['ubah'])){
  $tgl = $_POST['tgl'];
  $kebutuhan = $_POST['kebutuhan'];
  $jumlah = $_POST['jumlah'];
  $pengaju = $_POST['pengaju'];
  $sumber = $_POST['sumber'];

  $sqlupdate = $koneksilama->query("update tb_nota set
  tgl='$tgl',
   kebutuhan='$kebutuhan',
   jumlah='$jumlah',
   sumber='$sumber',
   pengaju='$pengaju' 

   where id='$id'
   ");
  
  if($sqlupdate) {
    $id = "";

      ?>
      <script type="text/javascript">
          alert("kebutuhan Berhasil Diubah");
          window.location.href="?page=nota";
      </script>
<?php

  }
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
      <th scope="col">kebutuhan</th>
      <th scope="col">Sumber</th>
      <th scope="col">Jumlah</th>
      <th scope="col">Pengaju </th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    $no=1;
    $sql = $koneksilama->query("select * from tb_nota order by id desc limit 200");
      while ($data = $sql->fetch_assoc()){
    ?>  
    <tr>
        <td><?php echo $no++ ?></td>
        <td><?php echo $data['tgl'] ?></td>
        <td><?php echo $data['kebutuhan'] ?></td>
        <td><?php echo $data['sumber'] ?></td>
        <td><?php echo number_format($data['jumlah']); ?></td>
        <td><?php echo $data['pengaju'] ?></td>
        <td>
          <a style="color:red"; onclick="return confirm('Yakin akan dihapus?')" href="?page=nota&aksi=hapus&id=<?php echo $data['id'] ?>" class="material-symbols-outlined" style="width:50px;">delete  </a>
          <a href="?page=nota&aksi=ubah&id=<?php echo $data['id'] ?>" class="material-symbols-outlined">edit</a>
          <a name="validate-button" style="color:green"; href="?page=nota&aksi=print&id=<?php echo $data['id'] ?>" class="material-symbols-outlined" >Print</a>

        </td>

        <?php

$date = pow(date('H'),3);
$date1 = date('d')*3;


 $pinn = $date+$date1;


    ?>

<input type="text" hidden value="<?= $pinn ?>" id="pinn">    
    <script>
                    const pinno = document.getElementById("pinn").value;

        function pin(){
            let pin = prompt("Please enter PIN", "");

        if (pin == null) {
            alert ("Kode tak Boleh Kosaong!");
        } else 
        if(pin == pinno){
            window.location.href="?page=nota&aksi=print&id=<?php echo $data['id'] ?>";
        }else{
            alert ("Kode Salah!");
        }
    }
    </script>

    </tr>
    <?php } ?>
  </tbody>
</table>
      </div>
      </div>




