<?php
$id = $_GET['id'];

$sqldata = $koneksilama->query("select * from tb_kwitansi where id = '$id' ");
$data = $sqldata->fetch_assoc();

$re_no_invoice = $_GET['no_invoice'];
$re_nomor_po = $_GET['nomor_po'];
$re_tgl_kirim = $_GET['tgl_kirim'];
$re_jumlah = $_GET['jumlah'];
$re_nama_pengirim = $_GET['nama_pengirim'];

$re_ongkir = $_GET['ongkir'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kwitansi</title>
</head>
<body>


<div class="container card mb-5 d-print-none">
    <div class="text-center fs-3">Daftar Kwitansi</div>
    <div class="row">
        <div class="col-md">
            <form action="" method="post">
                <div class="input-group">
                    <span class="input-group-text"id="basic-addon3" class="form-label">Nomor Invoice</span>
                    <select name="no_invoice" id="" class="form-select">
                        <option value="" selected disabled>Pilih Nomor Invoice</option>
                        <?php $sql_po = $koneksilama->query("select * from tb_po order by id desc ");
                            while($tampil_po = $sql_po->fetch_assoc()){ ?>
                            <option value="<?= $tampil_po['no_invoice'] ?>"><?= $tampil_po['no_invoice']." (".$tampil_po['jumlah']." pack)" ?></option>
                            <?php } ?>
                    </select>
                </div>

                <div class="input-group">
                    <span class="input-group-text"id="basic-addon3" class="form-label">Nomor PO</span>
                    <select name="nomor_po" id="" class="form-select">
                        <option value="" selected disabled>Pilih Nomor PO</option>
                        <?php $sql_po = $koneksilama->query("select * from tb_po order by id desc ");
                            while($tampil_po = $sql_po->fetch_assoc()){ ?>
                            <option value="<?= $tampil_po['nomor_po'] ?>"><?= $tampil_po['nomor_po']." (".$tampil_po['jumlah']." pack)" ?></option>
                            <?php } ?>
                    </select>
                </div>

               
                <?php
                $date = date("Y-m-d");
                ?>
                <div class="input-group">
                    <span class="input-group-text"id="basic-addon3" class="form-label" v>Tanggal Kirim</span>
                    <input type="date" name="tgl_kirim" value="<?= $date ?>" class="form-control">
                </div>
                <div class="input-group">
                    <span class="input-group-text"id="basic-addon3" class="form-label">Jumlah</span>
                    <input type="number" name="jumlah" class="form-control">
                </div>
                <div class="input-group">
                    <span class="input-group-text"id="basic-addon3" class="form-label">Biaya Ongkir</span>
                    <input type="number" name="ongkir" class="form-control">
                </div>
            
                <div class="input-group">
                    <span class="input-group-text"id="basic-addon3" class="form-label">Nama Pengirim</span>
                    <input type="text" name="nama_pengirim" class="form-control">
                </div>
                <input type="submit" name="submit" value="Tambah" class="btn btn-sm btn-primary mt-2">
            </form>
        </div>

        <?php
            if(isset($_POST['submit'])){
                $no_invoice= $_POST['no_invoice'];
                $nomor_po= $_POST['nomor_po'];
                $tgl_kirim= $_POST['tgl_kirim'];
                $jumlah= $_POST['jumlah'];
                $nama_pengirim= $_POST['nama_pengirim'];
                $ongkir= $_POST['ongkir'];

                                
                $sql = $koneksilama->query("insert into tb_kwitansi 
                (
                    no_invoice,
                    nomor_po,
                    tgl_kirim,
                    jumlah,
                    nama_pengirim,
                    ongkir

                ) values(
                    '$no_invoice',
                    '$nomor_po',
                    '$tgl_kirim',
                    '$jumlah',
                    '$nama_pengirim',
                    '$ongkir'
                    ) ");
                
                if($sql){
                ?>
                    <script type="text/javascript">
                        alert("Transaksi Berhasil Ditambah");
                        window.location.href="?page=surat&aksi=kwitansi";
                    </script>
                <?php
                }

            }
        ?>



        <div class="col-md">
            <h4>Daftar Invoice</h4>
            <table class="table table-sm table-striped">
                <tr>
                    <th>No</th>
                    <th>Detai invoice PO</th>
                    <th>Print</th>
                </tr>
                <?php 
                $no = 1;
                $sql_invoice = $koneksilama->query("select * from tb_kwitansi order by id desc limit 5");
                while($invoice = $sql_invoice->fetch_assoc()){
                ?>
                <tr>
                    <td><?= $no++?></td>
                    <td>
                        <?= "no_invoice : ".$invoice['no_invoice']?><br>
                        <?= "nomor_po : ".$invoice['nomor_po']?><br>
                        <?= "tgl_kirim : ".$invoice['tgl_kirim']?><br>
                        <?= "jumlah : ".$invoice['jumlah']?><br>
                        <?= "Ongkir : ".$invoice['ongkir']?><br>
                        <?= "nama_pengirim : ".$invoice['nama_pengirim']?><br>
                    </td>
                    <td><a href="?page=surat&aksi=kwitansi&no_invoice=<?= $invoice['no_invoice'] ?>&nomor_po=<?= $invoice['nomor_po'] ?>&tgl_kirim=<?= $invoice['tgl_kirim'] ?>&jumlah=<?= $invoice['jumlah'] ?>&nama_pengirim=<?= $invoice['nama_pengirim']?>&ongkir=<?= $invoice['ongkir']?>">Print</a></td>
                </tr>
                <?php } ?>
            </table>
        </div>

    <h2 class="text-center"><?= $re_no_invoice?></h2>
</div>
</div>


<!-- kop surat -->
<div class="">
        <div class="row me-3 border rounded ">
            <div class="col-3 text-center">
                <img src="https://ciwideyfood.com/gamma2023/page/surat/logo_cf.jpg" style="width: 150px; height:150px" alt="logo cf" class="ms-2 rounded-circle">
            </div>
            <div class="col  mb-3 align-middle">
                <p class="ms-3 mt-2" style="font-size: 12px;"><b class=""><br>CV CIWIDEY FOOD (Food Manufacturing and Distribution) </b><br>
                NIB : 022000069191974 AHU-0030448-AH.01.14 Tahun 2020 <br>
                Perum Puri Indah Ciwidey Blok Puri Ayu No. 30 Kec. Pasirjambu Kab. Bandung <br>
                Instagram : @bandengisiciwidey <br>
                WhatsApp : 08112182201</p>
            </div>
            </div>
        </div>
    <!-- kop surat -->


    <div class="container-md mt-3" style="font-size: 12px;">
        <div class="row">
            <div class="col">
                 <b> <h5>Kwitansi <br>
            Receipt</h5></b> 
            </div>
      <div class="col-5">
          <p>Nomor Invoice : <?= $re_no_invoice ?> <br>
        Tanggal : <?= $re_tgl_kirim ?> <br>
        Nomor PO : <?= $re_nomor_po ?> </p>
      </div>

      
        </div>
     
        <hr>
    </div>

<!-- fungsi terbilang -->
<?php
	function penyebut($nilai) {
		$nilai = abs($nilai);
		$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
		$temp = "";
		if ($nilai < 12) {
			$temp = " ". $huruf[$nilai];
		} else if ($nilai <20) {
			$temp = penyebut($nilai - 10). " belas";
		} else if ($nilai < 100) {
			$temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
		} else if ($nilai < 200) {
			$temp = " seratus" . penyebut($nilai - 100);
		} else if ($nilai < 1000) {
			$temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
		} else if ($nilai < 2000) {
			$temp = " seribu" . penyebut($nilai - 1000);
		} else if ($nilai < 1000000) {
			$temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
		} else if ($nilai < 1000000000) {
			$temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
		} else if ($nilai < 1000000000000) {
			$temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
		} else if ($nilai < 1000000000000000) {
			$temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
		}     
		return $temp;
	}
 
	function terbilang($nilai) {
		if($nilai<0) {
			$hasil = "minus ". trim(penyebut($nilai));
		} else {
			$hasil = trim(penyebut($nilai));
		}     		
		return $hasil;
	}
 
 

	?>

<!-- fungsi terbilang -->

    <div class="container card" style="font-size: 12px;">
        <div class="row mb-2 mt-3">
            <div class="col-3">Telah Terima Dari <br> Received From</div>
            <div class="col">: <b>PT DAPUR SOLO MUSTIKA NUSANTARA</b></div>
        </div>
        <div class="row mb-2">
            <div class="col-3">Banyaknya Uang <br> Amount</div>
            <div class="col">: <b><?= strtoupper(terbilang(($re_jumlah*24000)+$re_ongkir)) ?> RUPIAH</b></div>
        </div>
        <div class="row mb-2">
            <div class="col-3">Untuk Pembayaran <br> </div>
            <div class="col">: Bandeng Presto (BANPRES). No. PO : <?= $re_nomor_po ?> </div>
        </div>
        <div class="row mb-2">
            <div class="col-3">For Payment</div>
            <div class="col">: Pengiriman Tanggal  <?= $re_tgl_kirim ?> </div>
        </div>
        <div class="row mb-2">
            <div class="col-3">Total Produk</div>
            <div class="col">: <?= number_format($re_jumlah) ?>  pack</div>
        </div>   
        <div class="row mb-2">
            <div class="col-3">Biaya Ongkir</div>
            <div class="col">: Rp. <?= number_format($re_ongkir) ?> </div>
        </div>   	
        
        <div class="row bordered">
            <div class="card h3 text-center mt-3 mb-3 bg-light text-dark fw-bold">IDR. <?= number_format(($re_jumlah*24000)+$re_ongkir) ?>  </div>
        </div>
        	
		<div class="row">
            <div class="col-8">						
                <p>PEMBAYARAN MELALUI	<br>									
                <b>BANK CENTRAL ASIA SYARIAH (BCA SYARIAH)		<br>								
                NO REKENING		: 0597270487 <br>
                ATAS NAMA		: ASEP MAKTAL ROSADA	</b>	<br>			</p>				
                <p style="font-size: 9px;">Kwitansi ini baru dianggap sah setelah pembayaran diterima dengan menyertakan bukti transfer</p>
            </div>
            <div class="col-4 text-center">
                Bandung, <?= $re_tgl_kirim ?> <br>
                CV Ciwidey Food <br>
                <br><br><br><br><br>
                <b><u><?= $re_nama_pengirim ?></u></b>
            </div>					
        </div>		
    </div>


</body>
</html>