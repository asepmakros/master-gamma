<?php  
include('../koneksi/koneksi.php');
$hari_ini = date('Y-m-d');

$output = '';
// if(isset($_GET["page"])){
 $query = "SELECT * FROM sales where produk != ' Ongkir' and kurir like '%pos%' and tgl_kirim_fix = '$hari_ini' group by no_inv";
 $result = mysqli_query($koneksilama, $query);
 $no = 1;
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
                <tr>  
                    <th>Nama_Pengirim</th>
                    <th>Alamat_Pengirim</th>
                    <th>Kota_pengirim</th>
                    <th>Kodepos_Pengirim</th>
                    <th>Telepon_Pengirim</th>
                    <th>Nama_Penerima</th>
                    <th>Alamat_Penerima</th>
                    <th>Kota_penerima</th>
                    <th>Kodepos_Penerima</th>
                    <th>Telepon_Penerima</th>
                    <th>Berat(Gram)</th>
                    <th>Isi_Kiriman</th>
                    <th>Nilai_Barang</th>
                    <th>Status_COD</th>
                    <th>Nilai_COD</th>       
                </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
    <tr>  
                <td>CV CIWIDEY FOOD</td>
                <td>Perumahan Puri Indah Ciwidey Blok Puri Ayu No 30</td>
                <td>Bandung</td>
                <td>40972</td>
                <td>08112349006</td>
                <td>'.$row["pelanggan"].'</td>
                <td>'.$row["alamat"].'</td>
                <td>'.$row["kabupaten"].'</td>
                <td>'.$row["kode_pos"].'</td>
                <td>'.$row["no_hp"].'</td>
                <td>'.$row["berat"].'</td>
                <td>'.str_replace(" Ongkir,","",$row["produks"]).'</td>
                <td>'.$row["nilai_barang"].'</td>
                <td>'.$row["pembayaran"].'</td>
                <td>'.$row["nilai_barang"].'</td>   

                 
                    </tr>
   ';
  }
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=Template_upload_pos_'.$hari_ini.'.xls');
  echo $output;
//  }
}
?>