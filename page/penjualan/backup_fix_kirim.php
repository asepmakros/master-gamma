<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> -->
    <title>Berita Acara</title>
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
            <div class="input-group mb-3">
            <a href="export/template_ncs.php?time=y1" class="btn btn-sm btn-danger">COD NCS Pagi</a>
            <a href="export/template_ncs.php?time=y2" class="btn btn-sm btn-warning">COD NCS Siang</a>
            <a href="page/penjualan/resi_ncs_all.php" class="btn btn-sm btn-success">Resi PAgi</a>
            <a href="page/penjualan/resi_ncs_all_siang.php" class="btn btn-sm btn-primary">Resi Siang</a>
            </div>
<table class="table table-sm table-striped display" id="myTable" border="1">
    <thead class="text-center table-dark">
        <th>#</th>
        <th class="">Nama</th>
        <th >Waktu</th>

        <!-- <th>Keterangan</th> -->
    </thead>
    <tbody >
        <?php 
          $no = 1;
            $tgl = $_POST['tgl'];
          $sql = $koneksilama->query("select * from sales  
          group by no_inv
          order by id desc
          limit 200
         ");
          
          while ($data = $sql->fetch_assoc()) {
        ?>
        <tr
        <?php 
        if($data['tgl_kirim_fix'] != '0000-00-00'){ ?>
        class="bg-success text-end text-white"
        <?php
            
        }
        ?>
        >
            <td class="text-center"><?= $no++ ?></td>

            <td><?= $data['pelanggan']." "?><a href="https://wa.me/62<?= $data['no_hp']?>">0<?= $data['no_hp']?></a><br>
            <?= $data['alamat']?>
            <br>
            <?= str_replace(" Ongkir,","",$data['produks'])?>
        <!-- <form action="" method="post">
            <input type="text" hidden name="no_inv" value="<?= $data['no_inv']?>">
            <input type="submit" name="fix" value="Fix Kirim" class="btn btn-sm btn-primary">
        </form> -->
        <br>
        <?php 
        if($data['tgl_kirim_fix'] != '0000-00-00'){
        ?>
        <a href="?page=penjualan&aksi=pack&no_inv=<?= $data['no_inv']?>&waktu=1" class="btn btn-sm btn-info">Closing Pagi</a>
        <a href="?page=penjualan&aksi=pack&no_inv=<?= $data['no_inv']?>&waktu=2" class="btn btn-sm btn-warning">Closing Siang</a>
        <a href="?page=penjualan&aksi=no_fix&no_inv=<?= $data['no_inv']?>" class="btn btn-sm btn-danger">Batal Fix</a>   
                <?php } else {?>  
        <a href="?page=penjualan&aksi=kirim&no_inv=<?= $data['no_inv']?>" class="btn btn-sm btn-primary">Fix Kirim</a>
        <?php }?>



        </td>
            <td class="text-center align-middle"><?= $data['waktu']?></td>
          
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