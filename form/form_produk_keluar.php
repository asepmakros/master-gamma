<h4>FORM STOK KELUAR</h4>
<H5>GUDANG CV CIWIDEY FOOD</H5>


<body onload="window.print()">
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRODUK KELUAR</title>
</head>
<body>


    
<table class="table table-sm table-bordered border-dark">
    <thead>
        <tr class="text-center align-middle"  style="border-style:solid;">
        <th rowspan="3" >NO</th>
        <th rowspan="3" style="max-width: fit-content;">NAMA BARANG</th>
        <th colspan="21">TANGGAL</th>
        </tr>
        <tr style="max-height:1cm;" class="opacity-0">
            <th colspan="3">1</th>
            <th colspan="3">1</th>
            <th colspan="3">1</th>
            <th colspan="3">1</th>
            <th colspan="3">1</th>
            <th colspan="3">1</th>
        </tr>
        <tr style="max-height:1cm; font-size: 10px;" class="">
            <th>Pa</th>
            <th>Si</th>
            <th>So</th>
            <th>Pa</th>
            <th>Si</th>
            <th>So</th>
            <th>Pa</th>
            <th>Si</th>
            <th>So</th>
            <th>Pa</th>
            <th>Si</th>
            <th>So</th>
            <th>Pa</th>
            <th>Si</th>
            <th>So</th>
            <th>Pa</th>
            <th>Si</th>
            <th>So</th>
           
        </tr>
    </thead>
    <tbody>
    <?php
    $no= 1;
$sqlbarang = $koneksilama->query("select * from tb_barang where nama_barang != ' Ongkir' order by nama_barang asc");
while ($databarang = $sqlbarang->fetch_assoc()){ 

?>
        <tr style="font-size: 12px;  border-style:solid;" class="success">
        <td class="text-center"><?= $no++?></td>
        <td><?= $databarang['nama_barang']?></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
   
        </tr>

        <?php } ?>
    </tbody>
</table>
</body>
</html>