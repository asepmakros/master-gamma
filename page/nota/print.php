<?php
$id = $_GET['id'];

$sqlprint = $koneksilama->query("select * from tb_nota where id = '$id'");
$tampil = $sqlprint->fetch_assoc();

?>

<a href="https://ciwideyfood.com/gamma2023/?page=nota" class="btn btn-sm btn-warning d-print-none">Back</a>

<b>NOTA KELUAR CV CIWIDEY FOOD</b>
<hr>
<div style="font-size: 11px;" class="fw-bold">
<b>Tanggal : </b><?= $tampil['tgl'] ?> 
<b>Pengaju : </b><?= $tampil['pengaju'] ?> <br>
<b>Keperluan : </b><?= $tampil['kebutuhan'] ?> <br>
<b>Jumlah : </b><?= number_format($tampil['jumlah']) ?> <br>
(Nota ini sudah melalui Approve Bu Annisa/Pak Asep)
<br>
<b>TERIMA KASIH TELAH MELAKSANAKAN AMANAH YANG DIBERIKAN</b>
</div>