<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> -->
    <title>Ranking</title>
     <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

</head>

<body>
    <div class="container">
        <?php 
                $hari_ini = date('Y-m-d');
                ?>
            <div class="text-center">
            <h3 >Fix Kirim Penjualan</h3>
            <h4 ><?= $hari_ini ?></h4>
            </div>
         
<table class="table table-sm table-striped display mt-2" id="myTable" border="1">
    <thead class="text-center table-dark">
        <th>#</th>
        <th>tgl</th>
        <th class="col-6">Nama</th>
        <th >Nomor Hp</th>
        <th>Jumlah Pesanan</th>

        <!-- <th>Keterangan</th> -->
    </thead>
    <tbody >
        <?php 
          $no = 1;
            $tgl = $_POST['tgl'];
          $sql = $koneksilama->query("select * from sales 
          where tgl_kirim_fix != '0000-00-00'
          group by no_hp order by id desc limit 300
         ");
          
          while ($data = $sql->fetch_assoc()) {
        ?>
        <tr        >
            <td class="text-center"><?= $no++ ?></td>
             <td class="text-center align-middle"><?= $data['tgl_kirim_fix']?></td>
           <td class="text-center align-middle"><?= $data['pelanggan']?></td>

            <td class="text-center align-middle">0<?= $data['no_hp']?></td>

          <?php 
          $no_in = $data['no_inv'];
           $sql_fix = $koneksilama->query("select *  from sales 
          group by no_hp and no_inv = '$no_in'
         ");
          $rowcount=mysqli_num_rows($sql_fix);
          
          ?>
            <td class="text-center align-middle">
        
            <?= $rowcount?>
     
        </td>

       


          
      </tr>
        <?php 
        
    } ?>
    </tbody>
</table>



    </div>
    <script>
        $('#myTable').DataTable();
        </script>

</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
</script>
</body>

</html>