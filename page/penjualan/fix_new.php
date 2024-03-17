<?php 
// include('../../koneksi/koneksi.php');

$invoice_fix = $_POST['invoice_fix'];
$waktu_fix = $_POST['waktu_fix'];

$tgl_fix_kirim = $_POST['tgl_fix_kirim'];
$waktu ="y".$_POST['waktu'];

$approve = "Y";
$date = date('Y-m-d');


// echo $invoice_fix ;
// echo "<br>";
// echo $tgl_fix_kirim ;
// echo "<br>";
// echo $waktu ;

$sqlfix = $koneksilama->query("
    update sales set
    approve = '$approve',
    tgl_kirim_fix = '$tgl_fix_kirim',
    gudang = '$waktu',
    waktu_fix = '$waktu_fix'
 

    where no_inv = '$invoice_fix'
    ");

    if($sqlfix){
        ?> 
        
        <script>
            //alert("Penjualan sudah Fix akan dikirim!");
            window.location.href = "?page=penjualan&aksi=fix_kirim_search";
        </script>
        
        <?php 
    }

    
    ?>

