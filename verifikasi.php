<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verifikasi User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
<div class="container text-center" style="padding-top: 50px;">
    <form action="" method="post">
        <span class="icard text-center"  id="basic-addon3">Kode Verifikasi :</span>
        <input type="text" name="verifikasi" class="form-control text-center" placeholder="Masukan kode verifikasi">
        <input type="submit" value="Verifikasi" name="submit" class="btn btn-sm btn-primary mt-2">
    </form>
</div>

<?php 
if(isset($_POST['submit'])){
    $verifikasi = $_POST['verifikasi'];
    session_start();

    $_SESSION['verifikasi']= $verifikasi;

    if($verifikasi=="1234"){
        ?>
         <script type="text/javascript">
                    window.location.href="https://ciwideyfood.com/gamma2023/";
                </script>
                <?php
    }
}
?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>
