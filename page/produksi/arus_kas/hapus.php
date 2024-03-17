<?php

$id = $_GET['id'];

    $sql = $koneksilama->query("delete from tb_arus_kas_belanja where id = '$id'");


    if($sql) {
    ?>

                <script type="text/javascript">
                    alert("Data Berhasil Dihapus");
                    window.location.href="?page=produksi&aksi=arus_kas&veri=produksi";
                </script>

    <?php

    }

?>