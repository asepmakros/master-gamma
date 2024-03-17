<?php 

$no_inv = $_GET['no_inv'];

$sqlfix = $koneksilama->query("
    update sales set
    follow_up = ''
 

    where no_inv = '$no_inv'
    ");

    if($sqlfix){
        ?> 
        
        <script>
            // alert("Penjualan batal difollow up!");
            window.location.href = "?page=penjualan&aksi=fix_kirim";

        </script>
        
        <?php 


    }

    
    ?>

