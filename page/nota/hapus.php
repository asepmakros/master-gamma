<?php

$id = $_GET['id'];


    $sql = $koneksilama->query("delete from tb_nota where id = '$id'");



    if($sql) {
    ?>

                <script type="text/javascript">
                    alert("Data Berhasil Dihapus");
                    window.location.href="?page=nota";
                </script>

    <?php

    }

?>