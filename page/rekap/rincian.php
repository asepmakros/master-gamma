<div class=" h4 text-center text-uppercase">
<?php 
echo $page;

$sqlampil = $koneksilama->query("select * from tb_arus_kas where id = '$id'");
$tampil = $sqlampil->fetch_assoc();
$date = date("Y-m-d");

?></div>

<div class="container">
<a href="?page=rekap">Back</a>

<form action="" method="post">
    <div class="input-group text-center">
        <label for="" class="col fs-bold">Tanggal Awal</label>
        <label for="" class="col fs-bold">Tanggal Akhir</label>
    </div>
    <div class="input-group text-center">
        <input type="date" class="form-control text-center" value="<?= $date ?>" name="tgl_awal">
        <input type="date" class="form-control text-center" value="<?= $date ?>" name="tgl_akhir">
    </div>
    <div class="row  mt-2">
        
        <div class="col">
            <input type="submit" class="form-control btn btn-primary" value="masuk" name="masuk">
        </div>
        <div class="col">
            <input type="submit" class="form-control btn btn-primary" value="keluar" name="keluar">
        </div>
    
    </div>
</form>

<?php 
    if(isset($_POST['masuk'])){
        $totalmasuk = [];
        $judul = "Masuk";

        $tgl_awal = $_POST['tgl_awal'];
        $tgl_akhir = $_POST['tgl_akhir'];
            $danamasuk = "hidden";
            $sql = $koneksilama->query("select * from tb_arus_kas where tanggal between '$tgl_awal' and '$tgl_akhir' and keluar = 0 order by id desc");
       }
    if(isset($_POST['keluar'])){
        $totalkeluar = [];
        $judul = "Keluar";
        
        $tgl_awal = $_POST['tgl_awal'];
        $tgl_akhir = $_POST['tgl_akhir'];
        $danakeluar = "hidden";
        $sql = $koneksilama->query("select * from tb_arus_kas where tanggal between '$tgl_awal' and '$tgl_akhir' and keluar != 0 order by id desc");
        
        }

?>


<table class="table table-responsive table-striped mt-3">
 
    <thead>
    <tr class="bg-dark text-light">
        <th scope="row" >Tanggal</th>
        <th scope="row">Transaksi - Sumber</th>
        <th scope="row" <?= $danakeluar ?>>Saldo Masuk</th>
        <th scope="row" <?= $danamasuk ?>>Saldo Keluar</th>
    </tr>
</thead>
    <tbody>
    <?php 
    $no=1;
      while ($data = $sql->fetch_assoc()){
    ?>  
    <tr>
      <td><?= $data['tanggal'] ?></td>
      <td><?= $data['transaksi']." (".$data['sumber'].")" ?></td>
      <td <?= $danakeluar ?>><?= number_format($data['masuk']) ?></td>
      <td <?= $danamasuk ?>><?= number_format($data['keluar']) ?></td>
    </tr>
        
    <?php 
    array_push($totalmasuk,$data['masuk']);
    array_push($totalkeluar,$data['keluar']);

    
} 
?>
    <p class="card mt-3 text-center" <?= $danakeluar ?>><?= "Total Pemasukkan = ". number_format(array_sum($totalmasuk));?></p>
   <p class="card mt-3 text-center" <?= $danamasuk ?>><?=  "Total Pengeluaran = ".number_format(array_sum($totalkeluar));?></p>

   
   <h4 class="text-center mt-3">Transaksi
    <?= $judul." ".date("d M", strtotime($tgl_awal))." - ".date("d M", strtotime($tgl_akhir))." 2023"?></h4>


  </tbody>
</table>
</div>