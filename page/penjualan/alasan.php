<?php 

$no_inv = $_POST['no_inv'];
$alasan = $_POST['alasan'];

$sql_alasan = $koneksilama->query("select * from  tb_alasan 
         where no_inv = '$no_inv'  ");
$data_alasan = $sql_alasan->fetch_assoc();
$jml = mysqli_num_rows($sql_alasan);

    if($jml > 0){
        $sqlfix = $koneksilama->query("
        update tb_alasan set
        alasan = '$alasan'

        where no_inv = '$no_inv'
         ");
    }else{

    $sqlfix = $koneksilama->query("
   insert into tb_alasan (no_inv, alasan)
   values
   ('$no_inv', '$alasan')
    ");
    }
    if($sqlfix){
        ?> 
        
        <script>
            alert("Alasan Sudah dimasukkan!");
            window.location.href = "?page=penjualan&aksi=fix_kirim";
        </script>
        
        <?php 
    }

    
    ?>

