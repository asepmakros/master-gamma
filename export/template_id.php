<?php  
include('../koneksi/koneksi.php');
$hari_ini = date('Y-m-d');

$output = '';
// if(isset($_GET["page"])){
 $query = "SELECT * FROM sales where kurir = 'id' and tgl_kirim_fix = '$hari_ini' group by no_inv";
 $result = mysqli_query($koneksilama, $query);
 $no = 1;
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
                <tr>  
                    <th>No</th>
                    <th>Nama Penerima</th>
                    <th>Nomor Telepon</th>
                    <th>Alamat Penerima</th>
                    <th>Kabupaten Penerima</th>
                    <th>Kecamatan Penerima</th>
                    <th>Kode Pos Penerima</th>
                    <th>Order</th>
                    <th>Berat (gram)</th>
                    <th>Panjang (cm)</th>
                    <th>Lebar (cm)</th>
                    <th>Tinggi (cm)</th>
                    <th>Nilai Barang (Rp.)</th>
                    <th>Nilai COD Kustom (Rp.)</th>
                    <th>Jumlah Item Dalam Paket</th>
                    <th>Catatan Paket</th>
                    <th>Asuransi</th>
                    <th>Pembayaran</th>
                    <th>Kurir</th>

                    
                </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
    <tr>  
            <td>'.$no++.'</td> 
            <td>'.$row["pelanggan"].'</td> 
            <td>&#39;0'.$row["no_hp"].'</td> 
            <td>'.$row["alamat"].'</td> 
            <td>'.$row["kabupaten"].'</td> 
            <td>'.$row["kecamatan"].'</td> 
            <td>'.$row["kode_pos"].'</td> 
            <td>'.$row["produks"].'</td> 
            <td>'.$row["berat"].'</td> 
            <td>29</td> 
            <td>12</td> 
            <td>12</td> 
            <td>'.$row["nilai_barang"].'</td> 
            <td></td> 
            <td>'.$row["jumlah_item"].'</td> 
            <td>Frozen Food</td> 
            <td>Tidak</td> 
            <td>'.$row["pembayaran"].'</td> 
            <td>'.$row["kurir"].'</td> 


                    
                    </tr>
   ';
  }
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=template_upload_ID_'.$hari_ini.'.xls');
  echo $output;
//  }
}
?>