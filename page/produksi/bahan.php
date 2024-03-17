
<?php 
$id = $_GET['id'];
$bahan = $_GET['bahan'];

if(!empty($id)){
$sqlubah = $koneksilama->query("select * from tb_bahan where id = '$id'");
$tampil = $sqlubah->fetch_assoc();
}
?>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>


<div class=" h4 text-center text-uppercase mt-1">
<?php 
echo "Daftar Stok <br> Bahan ".$page;

$date = date("Y-m-d");
?></div>
<div class="mb-3">

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<style>
    .my-custom-scrollbar {
position: relative;
height: 700px;
overflow: auto;
}
.table-wrapper-scroll-y {
display: block;
}
</style>

<hr>
<div class="container">
        
    <form action="" method="post">

    <div class="input-group">
    <select name="bahan"  class="form-select js-example-basic-single" id="">
        <option selected disabled>Pilih Bahan</option>
            <?php  
            $no=1;
            $sql_produk = $koneksilama->query("select * from tb_bahan group by bahan");
                while ($data_produk = $sql_produk->fetch_assoc()){
            ?>
        <option value="<?= $data_produk['bahan'] ?>"><?= $data_produk['bahan'] ?></option>
                <?php } ?>
    </select>
    </div>

    <?php
$date = date("Y-m-d");
    ?>

    <div class="input-group">
    <span class="input-group-text"  id="basic-addon3">Tanggal</span>
    <input name="tanggal" required value="<?= $date ?>"  type="date" min='0' class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
    </div>
    <div class="input-group">
    <span class="input-group-text"  id="basic-addon3">masuk</span>
    <input name="masuk" required value="<?= abs($tampil['masuk']) ?>"  type="number" min='0' class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
    </div>
    <div class="input-group">
    <span class="input-group-text"  id="basic-addon3">keluar</span>
    <input name="keluar" required value="<?= abs($tampil['keluar']) ?>"  type="number" min='0' class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
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
  $bahan = $_POST['bahan'];
  $masuk = $_POST['masuk'];
  $keluar = $_POST['keluar'];
  $tanggal = $_POST['tanggal'];

  $sql = $koneksilama->query("insert into tb_bahan_update 
  (
  bahan,
  tanggal,
  masuk,
  keluar
  )values(
    '$bahan',
    '$tanggal',
    '$masuk',
     '$keluar'
    ) ");

  if($sql){
  ?>
      <script type="text/javascript">
          alert("Bahan Berhasil Ditambah");
          window.location.href="?page=produksi&aksi=bahan&veri=produksi";
      </script>
<?php
  }
}


  

?>

<div class="container">
    <div class="row">
        <div class="col-md-6">
                <h5>Update Bahan Harian</h5>

              <table id="myTable" class="table table-sm table-striped display" style="line-height: 0.5;">
                <thead>
        <tr>
                <th>No</th>
                <th>Tgl</th>
                <th>Bahan</th>
                <th>Masuk</th>
                <th>Keluar</th>
                <th>aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php 
        $no1 = 1;
        $sqlstok1 = $koneksilama->query("select * from tb_bahan_update  order by id desc");
        while($datastok1 =$sqlstok1->fetch_assoc()){
        ?>
        <tr>
            <td><?= $no1++ ?></td>
            <td><?= $datastok1['tanggal'] ?> </td>
            <td><?= $datastok1['bahan'] ?> </td>
                <?php
      $bah1 = $datastok1['bahan'];
        $sqlsatuan1 = $koneksilama->query("select * from tb_bahan where bahan= '$bah1'");
        $datasatuan1 =$sqlsatuan1->fetch_assoc();
        
        ?>
            <td><?php 
            if($datastok1['masuk'] ){
            echo $datastok1['masuk']." "; 
            echo $datasatuan1['satuan'];
            }?>
       
        </td>
        <td>
            <?php
             if($datastok1['keluar'] ){
            echo $datastok1['keluar']." "; 
            echo $datasatuan1['satuan'];

            }?>
           <?php
        
        ?>
        </td>
          
            <td>
                <a class="btn btn-sm btn-danger" href="?page=produksi&aksi=hapus_update_bahan&id=<?= $datastok1['id'] ?>&bahan=<?= $datastok1['bahan'] ?>">Hapus</a>
                <!-- <a href="?page=produksi&aksi=hapus_bahan&id=<?= $datastok1['id'] ?>">Hapus</a> -->
            </td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
        </div>




        <div class="col-md-6">
            <h5>Daftar Sok Bahan</h5>
              <table id="myTable2" class="table table-sm table-striped display" style="line-height: 0.5;">
                <thead>
        <tr>
                <th>No</th>
                <th>Bahan</th>
                <th>Stok</th>
                
            </tr>
        </thead>
        <tbody>
        <?php 
        $no1 = 1;
        $sqlstok2 = $koneksilama->query("select *, sum(masuk) as jumlah_masuk, sum(keluar) as jumlah_keluar from tb_bahan_update group by bahan order by stok desc");
        while($datastok2 =$sqlstok2->fetch_assoc()){
        ?>
        <tr>
            <td><?= $no1++ ?></td>
            <td><?= $datastok2['bahan'] ?> </td>
            <td><?= $datastok2['jumlah_masuk']-$datastok2['jumlah_keluar']." "?>
        <?php
        $bah = $datastok2['bahan'];
        $sqlsatuan = $koneksilama->query("select * from tb_bahan where bahan= '$bah'");
        $datasatuan =$sqlsatuan->fetch_assoc();
        echo $datasatuan['satuan'];
        ?>
        </td>
          
          
       
        </tr>
        <?php } ?>
        </tbody>
    </table>
        </div>
    </div>
          
</div>
</div>
      </div>
      </div>
      </div>
            <script>
        $('#myTable').DataTable();
        $('#myTable2').DataTable();
        </script>