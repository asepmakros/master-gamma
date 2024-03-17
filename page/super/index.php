<?php 
include('../../koneksi/koneksi.php');

// $no_inv = $_GET['no_inv'];
$hari_ini = date('Y-m-d');

$sql_wa = $koneksilama->query("select * from tb_super ");
$data_wa = $sql_wa->fetch_assoc();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Super User Do</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>

<div class="container">
 
    <?= str_replace("%0A","<br>",(str_replace("%20","\r",$data_wa['wa']))) ?>
    Aktifkan Required kota
    isian rekening di wa

</div>






  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>