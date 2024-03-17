<?php

$id = $_GET['id'];


    $sql = $koneksilama->query("delete from tb_bahan_update where id = '$id'");


    if($sql) {
    ?>

                <script type="text/javascript">
                    alert("Data Berhasil Dihapus");
                    window.location.href="?page=produksi&aksi=bahan&veri=produksi";
                </script>

    <?php

    }

?>