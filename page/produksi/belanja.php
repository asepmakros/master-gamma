
<?php 
$id = $_GET['id'];

if(!empty($id)){
$sqlubah = $koneksilama->query("select * from tb_belanja where id = '$id'");
$tampil = $sqlubah->fetch_assoc();
}
?>
<div class=" h4 text-center text-uppercase mt-1">
<?php 
echo "Daftar <br> Belanja ".$page;

$date = date("Y-m-d");
?></div>
<div class="mb-3">
<div class="container">


 <form action="" method="post">

  <div class="input-group ">
    <span class="input-group-text"id="basic-addon3">Tanggal Belanja</span>
    <input name="tgl_belanja" type="date" 
    <?php if(empty($id)){ ?>
    value="<?= $date ?>" 
    <?php } else { ?>
    value="<?= $tampil['tgl_belanja'] ?>" 
      <?php } ?>
    class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
  </div>

  <div class="input-group">
    <!-- <span class="input-group-text "id="basic-addon3">Nama Bahan</span> -->
    <select name="nama_bahan"  class="form-select js-example-basic-single" id="">
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
    <!-- <span class="input-group-text"id="basic-addon3">Satuan</span> -->
    <select name="satuan"  class="form-select js-example-basic-single" id="">
        <option selected disabled>Pilih Satuan</option>
            <?php  
             $no=1;
             $sql_satuan = $koneksilama->query("select * from tb_bahan group by satuan");
               while ($data_satuan = $sql_satuan->fetch_assoc()){
            ?>
        <option value="<?= $data_satuan['satuan'] ?>"><?= $data_satuan['satuan'] ?></option>
               <?php } ?>
    </select>
  </div>

  <div class="input-group">
    <span class="input-group-text"  id="basic-addon3">Jumlah</span>
    <input name="jumlah" required value="<?= abs($tampil['jumlah']) ?>" min="0" type="number" min='0' class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
  </div>

  <div class="input-group">
    <span class="input-group-text"  id="basic-addon3">Harga Beli</span>
    <input name="harga_beli" required value="<?= abs($tampil['harga_beli']) ?>" min="0" type="number" min='0' class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
  </div>

  <div class="input-group">
    <span class="input-group-text"  id="basic-addon3">Satuan</span>
    <input name="satuan" required value="<?= $tampil['satuan'] ?>"  type="text" placeholder="kg / pcs / bungkus " class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
  </div>

  <div class="input-group">
    <span class="input-group-text"  id="basic-addon3">Tempat Beli</span>
    <input name="tempat_beli" required value="<?= $tampil['tempat_beli'] ?>"  type="text" placeholder="Toko X/ Pasar X" class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
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
  $tgl_belanja = $_POST['tgl_belanja'];
  $nama_bahan = $_POST['nama_bahan'];
  $harga_beli = $_POST['harga_beli'];
  $satuan = $_POST['satuan'];
  $jumlah = $_POST['jumlah'];
  $tempat_beli = $_POST['tempat_beli'];



  $sql = $koneksilama->query("insert into tb_belanja 
  (tgl_belanja, nama_bahan, harga_beli, satuan, jumlah, tempat_beli) values(
    '$tgl_belanja', '$nama_bahan', '$harga_beli', '$satuan', '$jumlah', '$tempat_beli'
    ) ");

    $sql_stok = $koneksilama->query("update tb_bahan set
    stok = stok+'$jumlah'
    where nama_bahan = '$nama_bahan'
     ");

  if($sql_stok){
  ?>
      <script type="text/javascript">
          alert("Transaksi Berhasil Ditambah");
          window.location.href="?page=produksi&aksi=belanja";
      </script>
<?php
  }
}


if(isset($_POST['ubah'])){
    $tgl_belanja = $_POST['tgl_belanja'];
    $nama_bahan = $_POST['nama_bahan'];
    $harga_beli = $_POST['harga_beli'];
    $satuan = $_POST['satuan'];
    $jumlah = $_POST['jumlah'];
    $tempat_beli = $_POST['tempat_beli'];

  
    $sql_ubah = $koneksilama->query("update tb_belanja set

    nama_bahan = '$nama_bahan',
    tgl_belanja = '$tgl_belanja',
    harga_beli = '$harga_beli',
    tempat_beli = '$tempat_beli',
    jumlah = '$jumlah',
    satuan = '$satuan'
    
    where id = '$id'
    ");

    
    $sql_stok = $koneksilama->query("update tb_bahan set
    stok = stok + '$jumlah'

    where nama_bahan = '$nama_bahan'
      ) ");

    if($sql_ubah){
    ?>
        <script type="text/javascript">
            alert("Transaksi Berhasil Diubah");
            window.location.href="?page=produksi&aksi=belanja";
        </script>
  <?php
    }
  }
  

?>

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

</div>

<div class="container">
    <h2>Tabel Stok</h2>
    <table class="table table-striped" style="line-height: 0.5;">
        <tr>
        <thead>
            <th>No</th>
            <th>Produk</th>
            <th>Stok</th>
            <th>Jumlah</th>
            <th>Harga Beli</th>
            <th>Total</th>
            <th>aksi</th>
        </thead>
        </tr>
        <?php 
        $no1 = 1;
        $sqlstok1 = $koneksilama->query("select * from tb_belanja  order by id desc");
        while($datastok1 =$sqlstok1->fetch_assoc()){
        
        $nama_bahan_stok = $datastok1['nama_bahan'];
        $sqlstokbahan = $koneksilama->query("select * from tb_bahan where nama_bahan = '$nama_bahan_stok' ");
        $datastokbahan =$sqlstokbahan->fetch_assoc();

        ?>
        <tr>
            <td><?= $no1++ ?></td>
            <td><?= $datastok1['nama_bahan'] ?></td>
            <td><?= $datastokbahan['stok'] ?></td>
            <td><?= $datastok1['jumlah']." ".$datastok1['satuan'] ?></td>
            <td><?= number_format($datastok1['harga_beli']) ?></td>
            <td><?= number_format($datastok1['harga_beli']*$datastok1['jumlah'])?></td>
            <td>
                <!-- <a href="?page=produksi&aksi=ubah_belanja&id=<?= $datastok1['id'] ?>">Edit</a> -->
                <a href="?page=produksi&aksi=hapus_belanja&id=<?= $datastok1['id'] ?>&jumlah=<?= $datastok1['jumlah'] ?>&nama_bahan=<?= $datastok1['nama_bahan'] ?>">Hapus</a>
            </td>


        </tr>
        <?php } ?>
    </table>
</div>
</div>
      </div>
      </div>
      </div>
      