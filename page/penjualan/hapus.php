<?php

$id = $_GET['id'];
$inv = $_GET['inv'];

if(!empty($inv)){

    $sql = $koneksi->query("delete from tb_penjualan where inv = '$inv'");
}else{
    $sql = $koneksi->query("delete from tb_penjualan where id = '$id'");

}

    if($sql) {
    ?>

                <script type="text/javascript">
                    alert("Data Berhasil Dihapus");
                    window.location.href="?page=penjualan";
                </script>

    <?php

    }

?>