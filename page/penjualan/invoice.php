
<?php 

$inv = $_GET['inv'];
$satuan = $_GET['satuan'];

$sqlinvoice = $koneksi->query("
select * from tb_penjualan where inv = '$inv'
");

$datainvoice = $sqlinvoice->fetch_assoc();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Invoice CF</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
    <div class=" text-center">
        <div class="card text-center mb-0" style="line-height: 0.5;">
            <div class=" mt-2">
                <a href="" onclick=window.print()>
                <img  src="https://ciwideyfood.com/wp/wp-content/uploads/2021/10/logo-CF-PNG-300x160.png" width="50" alt=""></a>
            </div>
            <b><p class=" mt-3 mb-0">Invoice CV Ciwidey Food</p></b>
            <hr>
            <p>Nomor Invoice : <?= $inv; ?></p>
            <p>Tanggal : <?= $datainvoice['tgl_kirim']; ?></p>
            <p>Nama Pembeli : <?= $datainvoice['pembeli']; ?></p>
        </div>
        <div class="text-start">
            <table class="table  table-striped">
               <tr>
                   <th>Nama Produk</th>
                   <th>Qty</th>
                   <th>Harga Satuan</th>
                   <th>Total</th>
               </tr>
            <?php 
            $no=1;
            
                    $sqlinvoice2 = $koneksi->query("
                    select * from tb_penjualan where inv = '$inv'
                    "); 
                    while($sqlproduk= $sqlinvoice2->fetch_assoc()){

                 ?>
                    <tr>
                        <td><?= $no.". ".$sqlproduk['produk']; ?></td>
                        <td><?= $sqlproduk['jumlah']; ?></td>
                        <td><?php 
                        $produk = $sqlproduk['produk'];
                        $sqlsatuan = $koneksi->query("
                        select * from tb_produk where nama_barang = '$produk'
                        "); 
                        $datasatuan= $sqlsatuan->fetch_assoc();
                        if($satuan=="h_db"){
                            echo number_format($datasatuan['h_db']);
                        }elseif($satuan=="h_reseller"){
                            echo number_format($datasatuan['h_reseller']);
                        }else {
                            echo number_format($datasatuan['h_ecer']);
                        }
                        ?></td>
                        <td>
                        <?php 
                            if($satuan=="h_db"){
                            echo number_format($datasatuan['h_db']*$dataproduk['jumlah']);
                        }elseif($satuan=="h_reseller"){
                            echo number_format($datasatuan['h_reseller']*$dataproduk['jumlah']);
                        }else {
                            echo number_format($sqlsatuan['h_ecer']*$sqlproduk['jumlah']);
                        }
                        ?>
                        </td>
                    </tr>
                    
                    
                    <?php 
            $no++;
            }
            ?>
            </table>
        </div>
        <div class="container-fluid text-center bg-warning">
            <b><h3>Total Invoice = Rp. <?php 
            $total = $koneksi->query("
            select sum(jumlah*satuan) as total from tb_penjualan where inv = '$inv'
            ");
            $datatotal = $total->fetch_assoc();
            echo number_format($datatotal['total'],2);
            ?></p></b>
        </div>
        <div class="card text-start">
        <p> Note :</p>
        <ol>
            <li> Silakan Lakukan transfer paling lambat pukul 15.00 agar pengiriman diproses besok</li>
            <li> Deposit/kelebihan bayar akan langsung dikembalikan</li>
            <li> Harap melunasi sesuai invoice demi kelancaran pesanan.</li>
        </ol>
        <ul>         
           <li>Rekening Bank BNI atas nama <b> UUS SUTRISNO No Rek. 966 749 337</b>
           <li>Rekening Bank BCA atas nama <b> ASEP MAKTAL ROSADA No Rek. 0597 270487</b>
           <li>Rekening Bank BRI atas nama <b> ASEP MAKTAL ROSADA No Rek. 0756 0100 2165 506</b>
            </li> 
        </ul>   


Kirim bukti transfer ke admin keuangan (ECA)
Terima Kasih
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>