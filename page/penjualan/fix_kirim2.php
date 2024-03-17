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
            <div class="card bg-secondary mb-3">
            <div class="ms-2 mt-2 mb-2 input-group">
                <label for="" class="text-light ms-2 me-2" >Export : </label>
                <a href="export/template_ncs.php?time=y1" class="btn btn-sm btn-danger">COD NCS Pagi</a>
                <a href="export/template_ncs.php?time=y2" class="btn btn-sm btn-warning">COD NCS Siang</a>
                <a href="export/template_non_ncs.php?time=y1" class="btn btn-sm btn-dark">NON NCS Pagi</a>
                <a href="export/template_non_ncs.php?time=y2" class="btn btn-sm btn-light">NON NCS Siang</a>
                <label for="" class="text-light ms-2 me-2"> Resi : </label>
                <a href="page/penjualan/resi_ncs_all.php" class="btn btn-sm btn-success">Resi NCS Pagi</a>
                <a href="page/penjualan/resi_ncs_all_siang.php" class="btn btn-sm btn-primary">Resi NCS Siang</a>
            </div></div>
<table class="table table-sm display mt-2" id="myTable" >
    <thead class="text-center table-dark">
        <th>#</th>
        <th >Nama</th>
        <!-- <th>Aksi</th> -->
        <th >Waktu Invoice</th>
        <th>Tgl Packing</th>

        <!-- <th>Keterangan</th> -->
    </thead>
    <tbody >
        <?php 
          $no = 1;
            $tgl = $_POST['tgl'];
          $sql = $koneksilama->query("select * from sales  
          group by no_inv
          order by id desc
          limit 1000
         ");
          
          while ($data = $sql->fetch_assoc()) {
        ?>
        <tr
        <?php 
        if($data['tgl_kirim_fix'] != '0000-00-00'){ ?>
        class=" " style="background-color: #ADFF2F;"
        <?php
            
        }
        ?>
        >
            <td class="text-center"><?= $no++ ?></td>

            <td>
            <a class="btn btn-sm btn-primary mb-1" data-bs-toggle="collapse" href="#collapseExample<?= $no  ?>" role="button"  >
            <span class="material-symbols-outlined">
            expand_more
            </span>
            </a>
            <?= $data['pelanggan']." "?><a href="https://wa.me/62<?= $data['no_hp']?>">0<?= $data['no_hp']?></a>
           
            <div class="collapse" id="collapseExample<?= $no  ?>">
        <?php 
        if($data['tgl_kirim_fix'] != '0000-00-00'){
        ?>
     
        <a href="?page=penjualan&aksi=no_fix&no_inv=<?= $data['no_inv']?>" class="text-danger btn-danger">Batal Fix</a>   
        <?php } else {?>  
        <form action="?page=penjualan&aksi=fix_new" method="post">
            <div class="input-group">
            <input type="text" hidden name="invoice_fix" value="<?= $data['no_inv'] ?>">
            <input type="text" hidden name="waktu_fix" value="<?= $hari_ini ?>">
            <input type="date" name="tgl_fix_kirim" value="<?= $hari_ini ?>" class="">
            <select name="waktu" id="" class="text-center">
            <!-- <option value="" disabled selected>Pilih Waktu Closing</option> -->
                <option value="1">Closing Pagi</option>
                <option value="2">Closing Siang</option>
            </select>
            <input type="submit" name="fix_kirim" value="Fix Kirim" class="btn btn-sm btn-primary">
            </div>
        </form>
            
        <?php }?>
    </div>

        </td>
            <td class="text-center "><?= $data['waktu']?></td>
            <td class="text-center "><?= $data['tgl_kirim_fix']?></td>


          
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