<?php
include('../koneksi/koneksi.php');
$jenis = $_GET["jenis"];
$date = pow(date('H'),3);
$date1 = date('d')*3;

$hari_ini = date('Y-m-d');

$alert = $_GET['alert'];
$alerthapus = $_GET['alerthapus'];

if($alert != ''){
    $alerthapus = '';
    $visi = '';
    $visihapus = 'hidden';

} else if($alerthapus != ''){
    $alert = '';
    $visihapus = '';
    $visi = 'hidden';

}else {
    $visihapus = 'hidden';
    $visi = 'hidden';
}

?>
<div class="opacity-25" style="font-size:9px;">
<?php
 $date+$date1;
?>
</div>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> -->
    <title>Data Invoice</title>
</head>

<body>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <link href="DataTables/datatables.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
 
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    


        <div class="container">

<h2 class="text-center">Aplikasi Packing Harian</h2>
        <div class="" >
           

            <div class="bg-success  text-light text-center fw-bold card" <?= $visi ?>><p><?= $alert ?></p></div>
            <div class="bg-danger text-light text-center fw-bold card" <?= $visihapus ?>><p><?= $alerthapus ?></p></div>

            
            <table id="myTable" class="table table-sm display ">
                <thead>

                    <th class=""># </th>
                    <th class="" style="width: 100%;">Orderan <?=  $hari_ini; ?></th>

                </thead>
                <tbody>
                    <?php
                    $sql = $koneksilama->query("select * from sales where approve ='y' and tgl_kirim_fix = '$hari_ini'
                         group by no_inv order by gudang asc limit 150");
                    $no = 1;
                    while ($data = $sql->fetch_assoc()) {
                    ?>

                    <tr style="font-size:14px;" <?php
                            if ($data['approve'] != "") {
                                echo "class='bg-light'";}?>>
                        <td><?php echo $no++; ?></td>
                        <td class="text-start fw-bold ">
                        
                        
                        <a href="https://ciwideyfood.com/app/penjualan/invoice.php?no_inv=<?php echo $data['no_inv']; ?>">
                        <?php echo $data['no_inv']." ".$data['tgl_kirim_fix'] ;?>
                        </a>
                     
                        <?php 
                        echo "<br>" .
                        $data['pelanggan'] . " HP : <a style=\"font-size:12px;\" href='https://wa.me/62" . $data['no_hp'] . "'>0". $data['no_hp'] ."</a><br>" . $data['alamat'];

                        // if($data['estimasi']!="" ){
                        // echo "Est. sampai ".$data['estimasi']." hari";} ; 
                        ?>

                           <br>
                           

                            <?php
                                $invoice = $data['no_inv'];
                                $sqlproduk = $koneksilama->query("select * from sales 
                            where no_inv = '$invoice'");

                                $nopro = 1;
                                $total_berat = [];
                                $total_bayar = [];
                                while ($dataproduk = $sqlproduk->fetch_assoc()) {

                                    $barang = $dataproduk['produk'];
                                    $sqlberat = $koneksilama->query("select * from tb_barang 
                            where nama_barang = '$barang'");
                                    $databerat = $sqlberat->fetch_assoc();

                                    $berat = array_push($total_berat, ($dataproduk['jumlah'] * $databerat['berat']));
                                    $bayar = array_push($total_bayar, ($dataproduk['jumlah'] * $dataproduk['satuan']));

                                    echo $nopro . ". " . $dataproduk['produk']. " (" . $dataproduk['jumlah'] . " x " . number_format($dataproduk['satuan']) . ") " .

                                        "<br>";


                                    $nopro++;
                                    
                                }
                                ?>
   <br>
                            <div class="input-group mb-2">
                            <!-- <a href="https://ciwideyfood.com/app/penjualan/index_klip.php?no_inv=<?= $data['no_inv'] ?>&pembeli=<?= str_replace('RES ', '', str_replace('PAXEL ', '', str_replace('TF ', '', str_replace('COD ', '', $data['pelanggan'])))) ?>&no_hp=<?= $data['no_hp'] ?>&alamat=<?= $data['alamat'] ?>&estimasi=<?= $data['estimasi'] ?>"
                                class="btn btn-sm btn-success ">Repeat Order</a> -->

                                    <?php 
                                    if($data['gudang']=='y1' || $data['gudang']=='y2' || $data['gudang']=='y3'){
                                    ?>
                                    <a href="?page=gudang&aksi=unpack&no_inv=<?= $data['no_inv'] ?>" class="btn btn-sm btn-primary ">Sudah Packing</a>

                                    
                                    
                                    <?php }
                                    else {
                                    ?>
                                    <a href="?page=gudang&aksi=pack&no_inv=<?= $data['no_inv'] ?>&waktu=1" class="btn btn-sm btn-danger ">Packing Pagi</a>
                                    <a href="?page=gudang&aksi=pack&no_inv=<?= $data['no_inv'] ?>&waktu=2" class="btn btn-sm text-dark btn-warning ">Packing Siang</a>
                                    <a href="?page=gudang&aksi=pack&no_inv=<?= $data['no_inv'] ?>&waktu=3" class="btn btn-sm btn-success ">Packing Sore</a>
                                    <?php } ?>
                                    
                            
                                </div>
                                <?php  
                                $tomas = array_sum($total_berat)+100;
                                ?>
                                
                                
                                <div class="input-group  mt-3">

                                   
    
                                    <a href="https://ciwideyfood.com/app/penjualan/index_klip.php?no_inv=<?= $data['no_inv'] ?>&pembeli=<?= str_replace('RES ', '', str_replace('PAXEL ', '', str_replace('TF ', '', str_replace('COD ', '', $data['pelanggan'])))) ?>&no_hp=<?= $data['no_hp'] ?>&alamat=<?= $data['alamat'] ?>&estimasi=<?= $data['estimasi'] ?>">
                                    
                                    </a>

                                  <!-- <div  style='max-width: fit-content;' >
                                     Massa : <?= $tomas  ?>g<br>
                                     Total : Rp. <?= (number_format(array_sum($total_bayar))) ?></div>

                                </div> -->


                       


                           

                            </div>
                        </td>

                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <script>
        $('#myTable').DataTable();
        </script>


    </div>
    </div>

</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
</script>
</body>

</html>