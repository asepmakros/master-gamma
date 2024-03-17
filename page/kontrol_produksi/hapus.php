<?php

$id = $_GET['id'];
$produk = $_GET['produk'];
$jumlah = $_GET['jumlah'];

    $sql = $koneksilama->query("delete from tb_kontrol_produksi where id = '$id'");
    $sqlstok = $koneksilama->query("
    update tb_barang set
    stok = stok-'$jumlah'
    where
    nama_barang = '$produk'");


    if($sql) {
    ?>

                <script type="text/javascript">
                    alert("Data Berhasil Dihapus");
                    window.location.href="?page=kontrol_produksi";
                </script>

    <?php

    }

?>