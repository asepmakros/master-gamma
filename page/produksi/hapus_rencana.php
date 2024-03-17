<?php

$produk = $_GET['produk'];
$id = $_GET['id'];


    $sql = $koneksilama->query("delete from tb_rencana_produksi where id = '$id'");
    // $sql2 = $koneksilama->query("delete from tb_rencana_rekap where tanggal = '$tgl_produksi' and produk = '$produk'");


    if($sql) {
    ?>

                <script type="text/javascript">
                    alert("Data Berhasil Dihapus");
                    window.location.href="?page=produksi&aksi=rencana";
                </script>

    <?php

    }

?>