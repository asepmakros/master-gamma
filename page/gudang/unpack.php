<?php 
//  include('../koneksi/koneksi.php');


    $no_inv =$_GET['no_inv'];
    
    $sqlpack = $koneksilama->query("
    update sales set
    gudang = ''
    where no_inv = '$no_inv'");
    ?>

<script>
    window.location.href = "?page=gudang";
    </script>