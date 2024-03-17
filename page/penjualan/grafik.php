<?php
   $sql = $koneksilama->query("select *,sum(jumlah_item) as jumlah_harian from sales
   group by produk
  ");
   
   $total = [];
   while ($data = $sql->fetch_assoc()){
    array_push($total,"['y' =>". $data['jumlah_harian'].", 'label' => ".$data['tgl_kirim_fix']."]");

   }

     $dataPoints =[
     $total
     ];
    
     ?>
     <!DOCTYPE HTML>
     <html>
     <head>
     <script>
     window.onload = function () {
      
     var chart = new CanvasJS.Chart("chartContainer", {
         title: {
             text: "Grafik Penjualan Proguk"
         },
         axisY: {
             title: "Jumlah Produuk"
         },
         data: [{
             type: "line",
             dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
         }]
     });
     chart.render();
      
     }
     </script>
     </head>
     <body>
        <div class="container">
     <div id="chartContainer" style="height: 370px; width: 100%;"></div>
     </div>
     <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
     </body>
     </html>                              