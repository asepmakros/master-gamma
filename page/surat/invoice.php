<?php
$id = $_GET['id'];

$sqldata = $koneksilama->query("select * from tb_invoice where id = '$id' ");
$data = $sqldata->fetch_assoc();

$re_no_invoice = $_GET['no_invoice'];
$re_nomor_po = $_GET['nomor_po'];
$re_tgl_kirim = $_GET['tgl_kirim'];
$re_jumlah = $_GET['jumlah'];
$re_nama_pengirim = $_GET['nama_pengirim'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
</head>
<body>
<div class="container card mb-5 d-print-none">
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

                                
                $sql = $koneksilama->query("insert into tb_invoice 
                (
                    no_invoice,
                    nomor_po,
                    tgl_kirim,
                    jumlah,
                    nama_pengirim

                ) values(
                    '$no_invoice',
                    '$nomor_po',
                    '$tgl_kirim',
                    '$jumlah',
                    '$nama_pengirim'
                    ) ");
                
                if($sql){
                ?>
                    <script type="text/javascript">
                        alert("Transaksi Berhasil Ditambah");
                        window.location.href="?page=surat&aksi=invoice";
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
                $sql_invoice = $koneksilama->query("select * from tb_invoice order by id desc limit 5");
                while($invoice = $sql_invoice->fetch_assoc()){
                ?>
                <tr>
                    <td><?= $no++?></td>
                    <td>
                        <?= "no_invoice : ".$invoice['no_invoice']?><br>
                        <?= "nomor_po : ".$invoice['nomor_po']?><br>
                        <?= "tgl_kirim : ".$invoice['tgl_kirim']?><br>
                        <?= "jumlah : ".$invoice['jumlah']?><br>
                        <?= "nama_pengirim : ".$invoice['nama_pengirim']?><br>
                    </td>
                    <td><a href="?page=surat&aksi=invoice&no_invoice=<?= $invoice['no_invoice'] ?>&nomor_po=<?= $invoice['nomor_po'] ?>&tgl_kirim=<?= $invoice['tgl_kirim'] ?>&jumlah=<?= $invoice['jumlah'] ?>&nama_pengirim=<?= $invoice['nama_pengirim']?>">Print</a></td>
                </tr>
                <?php } ?>
            </table>
        </div>

    <h2 class="text-center"><?= $re_no_invoice?></h2>
</div>
</div>

<!-- awal Invoice -->
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


    <div class="container-md" style="font-size: 12px;">
        <div class="row">
            <div class="col-4">
                 <b> <h4>Invoice <br>
                 <p style="font-size: 12px;">Kepada <br>
                  PT. DAPUR SOLO MUSTIKA NUSANTARA
                    Jl. Panjang NO.8 CDE, RT.5/RW.11, Kedoya Utara,
                    Kec. Kb. Jeruk, Daerah Khusus Ibukota Jakarta</p></h4></b> 
            </div>
            <div class="col-3"></div>
            <div class="col-5">
                <p>Nomor Invoice : <?= $re_no_invoice?> <br>
                Tanggal : <?= $re_tgl_kirim?><br>
                Nomor PO : <?= $re_nomor_po?></p>
            </div>
        </div>
        <hr>
    </div>

    <div class="container" style="font-size: 12px;">
        <table class="table table-striped table-sm ">
            <tr class="">
                <th>No</th>
                <th>Deskripsi</th>
                <th>Jumlah Produk</th>
                <th>Harga Satuan</th>
                <th>Harga Total</th>
            </tr>
            <tr>
                <td>1</td>
                <td>Bandeng Presto <br>
                    Nomor PO : <?= $re_nomor_po?>
                </td>
                <td><br><?= $re_jumlah?></td>
                <td><br>24.000 </td>
                <td><br><?= number_format($re_jumlah*24000)?> </td>
            </tr>
            <tr class="text-light">
                <th colspan="2" class="text-center">TOTAL</th>
                <th><?= $re_jumlah?></th>
                <th></th>
                <th><?= number_format($re_jumlah*24000)?></th>
            </tr>
        </table>
    </div>


    <div class="container card" style="font-size: 12px;">
        
		<div class="row">
            <div class="col-8">						
                <p>Pembayaran Melalui:	<br>									
                <b>BANK NEGARA INDONESIA (BNI)		<br>								
                NO REKENING		: 966 749 337 <br>
                ATAS NAMA		: Uus Sutrisno	</b>	<br>	<br>		</p>				
                <p style="font-size: 9px;">Invoice ini baru dianggap sah setelah pembayaran diterima dengan menyertakan bukti transfer</p>
            </div>
            <div class="col-4 text-center">
                Bandung, <?= $re_tgl_kirim ?> <br>
                <b>CV Ciwidey Food </b><br>
                <br><br><br><br>
                <b><u><?= $re_nama_pengirim?></u></b>
            </div>					
        </div>		
    </div>


</body>
</html>