<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> -->
    <title>Berita Acara</title>
</head>


<body>
    <div class="container">
        <?php 
                $hari_ini = date('Y-m-d');
                ?>
        <form action="" method="post" class="d-print-none">
            <div class="input-group">
            Tgl :
                <input type="date" name="tgl" value="<?= $hari_ini ?>">
            Waktu Closing :
            <select name="closing" id="" class="text-center form-control">
                <option value="1">Batch 1</option>
                <option value="2">Batch 2</option>
                <option value="3">Batch 3</option>
                <option value="4">Batch 4</option>
                <option value="5">Batch 5</option>

            </select>
        <input type="submit" name="pilih" value="Pilih"  class="btn btn-sm btn-primary col-3">
        </div>
        </form>
            


            <?php 
    $no = 1;
          if(isset($_POST['pilih'])){
            $tgl = $_POST['tgl'];
            $closing = $_POST['closing'];

          $sql = $koneksilama->query("select *,sum(jumlah*satuan) as total_berita from sales where 
          gudang = 'y$closing' and
          tgl_kirim_fix = '$tgl'
          group by no_inv
          order by pelanggan desc
         ");
         ?>
         <h3 class="text-center">Berita Acara Penjualan Batch <?= $closing ?></h3>
            <h5  class="text-center">Tanggal <?= $tgl ?></h5>

<table class="table table-sm table-striped table-bordered" border="1">
    <thead class="text-center table-dark">
        <th>#</th>
        <th class="col-6">Resi</th>
        <!-- <th>Produk</th> -->
        <th >Tagihan</th>
        <th>Sameday</th>
        <th>Fix</th>
        <th>Pack</th>
        <th>Kurir</th>
        <th>Ket.</th>
    </thead>
    <tbody>
        <?php 
      
          $total = [];
          $total_cod = [];
          $total_tf = [];
          while ($data = $sql->fetch_assoc()) {
        ?>
        <tr style="font-size: small;">
            <td class="text-center"><?= $no++ ?></td>
            <?php 
            if($data['gudang'] == 'y1'){
                $waktu= 'Pagi';
            }
            if($data['gudang'] == 'y2'){
                $waktu= 'Siang';
            }
            if($data['gudang'] == 'y3'){
                $waktu= 'Sore';
            }
            ?>
            <td><b><?= $data['pelanggan']." => Batch ".$closing?></b><br>Produk : 
            <?php 
                $invo = $data['no_inv'];
                $sql_produks = $koneksilama->query("select *  from sales  
                where no_inv = '$invo' ");
                while ($data_produks = $sql_produks->fetch_assoc()) {

                    echo $data_produks['produk'];
                    echo " (";
                    echo $data_produks['jumlah'];
                    echo ") ";
                }
            ?>
        </td>
            <td class="text-center align-middle"><?= number_format($data['total_berita'])?></td>
            <td class="text-center align-middle"><input type="checkbox" 
            <?php 
            if(strpos($data['pelanggan'],"SAMEDAY") != false){
                echo "checked";
            }
            ?>
            ></td>
            <td class="text-center align-middle"><input type="checkbox"></td>
            <td class="text-center align-middle"><input type="checkbox"></td>
            <td class="text-center align-middle"><input type="checkbox"></td>
            <td class="text-center align-middle"></td>
      </tr>
        <?php 
        array_push($total,$data['total_berita']);
        
        if(strpos($data['pelanggan'],"TF")!== false){
            array_push($total_tf,$data['total_berita']);
        }
        if(strpos($data['pelanggan'],"COD")!== false){
            array_push($total_cod,$data['total_berita']);
        }
        
    } ?>
    </tbody>
</table>

<div class="text-center h3 bg-dark text-light">

            Closing Batch <?= $closing ?>
        </div>

<div class="card mt-3">
            <h5 class="text-center">Rekap Ekspedisi Batch <?= $closing ?>
            <?php 
                             $sql_resi_all = $koneksilama->query("select * from sales where  gudang ='y$closing'  and tgl_kirim_fix = '$tgl'  group by no_inv ");
                             $jumlah_resi_all = mysqli_num_rows($sql_resi_all);
                             echo "(".$jumlah_resi_all." paket)";
                            ?>
        </h5>
            <h6 class="text-center">Tanggal <?= $tgl ?></h6>
                <table class="table table-sm table-striped   mt-3" >
                        <thead>
                            <th>#</th>
                            <th>Kurir</th>
                            <th>Jumlah Paket</th>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            $sqlsiang = $koneksilama->query("select *, sum(jumlah) as jum from sales where  gudang ='y$closing'  and tgl_kirim_fix = '$tgl' group by kurir ORDER BY kurir desc");
                            while ($data = $sqlsiang->fetch_assoc()) {
                            ?>
                            <tr style="font-size: 12px;" >
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $data['kurir'] ?></td>

                                <td>
                                <?php 
                                $kurir = $data['kurir'];
                                $sql_resi = $koneksilama->query("select * from sales where  gudang ='y$closing'  and tgl_kirim_fix = '$tgl' and kurir = '$kurir' group by no_inv");
                                $jumlah_resi_kurir = mysqli_num_rows($sql_resi);
                                echo $jumlah_resi_kurir." paket";
                                ?>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>

        
      <table class="mb-5 table table-striped" border="1">

            <tr>
                <td class="text-end">Jumlah Paket TF Dikirim</td>
                <td>:</td>
            </tr>
            <tr>
                <td class="text-end">Jumlah Paket COD Dikirim</td>
                <td>:</td>
            </tr>


            <tr>
                <td class="text-end">Jumlah Paket Tak Dikirim Hari</td>
                <td>:</td>
            </tr>
            <tr>
                <td class="text-end">Total Tagihan COD</td>
                <td>: <?php 
                $total_semua_COD = array_sum($total_cod);
                echo "Rp. ".number_format($total_semua_COD);
                ?></td>
            </tr>
            <tr>
                <td class="text-end">Total Tagihan TF</td>
                <td>: <?php 
                $total_semua_tf = array_sum($total_tf);
                echo "Rp. ".number_format($total_semua_tf);
                ?></td>
            </tr>
            <tr>
                <td class="text-end">Total Tagihan Paket</td>
                <td>: <?php 
                $total_semua = array_sum($total);
                echo "Rp. ".number_format($total_semua);
                ?></td>
            </tr>


      </table>


     
      
    <?php 
        }
?>

</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
</script>
</body>

</html>