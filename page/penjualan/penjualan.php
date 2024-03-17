
<?php 
$id = $_GET['id'];

if(!empty($id)){
$sqlubah = $koneksi->query("select * from tb_penjualan where id = '$id'");
$tampil = $sqlubah->fetch_assoc();
}
$sqlinv = $koneksi->query("select * from tb_penjualan order by id desc");
$tampilinv = $sqlinv->fetch_assoc();
?>


<div class=" h4 text-center text-uppercase">
<?php 
echo $page;
$date = date("Y-m-d");
?></div>
<div class="mb-3">
    <form action="" method="post">
      
    <div class="input-group input-group-sm mb-3">
        <select name="jenis" class="form-select text-center" id="">
            <option value="" selected disabled>Pilih Jenis Pembeli</option>
            <option value="distributor">distributor</option>
            <option value="reseller">reseller</option>
            <option value="ecer">ecer</option>
        </select>
    <input type="text" style="width:5%" placeholder="Jumlah Produk" name="qty" class="form-control text-center" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
    <input name="add" type="submit" value="add" style="width:200px;" class="btn mt-1 btn-sm btn-outline-primary">
    </div>



    
    <?php 
          $qty = $_POST['qty'];
        if(isset($_POST['add'])){
?>

<input type="text" hidden value="<?= $qty ?>" style="width:5%" placeholder="Jumlah Produk" name="qty1" class="form-control text-center" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">

<div class="input-group input-group-sm mb-3">
        <span class="input-group-text text-center" id="inputGroup-sizing-sm">Tanggal</span>
        <input 
        <?php if(empty($id)){ ?>
        value="<?= $date ?>" 
        <?php } else { ?>
        value="<?= $tampil['tgl_kirim'] ?>" 
        <?php } ?>
        type="date" name="tgl_kirim" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
        
        <span class="input-group-text text-center" id="inputGroup-sizing-sm">Invoice</span>

        <input type="text" name="inv" value="<?= $tampilinv['tgl_kirim']."-".($tampilinv['id']+1) ?>" class="form-control text-center" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
        
    </div>
    <div class="input-group input-group-sm mb-3">
        
        <span class="input-group-text text-center" id="inputGroup-sizing-sm">Pembeli</span>
        <input type="text" name="pembeli" class="form-control text-center text-uppercase" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">

        <span class="input-group-text text-center" id="inputGroup-sizing-sm">Kurir</span>
        <input type="text" name="kurir" class="form-control text-center text-uppercase" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
    </div>

    <div class="input-group input-group-sm mb-3">
        <span class="input-group-text" id="inputGroup-sizing-sm">Akun</span>
        <select name="akun" class="form-select text-center" id="">
            <option 
            <?php if(!empty($id)){ ?>
            value="<?= $tampil['akun'];?>"
            <?php }else { ?>
            value=""
            <?php echo "selected disabled";}?>
            >
            <?php if(!empty($id)){
            echo $tampil['akun'];
            }else{
              echo "Pilih Tujuan Dana";
            } ?>
            </option>
            <?php 
            $sqlakun = $koneksi->query("select * from tb_akun");
            while ($dataakun = $sqlakun->fetch_assoc()){
            ?>
            <option value="<?= $dataakun['nama_akun'] ?>"><?= $dataakun['nama_akun'] ?></option>

        <?php } ?>
        </select>
        <span class="input-group-text" id="inputGroup-sizing-sm">Bayar</span>
        <select name="status_bayar" class="form-select text-center" id="">
            <option value="BELUM LUNAS">BELUM LUNAS</option>
            <option value="LUNAS">LUNAS</option>
        </select>
    </div>

<?php  
              
              for($x=1 ; $x<=$qty;$x++){
              ?>  
            <span class="input-group-text bg-primary text-light" id="inputGroup-sizing-sm">Produk <?= $x ?></span>

            <div class="input-group input-group-sm mb-3">
            <select name="produk<?= $x ?>" class="form-select text-center" id="">
            <option 
            <?php if(!empty($id)){ ?>
            value="<?= $tampil['produk'];?>"

            <?php }else { ?>
            value=""
            
            <?php echo "selected disabled";}?>
            >
            <?php if(!empty($id)){
            echo $tampil['produk'];
            }else{
              echo "Pilih Produk $x";
            } ?>
            </option>

            <?php 
            $sqlproduk = $koneksi->query("select * from tb_produk");
            while ($dataproduk = $sqlproduk->fetch_assoc()){
            ?>

            <option value="<?= $dataproduk['nama_barang'] ?>"><?= $dataproduk['nama_barang'] ?></option>

        <?php } ?>
        </select>

        <input type="text" name="jumlah<?= $x ?>" placeholder="Jumlah <?= $x ?>" class="form-control text-center" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
        
        <input type="text" name="satuan<?= $x ?>" placeholder="Harga Satuan" class="form-control text-center">
        
        </select>
            </div>
              <?php 
              }
            }
        ?>

    <?php if(empty($id)){?>

        <input name="tambah" type="submit" value="Tambah" style="width:200px;" class="btn mt-1 btn-sm btn-outline-success">

        <?php  }else { ?>

        <input name="ubah" type="submit" value="Ubah"  style="width:200px;" class="btn mt-1 btn-sm btn-outline-success">
        <?php  }?>
    
    </form>

</div>

<?php 
if(isset($_POST['tambah'])){
  $tgl_kirim = $_POST['tgl_kirim'];
  $inv = $_POST['inv'];
  $pembeli = $_POST['pembeli'];
  $kurir = $_POST['kurir'];
  $akun = $_POST['akun'];
  $status_bayar = $_POST['status_bayar'];
  $approve = "N";
  
  $qty1 = $_POST['qty1'];
  
for($y=1 ; $y<=$qty1 ; $y++){
    $produk = $_POST["produk".$y];
    $jumlah = $_POST["jumlah".$y];
    $satuan = $_POST['satuan'.$y];

  $sql = $koneksi->query("insert into tb_penjualan 
  (
    tgl_kirim,
    inv,
    pembeli,
    kurir,
    akun,
    status_bayar,
    produk,
    jumlah,
    satuan,
    approve
    
  ) values(
    '$tgl_kirim',
    '$inv',
    UPPER('$pembeli'),
    UPPER('$kurir'),
    '$akun',
    '$status_bayar',
    '$produk',
    '$jumlah',
    '$satuan',
    '$approve'
    ) ");
}
?>
      <script type="text/javascript">
          alert("Transaksi Berhasil Diubah");
          window.location.href="?page=penjualan";
      </script>
<?php
 
} 

if(isset($_POST['ubah'])){
  $tanggal = $_POST['tanggal'];
  $transaksi = $_POST['transaksi'];
  $akun = $_POST['akun'];
  $masuk = $_POST['masuk'];
  $keluar = $_POST['keluar'];

  $sqlupdate = $koneksi->query("update tb_penjualan set
  tanggal='$tanggal',
   transaksi='$transaksi',
   akun='$akun',
   masuk='$masuk',
   keluar='$keluar' 

   where id='$id'
   ");
  
  if($sqlupdate) {
    $id = "";

      ?>
      <script type="text/javascript">
          alert("Transaksi Berhasil Diubah");
          window.location.href="?page=penjualan";
      </script>
<?php

  }
}


?>



<hr>
<form action="" method="post">
  <input class="btn btn-alert" type="submit" name="lihat" value="Lihat Semua">
<input type="text" hidden value="" name="sql">
</form> 

<?php 
if(isset($_POST['lihat'])){
  $sql = $koneksi->query("select * from tb_penjualan group by inv order by id desc limit 500");
}else{
  $sql = $koneksi->query("select * from tb_penjualan group by inv order by id desc limit 50 ");
}
  ?> 
  


<label for="" class="h4">Tabel Penjualan Harian</label>
<div class="table-responsive-sm">
<table class="display" id="myTable">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Tanggal - Invoice - Pelanggan</th>
      <th scope="col">Produk (jumlah)</th>
      <th scope="col">Invoice</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    $no=1;

    
    
      while ($data = $sql->fetch_assoc()){
    ?>  
    <tr>
        <td><?php echo $no++ ?></td>
        <td><?php echo $data['tgl_kirim']." - ".$data['inv']."<br>".$data['pembeli']." Via : ".$data['kurir'] ?></td>
        <td>
          
        <?php 
        $inv1= $data['inv'];
        $sqldetil = $koneksi->query("select *, (jumlah*satuan) as total from tb_penjualan where inv = '$inv1' order by id desc");
        while ($datadetil = $sqldetil->fetch_assoc()){
        
        echo $datadetil['produk']." (".$datadetil['jumlah']." x ".$datadetil['satuan']." = ".number_format($datadetil['total']).")";
        ?>
        
        <a style="color:red"; onclick="return confirm('Yakin akan dihapus?')" href="?page=penjualan&aksi=hapus&id=<?php echo $datadetil['id'] ?>" class="material-symbols-outlined" style="font-size:10px;">delete  </a>
        <!-- <a href="?page=penjualan&aksi=ubah&id=<?php echo $datadetil['id'] ?>" class="material-symbols-outlined">edit</a> -->
        <br>
          
          <?php  }?>
        </td>
        
        <td>
          <a  onclick="return confirm('Yakin akan dihapus?')" href="?page=penjualan&aksi=hapus&inv=<?php echo $data['inv'] ?>" class="btn btn-danger" >Hapus Transaksi</a>
          <a href="" class="btn btn-info">Print</a>
        </td>

    </tr>
    <?php } ?>
  </tbody>
</table>
      </div>
