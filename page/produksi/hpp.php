
<?php 
$id = $_GET['id'];
$bahan = $_GET['bahan'];

if(!empty($id)){
$sqlubah = $koneksilama->query("select * from tb_bahan where id = '$id'");
$tampil = $sqlubah->fetch_assoc();
}
?>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>


<div class=" h4 text-center text-uppercase mt-1">
<?php 
echo "Daftar HPP <br> ".$page;

$date = date("Y-m-d");
?></div>
<div class="mb-3">




<hr>

</div>

<div class="container">
    <!-- <h2>Tabel Stok</h2> -->
            <table id="myTable" class="table table-sm table-striped display" border="1" >
                <thead>
        <tr>
                <th style="max-width: 5px;">No</th>
                <!-- <th>Produk</th> -->
                <th >Bahan</th>
                <!-- <th>Hpp</th> -->
                <!-- <th>aksi</th> -->
            </tr>
        </thead>
        <tbody>
        <?php 
        $no1 = 1;
        $sqlstok1 = $koneksilama->query("select * from tb_bahan group by produk order by produk asc");
        while($datastok1 =$sqlstok1->fetch_assoc()){
        ?>
        <tr>
            <td><?= $no1++ ?></td>
            <!-- <td class="fs-4"><?= $datastok1['produk'] ?><br> -->
            <!-- <a href="?page=produksi&aksi=tambah_bahan&id=<?= $datastok1['id']?>&produk=<?= $datastok1['produk'] ?>" class="btn btn-sm btn-success " >Tambah Bahan</a> -->
        </td>
            <td><span class="fs-5">Detail Bahan <?= $datastok1['produk'] ?></span> :
            <a class="btn btn-sm btn-outline-primary mb-1 " data-toggle="collapse" href="#collapseExample<?= $no1  ?>" role="button" >
            <span class="material-symbols-outlined">
            expand_more
            </span>
            </a>
            <div class="collapse" id="collapseExample<?= $no1  ?>">
                 
            <?php
            $hpp = [];
            $produk = $datastok1['produk'];
            $sql_bahan = $koneksilama->query("select * from tb_bahan where produk = '$produk'");
            $no = 1;
            while($data_bahan = $sql_bahan->fetch_assoc()){
                ?>
                <div class="input-group">
                    <a class="btn btn-sm btn-outline-danger mb-1 " href="?page=produksi&aksi=hapus_bahan&id=<?= $data_bahan['id'] ?>&produk=<?= $data_bahan['produk'] ?>" onclick="return confirm('Yakin bahan <?= $data_bahan['bahan'].$data_bahan['produk'] ?> akan dihapus?')"> <span class="material-symbols-outlined">
            delete
            </span></a>

                  <a class="btn btn-sm btn-outline-primary mb-1 text-start"  href="?page=produksi&aksi=ubah_bahan&id=<?= $data_bahan['id'] ?>&produk=<?= $data_bahan['produk'] ?>">
                  <?php
                echo $no++.". ".$data_bahan['bahan'];
                echo " (".$data_bahan['jumlah_resep']/$data_bahan['hasil_pack']." ". $data_bahan['satuan'];
                echo "= Rp.". $data_bahan['harga']/$data_bahan['hasil_pack'];
                echo "/pack)";
                ?></a>
                </div>
            
                <?php

                array_push($hpp,$data_bahan['harga']/$data_bahan['hasil_pack']);
            }
            ?>
        
            </div><br>
        <span class="fs-5 mb-1">HPP : <?= "Rp. ".number_format(array_sum($hpp)) ?></span>
        <br>
            <a href="?page=produksi&aksi=tambah_bahan&id=<?= $datastok1['id']?>&produk=<?= $datastok1['produk'] ?>" class="btn btn-sm btn-success form-control1" >Tambah Bahan</a>
        </td>
            <!-- <td><?= $datastok1['stok'] ?></td> -->
           
        </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
</div>
      </div>
      </div>
      </div>
            <script>
        $('#myTable').DataTable();
        </script>