<?php 
// include('../../koneksi/koneksi.php');

?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Resi NCS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
 
 <!-- <script src="DataTables/datatables.min.js"></script> -->
 <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
   
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
  
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
</head>
  <body>
    <div class="container">
    <h1>Aplikasi Upload Resi NCS</h1>
        <!-- <a href="https://ciwideyfood.com/app/penjualan/data_penjualan.php" class="btn btn-sm btn-warninng">Back</a> -->
        <form action="?page=penjualan&aksi=upload_resi" method="post" enctype="multipart/form-data" class="mt-3">
            <input type="file" name="csvFile" accept=".csv">
            <input type="submit" class="btn btn-sm btn-primary" value="Upload CSV">
        </form>
    </div>

<div class="container">
    <h2>Tabel Resi NCS</h2>
    <table id="myTable" class="table table-sm table-striped display">
        <thead>
            <th>#</th>
            <th>Pelanggan</th>
            <th>AWB</th>
            <th>No Invoice</th>
            <!-- <th>Total</th> -->
        </thead>
        <tbody>
        <?php 
            $no=1;
            $sql_resi = $koneksilama->query("
            select * from tb_resi_ncs 
            where CONSIGNEE != '' and
            CONSIGNEE != 'CONSIGNEE'
            order by id desc
            "); 
            while($data_resi = $sql_resi->fetch_assoc()){
                 ?>
      
        <tr>
            <td><?= $no++ ?></td>
            <td>
                <a href="https://api2.ptncs.com/bot/trace//ciwideyfooddemo/demo?awb=<?= $data_resi['AWB'] ?>">
                <?= $data_resi['CONSIGNEE'] ?></a>
            </td>
            <td><?= $data_resi['AWB'] ?></td>
            <td><?= $data_resi['REF_NO'] ?></td>

        </tr>
        <?php } ?>
        </tbody>

    </table>

</div>












       <script>
        $('#myTable').DataTable();
        </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>


