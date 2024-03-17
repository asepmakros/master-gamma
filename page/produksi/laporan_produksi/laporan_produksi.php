
<?php 
$id = $_GET['id'];

if(!empty($id)){
$sqlubah = $koneksilama->query("select * from tb_laporan_produksi where id = '$id'");
$tampil = $sqlubah->fetch_assoc();
}

function hari_ini(){
 $hari = date ("D");
 
 switch($hari){
 case 'Sun':
 $hari_ini = "Minggu";
 break;
 
 case 'Mon': 
 $hari_ini = "Senin";
 break;
 
 case 'Tue':
 $hari_ini = "Selasa";
 break;
 
 case 'Wed':
 $hari_ini = "Rabu";
 break;
 
 case 'Thu':
 $hari_ini = "Kamis";
 break;
 
 case 'Fri':
 $hari_ini = "Jumat";
 break;
 
 case 'Sat':
 $hari_ini = "Sabtu";
 break;
 
 default:
 $hari_ini = "Tidak di ketahui"; 
 break;
 }
 
 return  $hari_ini ;
 
}
 
?>
<div class=" h4 text-center text-uppercase mt-1">
<?php 
echo "LAPORAN HARIAN ".$page;
// echo "<br>Keluar Masuk Stok";

$date = date("Y-m-d");
?></div>
<div class="alert alert-success">Diisi oleh Arul atau Acep Setelah selesai Produksi</div>


<div class="mb-3 mt-3">
<div class="container">
 <form action="" method="post">

  <div class="input-group ">
    <span class="input-group-text"id="basic-addon3">Tanggal</span>
    <input name="tanggal" type="date" 
    <?php if(empty($id)){ ?>
    value="<?= $date ?>" 
    <?php } else { ?>
    value="<?= $tampil['tanggal'] ?>" 
      <?php } ?>
    class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
  </div>

  <div class="input-group">
    <span class="input-group-text"id="basic-addon3">Produk</span>
    <select name="produk"  class="form-select" id="">
        <option 
        <?php if(!empty($id)){ ?>
            value="<?= $tampil['produk'];?>"
   
          <?php }else { ?>
            value=""
            echo "selected disabled";
            <?php }?>
         >
          <?php if(!empty($id)){
            echo $tampil['produk'];
            }else{
              echo "Pilih Produk";
            } ?>
            </option>
            
            <?php  
             $no=1;
             $sqlproduk = $koneksilama->query("select * from tb_barang where nama_barang != ' Ongkir' and nama_barang not like '%z%' order by nama_barang asc");
               while ($dataproduk = $sqlproduk->fetch_assoc()){
            ?>
        <option value="<?= $dataproduk['nama_barang'] ?>"><?= $dataproduk['nama_barang'] ?></option>
               <?php } ?>
    </select>
  </div>

  <div class="input-group">
    <span class="input-group-text"  id="basic-addon3">Jumlah</span>
    <input name="jumlah" required value="<?= abs($tampil['jumlah']) ?>" min="0" type="number" min='0' class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
  </div>

  <div class="input-group">
    <span class="input-group-text"  id="basic-addon3">Keterangan</span>
    <!-- <select name="keluar_masuk" class="form-select" style="max-width: fit-content;" id="">
        <option value="" selected disabled>Keterangan</option>
        <option value="Stok Masuk">Stok Masuk</option>
        <option value="Stok Keluar">Stok Keluar</option>
    </select> -->
    <input name="keterangan" placeholder="Isi Keterangan" required value="<?= explode("-",$tampil['keterangan'])[1] ;?>" min="0" type="text" class="form-control text-center" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
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
  $produk = $_POST['produk'];
//   if($_POST['keluar_masuk']=='Stok Masuk'){
    $jumlah = $_POST['jumlah'];
//   }else {
//     $jumlah = -$_POST['jumlah'];
//   }
  
  $keterangan = $_POST['keterangan'];

  

  $sql = $koneksilama->query("insert into tb_laporan_produksi 
  (tanggal, produk, jumlah, keterangan) values(
    '$tanggal', '$produk', '$jumlah', '$keterangan'
    ) ");
  $sqltambah = $koneksilama->query("update tb_barang set 
  stok = stok+'$jumlah'
  where nama_barang = '$produk'
  ");
  if($sqltambah){
  ?>
      <script type="text/javascript">
          alert("Transaksi Berhasil Ditambah");
          window.location.href="?page=produksi&aksi=laporan_produksi&veri=produksi";
      </script>
<?php
  }
}


if(isset($_POST['ubah'])){
    $tanggal = $_POST['tanggal'];
    $produk = $_POST['produk'];
    if($_POST['keluar_masuk']=='Stok Masuk'){
      $jumlah = $_POST['jumlah'];
    }else {
      $jumlah = -$_POST['jumlah'];
    }
    
    $keterangan = $_POST['keterangan'];
  
    
  
    $sql_ubah = $koneksilama->query("update tb_laporan_produksi set

    produk = '$produk',
    jumlah = '$jumlah',
    keterangan = '$keterangan'
    
    where id = '$id'
    ");

    $sqlubah = $koneksilama->query("update tb_barang set 
    stok = stok+'$jumlah'
    where nama_barang = '$produk'");
    
    if($sql_ubah){
    ?>
        <script type="text/javascript">
            alert("Transaksi Berhasil Diubah");
            window.location.href="?page=produksi&aksi=laporan_produksi&veri=produksi";
        </script>
  <?php
    }
  }
  

?>

<style>
    .my-custom-scrollbar {
position: relative;
height: 1000px;
overflow: auto;
}
.table-wrapper-scroll-y {
display: block;
}
</style>

<hr>
<div class="row mt-3">
    <div class="col-md-6">
        
<label for="" class="h4">Tabel Laporan Produksi Harian</label>
<br>

<div class="table-responsive-sm">
<div class="table-wrapper-scroll-y my-custom-scrollbar">
<table class="table table-sm table-bordered">
  <thead>
    <tr class="bg-dark text-white text-center">
        <th>#</th>
        <th>Tgl</th>
        <th>Produk</th>
        <th>Jumlah</th>
        <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    $no1=1;
    $sqldata = $koneksilama->query("select * from tb_laporan_produksi order by id desc limit 100");
      while ($data = $sqldata->fetch_assoc()){
    ?> 
     
    <tr
    <?php
    if($data['jumlah']<1){
        ?>
        class="bg-danger text-white"
        <?php
    }
    ?>
    >
        <td><?= $no++ ?></td>
        <td><?= hari_ini()."<br>".date('d-M',strtotime($data['tanggal'])) ?></td>
        <td><?= $data['produk']."<br>(".$data['keterangan'].")" ?></td>
        <td><?= $data['jumlah'] ?></td>
        <td class="bg-white">
             <a style="color:red; font-size: px;"; onclick="return confirm('Yakin akan dihapus?')" href="?page=produksi&aksi=hapus_laporan_produksi&id=<?php echo $data['id'] ?>&produk=<?php echo $data['produk'] ?>&jumlah=<?php echo $data['jumlah'] ?>" class="material-symbols-outlined " >delete  </a>

            <!-- <a href="?page=produksi&aksi=ubah_laporan_produksi&id=<?php echo $data['id'] ?>&produk=<?php echo $data['produk'] ?>&jumlah=<?php echo $data['jumlah'] ?>" style="color:blue; font-size: px;" class="material-symbols-outlined">edit</a> -->
        </td>
       


    </tr>
    <?php  }?>
  </tbody>
</table>
</div>
</div>
</div>
<!-- 
<div class="col-6">
    <h2>Tabel Stok</h2>
    <table class="table table-striped" style="line-height: 0.5;">
        <tr>
        <thead>
            <th>No</th>
            <th>Produk</th>
            <th>Jumlah</th>
        </thead>
        </tr>
        <?php 
        $no1 = 1;
        $sqlstok1 = $koneksilama->query("select * from tb_barang where nama_barang != ' Ongkir' and  nama_barang != 'Z-DISKON' and  nama_barang != 'Paket 4 Varian' and  nama_barang != 'Paket Bandeng Group'  order by nama_barang asc");
        while($datastok1 =$sqlstok1->fetch_assoc()){
        ?>
        <tr <?php if( $datastok1['stok']<1){ echo "class='bg-danger text-light'";}?>>
            <td><?= $no1++ ?></td>
            <td><?= $datastok1['nama_barang'] ?></td>
            <td><?= $datastok1['stok'] ?></td>


        </tr>
        <?php } ?>
    </table>
</div> -->
</div>
      </div>
      </div>
      </div>
      