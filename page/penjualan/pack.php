<?php 
 

//  include('../koneksi/koneksi.php');
 
    $no_inv =$_GET['no_inv'];
    $waktu =$_GET['waktu'];

    
    $sqlpack = $koneksilama->query("
    update sales set
    gudang = 'y$waktu'
    where no_inv = '$no_inv'");
     ?>
     <script>
    window.location.href = "?page=penjualan&aksi=fix_kirim&waktu=<?= $waktu ?>";
    </script>