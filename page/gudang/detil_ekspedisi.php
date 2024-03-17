<?php 
include('../../koneksi/koneksi.php');
$get_kurir = $_GET['kurir'];
$get_batch = $_GET['batch'];
$get_tgl_kirim_fix = $_GET['tgl_kirim_fix'];
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Ekspedisi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
<div class="container mt-5">
<h3 class="text-center">Expedisi <?= $get_kurir ?></h3>
<h3 class="text-center">Tanggal <?= $get_tgl_kirim_fix ?> Batch <?= $get_batch ?></h3>
                <table class="table table-sm table-striped  border" >
                        <thead>
                            <th>#</th>
                            <th>Invoice</th>
                            <th>Pelanggan</th>
                            <th>Rincian</th>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            $sqlsiang = $koneksilama->query("select * from sales where  gudang = 'y$get_batch' and produk != ' Ongkir' and tgl_kirim_fix = '$get_tgl_kirim_fix' and kurir = '$get_kurir' group by no_inv");
                            while ($data = $sqlsiang->fetch_assoc()) {
                            ?>
                            <tr style="font-size: 18px;" >
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $data['no_inv'] ?>
                                <td><?php echo $data['pelanggan'] ?>
                            
                            </td>
                                <td><ol>
                                    <?php 
                                    $no_inv = $data['no_inv'];
                                     $sql_list = $koneksilama->query("select * from sales where  no_inv= '$no_inv' and produk != ' Ongkir'");
                                     while ($data = $sql_list->fetch_assoc()) {
                                    ?>
                                        
                                            <li><?php echo $data['produk'] ?> = <?php echo $data['jumlah'] ?> Pack</li>
                                        
                                    <?php 
                                     }
                                    ?></ol>
                            </td>
                            
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>