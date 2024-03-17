<?php

$id = $_GET['id'];

    $sql = $koneksilama->query("delete from tb_arus_kas where id = '$id'");


    if($sql) {
    ?>

                <script type="text/javascript">
                    alert("Data Berhasil Dihapus");
                    window.location.href="?page=arus_kas";
                </script>

    <?php

    }

?>