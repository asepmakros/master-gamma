<?php 
// include('../koneksi/koneksi.php');

$no_inv = $_GET['no_inv'];
$approve = "";

$sqlfix = $koneksilama->query("
    update sales set
    approve = '$approve',
    gudang = '$approve',
    tgl_kirim_fix = '$approve',
    waktu_fix = '0000-00-00'
 

    where no_inv = '$no_inv'
    ");

    if($sqlfix){
        ?> 
        
        <script>
            // alert("Penjualan batal dikirim!");
            window.location.href = "?page=penjualan&aksi=fix_kirim";

        </script>
        
        <?php 


    }

    
    ?>

