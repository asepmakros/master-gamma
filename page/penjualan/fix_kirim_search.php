

<head>
<title>fIX kIRIM</title>

</head>

<body>
    <div class="container">
        <?php 
                $hari_ini = date('Y-m-d');
                ?>
            <div class="text-center">
            <h3 >Fix Kirim Penjualan Search</h3>
            <h4 ><?= $hari_ini ?></h4>
            </div>
            <div class="card bg-secondary mb-3">
            <div class="ms-2 mt-2 mb-2 input-group">
                <label for="" class="text-light ms-2 me-2" >COD NCS : </label>
                <a href="export/template_ncs.php?time=y1" class="btn btn-sm btn-outline-warning">Batch 1</a>
                <a href="export/template_ncs.php?time=y2" class="btn btn-sm btn-outline-warning">Batch 2</a>
                <a href="export/template_ncs.php?time=y3" class="btn btn-sm btn-outline-warning">Batch 3</a>
                <a href="export/template_ncs.php?time=y4" class="btn btn-sm btn-outline-warning">Batch 4</a>
              
                <label for="" class="text-light text-end ms-2 me-2" >COD NON-NCS : </label>
                <a href="export/template_non_ncs.php?time=y1" class="btn btn-sm btn-outline-light">Batch 1</a>
                <a href="export/template_non_ncs.php?time=y2" class="btn btn-sm btn-outline-light">Batch 2</a>
                <a href="export/template_non_ncs.php?time=y2" class="btn btn-sm btn-outline-light">Batch 3</a>
                <a href="export/template_non_ncs.php?time=y2" class="btn btn-sm btn-outline-light">Batch 4</a>
                
            </div>
            <div class="ms-2 mt-2 mb-2 input-group">
            <!-- <a href="page/penjualan/resi_ncs_all.php" class="btn btn-sm btn-success">Resi Pagi</a>
            <a href="page/penjualan/resi_ncs_all_siang.php" class="btn btn-sm btn-primary">Resi Siang</a> -->
        </div>
        <!-- <label for="" class="text-light ms-2 me-2">Print Resi : </label> -->
        <a href="page/penjualan/resi_print.php" class="btn btn-sm btn-warning">Print Resi</a>
        </div>


            <form action="" method="post">
                <input type="text" class="form-control text-center" name="pelanggan" placeholder="Cari invoice">
                <input type="submit" value="Search" name="search" class="btn btn-sm btn-primary form-control">
            </form>


<?php 
if(isset($_POST['search'])){

    $search = $_POST['pelanggan'];

    ?>
   




<table class="table table-sm table-striped order-warning  mt-2"  border="1" >
    <thead class="text-center table-dark ">
        <th>#</th>
        <th class="col-6">Nama</th>
        <th >Waktu Invoice</th>
        <th>Tgl Packing</th>

        <!-- <th>Keterangan</th> -->
    </thead>
    <tbody >
        <?php 
          $no = 1;
            $tgl = $_POST['tgl'];
          $sql = $koneksilama->query("select *,sum(jumlah) as jumlah_produk from sales  
          where pelanggan like '%$search%' and produk != ' Ongkir' and produk != 'DISKON'
          group by no_inv
          order by id desc
          limit 10
         ");
          
        $cek_duplikat = [];

          while ($data = $sql->fetch_assoc()) {
            $invo = $data['no_inv'];
            $sql_total = $koneksilama->query("select *,sum(jumlah*satuan) as totals from sales  
          where no_inv = '$invo' ");
         $data_total = $sql_total->fetch_assoc();

         $sql_alasan = $koneksilama->query("select * from sales, tb_alasan 
         where sales.no_inv = tb_alasan.no_inv and sales.no_inv = '$invo'  ");
        $data_alasan = $sql_alasan->fetch_assoc();
        ?>
        <tr
        <?php 
        if($data['gudang'] == 'y1'){?>
        style="background-color: yellow;"
        <?php }else if($data['gudang'] == 'y2'){ ?>
        style="background-color: #ADFF2F;"
        <?php }?>
        <?php
        if($data_alasan['alasan'] != ''){?>
        style="background-color: red !important; " class="text-white"
        <?php } ?>

        <?php 
                $hape = $data['pelanggan'];
                $cek = implode(",",$cek_duplikat);

                if(strpos($cek, $hape) !== false){
                    echo "class=\"bg-warning text-light\"";
                }
                array_push($cek_duplikat,$hape);

                ?>
       
        >
            <td class="text-center"><?= $no++ ?></td>

            <td>
            <a class="btn  mb-1" data-bs-toggle="collapse" href="#collapseExample<?= $no  ?>" role="button"  >
            <span class="material-symbols-outlined">
            expand_more
            </span>
            
            <?= $data['pelanggan']?></a> 
            
            <a href=" https://wa.me/62<?= $data['no_hp']?>"><span class="material-symbols-outlined">chat</span></a> <b>(<?= $data['jumlah_produk']?> Pcs)</b>
            <div class="collapse" id="collapseExample<?= $no  ?>">
            Alamat : <?= $data['alamat']?>
            <br>Produk : <b>

            <?php 
                $sql_produks = $koneksilama->query("select *  from sales  
                where no_inv = '$invo' ");
                while ($data_produks = $sql_produks->fetch_assoc()) {

                    echo $data_produks['produk'];
                    echo " (";
                    echo $data_produks['jumlah'];
                    echo " pcs) ";
                }
            ?>

        
            
            
            = Rp. <?= number_format($data_total['totals'])?>
       </b>
        <br>
        <?php 
        if($data['tgl_kirim_fix'] != '0000-00-00'){
        ?>
      
        <a href="?page=penjualan&aksi=no_fix&no_inv=<?= $data['no_inv']?>" class="btn btn-sm btn-danger mb-3">Batal Fix</a>   
                <?php } else {?>  
        
        <form action="?page=penjualan&aksi=fix_new" method="post">
            <div class="input-group">
            <input type="text" hidden name="invoice_fix" value="<?= $data['no_inv'] ?>">
            <input type="text" hidden name="waktu_fix" value="<?= $hari_ini ?>">
            <input type="date" name="tgl_fix_kirim" value="<?= $hari_ini ?>" class="form-date">
            <select name="waktu" id="" class="form-select text-center">
            <!-- <option value="" disabled selected>Pilih Waktu Closing</option> -->
                <option value="1">Batch 1</option>
                <option value="2">Batch 2</option>
                <option value="3">Batch 3</option>
                <option value="4">Batch 4</option>
                <option value="5">Batch 5</option>
            </select>
            <input type="submit" name="fix_kirim" value="Fix Kirim" class="btn btn-sm btn-primary">
            </div>
        </form>

        <?php }?>

        

            </div>

        </td>
            <td class="text-center align-middle"
            <?php 
            if(!empty($data['follow_up'])){
                ?>
                style="background-color : pink";
                <?php 
            }

            
            ?>
            ><?= $data['waktu']?><br>
            <?php 
            if(empty($data['gudang']) && empty($data['follow_up']) && strpos($data['pelanggan'], 'TF') !== false){
                ?>
                <a href="?page=penjualan&aksi=follow_up&no_inv=<?= $data['no_inv']?>" class="btn btn-sm btn-outline-success">Sudah difollow up</a>
                <?php 
            } else if(empty($data['gudang']) && !empty($data['follow_up']) && strpos($data['pelanggan'], 'TF') !== false){
                ?>
                <a href="?page=penjualan&aksi=follow_up_batal&no_inv=<?= $data['no_inv']?>" class="btn btn-sm btn-outline-danger">Batal follow up</a>

                <?php 
            }
            ?>
        </td>
            <td class="text-center align-middle">
            <a class="btn mb-1" data-bs-toggle="collapse" href="#catatan_gagal<?= $no  ?>" role="button"  >
                <?= $data['tgl_kirim_fix']?>

            <?php 
        if($data['gudang'] == 'y1'){?>
        (Packing Pagi)
        <?php }else if($data['gudang'] == 'y2'){ ?>
        (Packing Siang)
        <?php }
        ?>
            <span class="material-symbols-outlined">
            expand_more
            </span>
            </a>
        <!-- Gagal -->
        <div class="collapse" id="catatan_gagal<?= $no  ?>">

        <form action="?page=penjualan&aksi=alasan" method="post">
            <div class="input-group">
            <input type="text" hidden name="no_inv" value="<?= $data['no_inv'] ?>">
            <select name="alasan" id="" class="form-select text-center">
            <option value="" disabled selected>Pilih Alasan Gagal</option>
                <option value="">Tidak ada Alasan</option>
                <option value="Produk Mahal">Produk Mahal</option>
                <option value="Ongkir Mahal">Ongkir Mahal</option>
                <option value="Invoice Ganda">Invoice Ganda</option>
                <option value="Retur Ditolak pembeli">Retur Ditolak pembeli</option>
                <option value="Retur Kurir Gagal Kirim">Retur Kurir Gagal Kirim</option>
                <option value="Retur Lama Pengiriman">Retur Lama Pengiriman</option>
                <option value="Paket Dikirim Double">Paket Dikirim Double</option>
                <option value="Retur Pembeli Tak Bisa Dihubungi">Retur Pembeli Tak Bisa Dihubungi</option>
                <option value="Alasan Lainnya">Alasan Lainnya</option>
            </select>
            <input type="submit" name="gagal" value="Alasan" class="btn btn-sm btn-info">
            </div>
        </form>
        </div>
        <!-- Gagal -->
       
        <?= $data_alasan['alasan'] ?>
        </td>


          
      </tr>
        <?php 
        
    } ?>
    </tbody>
</table>



    </div>
    

<?php 
}
?>

</body>

</html>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"> -->
</script>
</body>

</html>