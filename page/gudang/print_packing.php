<?php
// include('../koneksi/koneksi.php');
$jenis = $_GET["jenis"];
$packing = 'y1';

if(isset($_POST['pilih'])){ 

    $tgl_kirim_fix = $_POST['tgl'];
    if($_POST['packing'] == ''){
        $packing = 'y1';
        
    }else{
        $packing = $_POST['packing'];
    }}

?> 

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> -->
    <title>Print Packing Harian</title>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <link href="DataTables/datatables.min.css" rel="stylesheet">


    <script>
        $('#myTable').DataTable();
        </script>
</head>

<body>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
  
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script> -->

    <h5 class="   text-center">Print Out Packing Harian <?=  $tgl_kirim_fix; ?></h5>

    <div class="container">
        <a href="?page=gudang&aksi=rekap" class="btn btn-sm btn-warning d-print-none">back</a>
        <hr>    

        <div class="">
            <div class="row d-print-none">
                <div class="col">
                    <div class=" text-center">

                    <form action="" method="post">
                        <div class="input-group col-md-6">
                            <input type="date" name="tgl" value="<?= $hari_ini ?>">
                        <select name="packing" id=""  class="form-select">
                        <option value="" selected disabled>Pilih Waktu Closing</option>
                            <option value="y1">Pagi</option>
                            <option value="y2">Siang</option>
                            <!-- <option value="y3">Sore</option> -->
                        </select>
                        <input type="submit" value="pilih" name="pilih" class="btn btn-sm btn-primary">
                        </div>
                    </form>

                    </div>
                </div>
            </div>

            <table class="table  display mt-3">
                <thead>

                    <th class="bg-dark text-light mt-3">Orderan <?php if($packing == 'y1'){echo 'Pagi';} else if($packing == 'y2'){echo 'Siang';} else if($packing == 'y3'){ echo 'Sore';} ?></th>
                    

                </thead>
                <tbody>
                    <?php
                    $sql = $koneksilama->query("select * from sales 
                    where gudang = '$packing' and tgl_kirim_fix = '$tgl_kirim_fix'
                         group by no_inv order by pelanggan asc");
                    $no = 1;
                    $rowcount=mysqli_num_rows($sql);

           

                    while ($data = $sql->fetch_assoc()) {
                    ?>
<!-- awal baris -->
                    <div >
                    <tr style="font-size: 16px;" class="fw-bold">
                        <td>(<?php echo $no. "of ".$rowcount; ?>) <?php echo $data['no_inv'] . " - " . $data['tgl_kirim_fix'] . "<br>" .
                        $data['pelanggan'] . "<br>HP : 0". $data['no_hp'] ."<br>" . $data['alamat'];

                         ?>
                         <br>
                         Pengirim : CV Ciwidey Food <br>
                         No HP : 0882000233864 <br>
                         Alamat : Perumahan Puri Indah Ciwidey blok puri ayu no 30 desa pasirjambu kec Pasirjambu

                                <br>
                                <?= "<br>Catatan : " . strtoupper($data['keterangan']) ?>
                                <br>
                            <?php
                                $invoice = $data['no_inv'];
                                $sqlproduk = $koneksilama->query("select * from sales 
                            where no_inv = '$invoice' and produk != ' Ongkir'");
                            
                             $sqlproduk1 = $koneksilama->query("select * from sales 
                            where no_inv = '$invoice' and produk = ' Ongkir'");
                            
                                $nopro = 1;
                                $total_berat = [];
                                $total_bayar = [];
                                $total_produk = [];
                                $dataproduk1 = $sqlproduk1->fetch_assoc();
                                while ($dataproduk = $sqlproduk->fetch_assoc()) {

                                    $barang = $dataproduk['produk'];
                                    $sqlberat = $koneksilama->query("select * from tb_barang 
                            where nama_barang = '$barang' and nama_barang != ' Ongkir'");
                                    $databerat = $sqlberat->fetch_assoc();

                                    $berat = array_push($total_berat, ($dataproduk['jumlah'] * $databerat['berat']));
                                    $bayar = array_push($total_bayar, ($dataproduk['jumlah'] * $dataproduk['satuan']));
                                    $jml = array_push($total_produk, ($dataproduk['jumlah']));

                                    echo "<b>".$nopro . ". " . $dataproduk['produk'] . " (" . $dataproduk['jumlah'] . " ) " .

                                       "</b><br>";


                                    $nopro++;
                                }
                                
                                $tomas = array_sum($total_berat) + 100;
                                $topro = array_sum($total_produk);
                                echo "<br>Ongkir = Rp. ". number_format($dataproduk1['satuan']*$dataproduk1['jumlah'])  ;
                                echo "<br><div class='  text-start'>
                                Total Produk: " . $topro . " pcs<br>" . "Total Massa: " . $tomas . " g<br>" .
                                    "Total Bayar: Rp. " . (number_format(array_sum($total_bayar))) . "</div>";

                                ?>
                                ===============================

                           </td>

 <!-- tengah -->

                    <?php
                    $no++;
                    }
                    ?>
                    </tr>
                    </div>
                    <!-- akhi baris -->
                </tbody>
            </table>
        </div>

       


    </div>
    </div>

</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
</script>
</body>

</html>