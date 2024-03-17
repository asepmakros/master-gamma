<div class=" h4 text-center text-uppercase">
<?php 
echo $page;
session_start();

?></div>
<div class="container">
<a href="?page=akun">Daftar Akun</a> ||
<a href="?page=rekap&aksi=rincian">Rincian Transaksi</a>
<table class="table table-striped">
<tbody>
  <tr style="background-color: aquamarine;">
      <th class="text-end" style="width:50%;">Total Saldo :</th>
      <th>
        <?php 
        $sqltotal = $koneksilama->query("select *,sum(masuk) - sum(keluar) as total from tb_arus_kas");
        $datatotal = $sqltotal->fetch_assoc();
        echo " Rp.".number_format($datatotal['total']);
        ?>
      </th>
      
    </tr>
  <tr style="background-color: aquamarine;">
      <th class="text-end" class="text-end">Total Saldo Kas :</th>
      <th>
        <?php 
        $sqltotalkas = $koneksilama->query("select *,sum(masuk) - sum(keluar) as total from tb_arus_kas where sumber not like 'PIUTANG%'");
        $datatotalkas = $sqltotalkas->fetch_assoc();
        echo " Rp. ".number_format($datatotalkas['total']);
        ?>
      </th>
      
    </tr>
    <tr style="background-color: aquamarine;">
      <th class="text-end">Total Saldo Piutang :</th>
      <th>
        <?php 
        $sqltotalkas = $koneksilama->query("select *,sum(masuk) - sum(keluar) as total from tb_arus_kas where sumber like 'PIUTANG%'");
        $datatotalkas = $sqltotalkas->fetch_assoc();
        echo " Rp. ".number_format($datatotalkas['total']);
        ?>
      </th>
      
    </tr>
    <tr style="background-color: aquamarine;">
      <th class="text-end">Uang Dalam Produk (Harga Ecer) :</th>
      <th>
        <?php 
        $sqltotalproduk = $koneksilama->query("select *,sum(stok*harga_ecer) as total from tb_barang where nama_barang not like 'Z%'");
        $datatotalproduk = $sqltotalproduk->fetch_assoc();
        echo " Rp. ".number_format($datatotalproduk['total']);
        ?>
      </th>
      
    </tr>
    <tr style="background-color: aquamarine;">
      <th class="text-end">Uang Dalam perlengkapan Gudang :</th>
      <th>
        <?php 
        $sqltotalproduk = $koneksilama->query("select *,sum(stok*harga_beli) as total from tb_barang where nama_barang like 'Z%'");
        $datatotalproduk = $sqltotalproduk->fetch_assoc();
        echo " Rp. ".number_format($datatotalproduk['total']);
        ?>
      </th>
      
    </tr>
  </tbody>
  
</table >



<table class="table table-sm table-responsive table-striped" style="line-height: 0,5;">
 
  <tbody>
 
    <tr>
      <th scope="row">#</th>
      <th scope="row">Akun kas</th>
      <th scope="row">Total Saldo</th>
      <th scope="row">Saldo Masuk</th>
      <th scope="row">Saldo Keluar</th>
    </tr>
    <?php 
    $no=1;
    $sql = $koneksilama->query("select *,sum(masuk) as totalmasuk, sum(keluar) as totalkeluar from tb_arus_kas group by sumber");
      while ($data = $sql->fetch_assoc()){
    ?>  
    <tr>
        <td><?= $no++ ?></td>
      <td> 
      <?= $data['sumber'] ?>
      <a  href="?sumber=<?= $data['sumber'] ?>"> </td>
      <td><?= number_format($data['totalmasuk']-$data['totalkeluar']) ?></td>
      <td><?= number_format($data['totalmasuk']) ?></td>
      <td><?= number_format($data['totalkeluar']) ?></td>
    </tr>
    <?php } ?>
   
  </tbody>
</table>

 <?php 
        $sumber = $_GET['sumber'];
        ?>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
       
        <h1 class="modal-title fs-5" id="staticBackdropLabel"><?= $sumber1 ?></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

      <table class="table table-responsive table-striped">
 
 <tbody>

   <tr>
     <th scope="row">Akun kas</th>
     <th scope="row">Total Saldo</th>
     <th scope="row">Saldo Masuk</th>
     <th scope="row">Saldo Keluar</th>
   </tr>
   <?php 
   $no=1;
   $sqlmodal = $koneksilama->query("select *,sum(masuk) as totalmasuk, sum(keluar) as totalkeluar from tb_arus_kas group by sumber");
     while ($datamodal = $sqlmodal->fetch_assoc()){
   ?>  
   <tr>
     <td> <a data-bs-toggle="modal" data-bs-target="#staticBackdrop"href=""> <?= $datamodal['sumber'] ?></a></td>
     <td><?= number_format($datamodal['totalmasuk']-$datamodal['totalkeluar']) ?></td>
     <td><?= number_format($datamodal['totalmasuk']) ?></td>
     <td><?= number_format($datamodal['totalkeluar']) ?></td>
   </tr>
   <?php } ?>
  
 </tbody>
</table>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Understood</button>
      </div>
    </div>
  </div>
</div>

<div class="p-5"></div>
</div>