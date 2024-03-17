<?php

$tgl_kirim_fix = $_GET['tgl_kirim_fix'];



$sql = $koneksilama->query("select *,sum(jumlah) as jumlah_produk from sales where tgl_kirim_fix = '$tgl_kirim_fix' and produk != ' Ongkir'  and produk not like 'Z%' group by produk order by produk asc ");

while ($data= $sql->fetch_assoc()){
    $produk = $data['produk'];
    $jumlah = $data['jumlah_produk'];

    $sql = $koneksilama->query("
    update  tb_barang set
    stok = stok-'$jumlah'
    where nama_barang = '$produk'
    ");
}
    $sqlsales = $koneksilama->query("
    update  sales set
    keluar = 'y'
    where tgl_kirim_fix = '$tgl_kirim_fix'
        ");


    if($sqlsales) {
    ?>

                <script type="text/javascript">
                    alert("Data Berhasil Dikeluarkan");
                    window.location.href="?page=produk_keluar";
                </script>

    <?php

    }

?>