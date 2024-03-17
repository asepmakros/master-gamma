<?php
include('../../../koneksi/koneksi.php');

$id = $_GET['id'];
$inv = $_GET['inv'];

?>

<html>
<head>
    <title>Scan Resi</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="library/dselect.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    

<body>
<!-- lama -->
    <!-- <div class="row"></div>
    <div class="container  text-center">
        
    <div class="bg-danger mb-2 form-control card d-print-none" id="qr-reader" style="width:100%; "></div>
    <div id="qr-reader-results" ></div>
    </div>

    <div class="container" style="padding-bottom: 50px;">
        <form action="" method="post">
            
                <input class="form-control text-center" required  type="text" id="hasil" name="hasil" >
          
        </form>

        <p id="demo"></p>

    </div> -->
    <!-- lama -->


    <!-- baru -->
    <div class="container pt-5">
        <h2>Scan resi Paket CF</h2>
    <form id="Form" name="Form" action="" method="post">
        <input id="here" maxlength=1 name="scan" class="form-control text-center" placeholder="scan..." type="text" tabindex="1"  autofocus>
        <input id="subHere" name="subHere" hidden type="submit">
        <input id="reset" name="reset" class="btn btn-danger form-control" type="submit" value="Reset">
        </form>
<script src="https://code.jquery.com/jquery-2.2.4.js"></script>
 <table class="table">
            <tr>
                <th>#</th>
                <th>Data</th>
            </tr>
<?php 
// $hasil = array(); // This will normally be populated with your values

if(isset($_POST['subHere'])){
    $scan = $_POST['scan'];
    
    $sql = $koneksilama->query("insert into list (data)values('$scan')");
    
    $sql_list = $koneksilama->query("select * from list order by data asc");
    echo "<h3>Jumlah Paket : ".mysqli_num_rows($sql_list)."</h3>";
    $no = 1;
    while($list = $sql_list->fetch_assoc()){
        ?>
       
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $list['data']; ?></td>
            </tr>
      
        <?php
      
    }
    ?>
  </table>
    <?php

}
if(isset($_POST['reset'])){


    $sql_list = $koneksilama->query("delete from list where id>0");

        echo "Data Berhasil Direset";
 

}

?>
<script>
  $('#here').keyup(function(){
      //if(this.value.length >1){
      $('#subHere').click();
      //}
  });
</script>
    <!-- baru -->
</body>

<script src="http://underscorejs.org/underscore-min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.8/html5-qrcode.min.js
"></script>
<!-- <script>
    function docReady(fn) {
    // see if DOM is already available
    if (document.readyState === "complete"
        || document.readyState === "interactive") {
        // call on next available tick
        setTimeout(fn, 1);
    } else {
        document.addEventListener("DOMContentLoaded", fn);
    }
}

   docReady(function () {
    const resi = [];
    var no = 0;
    var resultContainer = document.getElementById('qr-reader-results');
    var lastResult, countResults = 0;
    function onScanSuccess(decodedText, decodedResult) {
        if (decodedText !== lastResult) {
            ++countResults;
            lastResult = decodedText;
            // Handle on success condition with the decoded message.
            // document.getElementById("hasil").innerHTML =  lastResult;
            // alert(`Scan result ${decodedText}`);

            var inputElement = document.getElementById("hasil");

            resi.push(decodedText);
            resi.sort();
            const resibaru = [...new Set(resi)];
            document.getElementById("demo").innerHTML = "Jumlah Paket = " + ++no + '<br> ' + resibaru.join('<br>');

    
            // Set the value of the input element
            inputElement.value = decodedText;
        }
    }

    var html5QrcodeScanner = new Html5QrcodeScanner(
        "qr-reader", { fps: 10, qrbox: 300 });
    html5QrcodeScanner.render(onScanSuccess);
});

</script> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</head>
</html>
