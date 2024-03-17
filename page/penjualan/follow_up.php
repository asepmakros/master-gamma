<?php 

$no_inv = $_GET['no_inv'];

$sqlfix = $koneksilama->query("
    update sales set
    follow_up = 'y'
 

    where no_inv = '$no_inv'
    ");

    if($sqlfix){
        ?> 
        
        <script>
            // alert("Penjualan difollow up!");
            window.location.href = "?page=penjualan&aksi=fix_kirim";

        </script>
        
        <?php 


    }

    
    ?>

