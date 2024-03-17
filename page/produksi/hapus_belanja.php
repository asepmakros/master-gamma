<?php

$id = $_GET['id'];
$jumlah = $_GET['jumlah'];

$nama_bahan = $_GET['nama_bahan'];



    $sql = $koneksilama->query("delete from tb_belanja where id = '$id'");

    $sqlstok = $koneksilama->query("
    update tb_bahan set
    stok = stok-'$jumlah'
    where
    nama_bahan = '$nama_bahan'");
    if($sql) {
    ?>

                <script type="text/javascript">
                    alert("Data Berhasil Dihapus");
                    window.location.href="?page=produksi&aksi=belanja";
                </script>

    <?php

    }

?>