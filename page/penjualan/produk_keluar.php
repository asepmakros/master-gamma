
<?php 
$id = $_GET['id'];



if(!empty($id)){
$sqlubah = $koneksi->query("select * from tb_kontrol_produksi where id = '$id'");
$tampil = $sqlubah->fetch_assoc();
}
?>
<div class=" h4 text-center text-uppercase mt-3">
<?php 
echo $page;
$date = date("Y-m-d");
?></div>
<div class="mb-3">


    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

  <script>
        $('#myTable').DataTable();
        </script>

<hr>
<div class="row mt-3">
    <div class="col-md-6">
<label for="" class="h4">Tabel Approve Produk Keluar</label>
<div class="table-responsive-sm">
    <div class="overflow-auto" style="height: 100%;">
<table class="table table-striped display" id="myTable">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Tanggal</th>
      <th scope="col">Produk</th>
      <th scope="col">Keluarkan Stok</th>
      
    </tr>
  </thead>
  <tbody>
    <?php 
    $no=1;
    $sql = $koneksilama->query("select produk,jumlah,tgl_kirim_fix, sum(jumlah) as jumlah_produk from sales group by produk order by tgl_kirim desc");
      while ($data = $sql->fetch_assoc()){
    ?> 
     
    <tr>
        <td><?php echo $no++ ?></td>
        <td><?php echo $data['tgl_kirim_fix'] ?></td>
        <td>
            <?= $data['produk']." = ". $data['jumlah_produk']; ?>

        </td>
        <td>

        
          <a onclick="return confirm('Yakin akan dibatalkan?')" href="?page=produk_keluar&aksi=batal&tgl_kirim_fix=<?=  $data['tgl_kirim_fix']?>" class="btn btn-success btn-sm" style="font-size:12;" <?php if($data['keluar']!= 'y') {echo "hidden";}?>>Batal  </a>

          <a style="color:red"; onclick="return confirm('Yakin akan dikeluarkan?')" href="?page=produk_keluar&aksi=keluar&tgl_kirim_fix=<?= $data['tgl_kirim_fix']?>" class="material-symbols-outlined fs-9" <?php if($data['keluar']== 'y') {echo "hidden";}?>>Logout  </a>

        </td>

    </tr>
    <?php  }?>
  </tbody>
</table>
</div>
</div>
</div>

<div class="col-md-6">
    <h3>Tabel Stok</h3>
    <table class="table table-striped">
        <tr>
        <thead>
            <th>no</th>
            <th>Produk</th>
            <th>Jumlah</th>
        </thead>
        </tr>
        <?php 
        $no1 = 1;
        $sqlstok1 = $koneksilama->query("select * from tb_barang where nama_barang != ' Ongkir' and  nama_barang != 'Z-DISKON' order by nama_barang asc");
        while($datastok1 =$sqlstok1->fetch_assoc()){
        ?>
        <tr>
            <td><?= $no1++ ?></td>
            <td><?= $datastok1['nama_barang'] ?></td>
            <td><?= $datastok1['stok'] ?></td>


        </tr>
        <?php } ?>
    </table>
</div>
</div>
      </div>
