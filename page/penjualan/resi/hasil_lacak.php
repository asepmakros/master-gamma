<?php 

function http_request($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}

    $get_lacak = http_request("https://api2.ptncs.com/bot/trace//ciwideyfooddemo/demo?awb=3220006063158");
    $get_lacak = json_decode($get_lacak, TRUE);
  

     
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cek ongkir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <!-- Include CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

<!-- Include JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
   <!-- Include CSS -->
   <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

<!-- Include JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>


  
</head>

<body>
    <div class="container mt-4">
        <h3>Pelacakan Ciwidey Food NCS</h3>
         <div class="card">
            <div class="card-header fw-bold">
                Pelanggan : <?= $get_lacak['consignee'] ?> <br>
                Tujuan : <?= $get_lacak['destination'] ?> <br>
                Airway Bill : <?= $get_lacak['awb'] ?> <br>
            </div>

<?php 
//   echo $get_lacak['origin'];
    $no = 1;
     foreach($get_lacak['detailStatus'] as $get_lacak){
        ?>
           
            <div class="card-body">
                <h5 class="card-title"><?= $no++.". ".$get_lacak['TimeStamp'] ?></h5>
                <p class="card-text">Posisi Paket : <?= $get_lacak['Station'] ?><br>
                Aktivitas : <?= $get_lacak['Comment'] ?></p>
            </div>
            
        <?php
        // echo $get_lacak['Comment'];
     }

?></div></div>
  
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  </body>
</html>