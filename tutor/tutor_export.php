<?php  
include('../../koneksi/koneksi.php');

$output = '';
// if(isset($_GET["page"])){
 $query = "select * from sales where approve ='Y' and gudang = 'y1' and produk not like 'Z%' order by id asc";
 $result = mysqli_query($koneksi, $query);
 $no = 1;
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
                <tr>  
                <th>No</th>
                    <th>Tanggal</th>
                    <th>Jenis</th>
                    <th>Invoice</th>
                    <th>Pelanggan</th>
                    <th>Steril</th>
                    <th>Produk</th>
                    <th>Jumlah</th>
                    <th>Kurir</th>          
                </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
    <tr>  
            <td>'.$no++.'</td> 
            <td>'.$row["tgl_kirim"].'</td> 
            <td>'.$row["j_harga"].'</td> 
            <td>'.$row["no_inv"].'</td> 
            <td>'.explode(" ",$row["pelanggan"])[1].'</td> 
            <td>Steril</td> 
            <td>'.$row["produk"].'</td> 
            <td>'.$row["jumlah"].'</td> 
            <td>'.explode("-",$row["pelanggan"])[1].'</td> 
    
                    </tr>
   ';
  }
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=Close_Order_pagi_'.date('Y-m-d').'.xls');
  echo $output;
//  }
}
?>