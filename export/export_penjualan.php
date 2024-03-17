<?php  
include_once "../koneksi/koneksi.php";

$output = '';
// if(isset($_GET["page"])){
 $query = "select * from sales  where approve != '' order by id desc";
 $result = mysqli_query($koneksilama, $query);
 $no = 1;
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
 
<table >  
<tr>     
 <th>no</th>
    <th>no_inv</th>
    <th>tgl_kirim</th>
    <th>tgl_kirim_fix</th>
    <th>pelanggan</th>
    <th>produk</th>
    <th>status_bayar</th>
    <th>jumlah</th>
    <th>j_harga</th>
    <th>satuan</th>
    <th>packing</th>
    <th>akun</th>
    <th>gudang</th>
    <th>request_packing</th>
    <th>approve</th>
    <th>estimasi</th>
    <th>no_hp</th>
    <th>alamat</th>
    <th>kabupaten</th>
    <th>kota</th>
    <th>kecamatan</th>
    <th>kode_pos</th>
    <th>produks</th>
    <th>berat</th>
    <th>nilai_barang</th>
    <th>pembayaran</th>
    <th>jumlah_item</th>
    <th>kurir</th>

    <th>keterangan</th>         
</tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
   <tr>  
       
   <td>'.$no .'</td> 
   <td>'.$row["no_inv"].'</td> 
   <td>'.$row["tgl_kirim"].'</td> 
   <td>'.$row["tgl_kirim_fix"].'</td> 
   <td>'.$row["pelanggan"].'</td> 
   <td>'.$row["produk"].'</td> 
   <td>'.$row["status_bayar"].'</td> 
   <td>'.$row["jumlah"].'</td> 
   <td>'.$row["j_harga"].'</td> 
   <td>'.$row["satuan"].'</td> 
   <td>'.$row["packing"].'</td> 
   <td>'.$row["akun"].'</td> 
   <td>'.$row["gudang"].'</td> 
   <td>'.$row["request_packing"].'</td> 
   <td>'.$row["approve"].'</td> 
   <td>'.$row["estimasi"].'</td> 
   <td>'.$row["no_hp"].'</td> 
   <td>'.$row["alamat"].'</td> 
   <td>'.$row["kabupaten"].'</td> 
   <td>'.$row["kota"].'</td> 
   <td>'.$row["kecamatan"].'</td> 
   <td>'.$row["kode_pos"].'</td> 
   <td>'.$row["produks"].'</td> 
   <td>'.$row["berat"].'</td> 
   <td>'.$row["nilai_barang"].'</td> 
   <td>'.$row["pembayaran"].'</td> 
   <td>'.$row["jumlah_item"].'</td> 
   <td>'.$row["kurir"].'</td> 

   <td>'.$row["keterangan"].'</td> 

   
</tr>
   ';
    
   $no++ ;
 }

  
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=Penjualan_full'.date('Y-m-d').'.xls');
  echo $output;
 }

?>