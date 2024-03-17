<?php 
// include('../../koneksi/koneksi.php');

$no_inv = $_GET['no_inv'];
$approve = "Y";
$date = date('Y-m-d');

$sqlfix = $koneksilama->query("
    update sales set
    approve = '$approve',
    tgl_kirim_fix = '$date'
 

    where no_inv = '$no_inv'
    ");

    if($sqlfix){
        ?> 
        
        <script>
            alert("Penjualan sudah Fix akan dikirim!");
            window.location.href = "?page=penjualan&aksi=fix_kirim";
        </script>
        
        <?php 
    }

    
    ?>

