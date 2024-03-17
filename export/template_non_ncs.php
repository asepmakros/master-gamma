<?php  
include('../koneksi/koneksi.php');
$hari_ini = date('Y-m-d');
$time = $_GET['time'];

if($time=='y1'){
    $waktu = 'Pagi';
} else {
     $waktu = 'Siang'; 
}
$output = '';
// if(isset($_GET["page"])){
 $query = "SELECT *,sum(jumlah*satuan) as total_ncs FROM sales where gudang ='$time' and pelanggan like '%cod%' and kurir not like '%NCS%' and tgl_kirim_fix = '$hari_ini' group by no_inv";
 $result = mysqli_query($koneksilama, $query);
 $no = 1;
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
                <tr>  
                <th>Kurir</th>
                    <th>NAMA</th>
                    <th>Alamat</th>
                    <th>Kota</th>
                    <th>Kode_Pos</th>
                    <th>Wilayah</th>
                    <th>Attantion</th>
                    <th>Content</th>
                    <th>Telepon</th>
                    <th>QTY</th>
                    <th>WEIGHT</th>
                    <th>COD_Barang</th>
                    <th>COD_Kirim</th>
                    <th>Total_COD</th>
                    <th>Refno</th>
                    <th>KABNAME</th>
                    <th>KABID</th>
                    <th>DESTCODE</th>
                    <th>HUBCODE</th>
                    <th>HUBCODE</th>      
                </tr>
  ';

  while($row = mysqli_fetch_array($result))
  {
   $output .= '
    <tr>  
                <td>'.$row["kurir"].'</td>
                <td>'.$row["pelanggan"].'</td>
                <td>'.$row["alamat"].'</td>
                <td>'.$row["kota"].'</td>
                <td>'.$row["kode_pos"].'</td>
                <td>'.$row["provinsi"].'</td>
                <td>'.$row["keterangan"].'</td>
                <td>'.str_replace(" Ongkir,","",$row["produks"]).'</td>
                <td>'.$row["no_hp"].'</td>
                <td>'.$row["jumlah_item"].'</td>
                <td>'.$row["berat"].'</td>
                <td>'.($row["total_ncs"]-$row["ongkir_real"]).'</td>  
                <td>'.$row["ongkir_real"].'</td>  
                <td>'.$row["total_ncs"].'</td>   
                <td>'.$row["no_inv"].'</td>  
                <td>'.$row["kabupaten"].'</td>  
                <td>'.$row["kabid"].'</td>  
                <td>'.$row["kecid"].'</td>   
                <td></td>  
                <td></td>  


                
                    </tr>
   ';
  }
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=data_cod_ncs_'.$hari_ini.'_'.$waktu.'.xls');
  echo $output;
//  }
}

if($output==''){
    ?>
      <script type="text/javascript">
                    alert("Data Belum Tersedia");
                    // window.location.href="?page=penjualan";
                </script>
                <?php
}
?>