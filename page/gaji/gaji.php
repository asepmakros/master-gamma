
<html lang="en">

<head>
    <title>Ranking</title>

    </head>

<body>
    <div class="container">
        <?php 
                $hari_ini = date('Y-m-d');
                ?>
            <div class="text-center">
            <h3 >Data Karyawan CF</h3>
            </div>
         
<table class="table table-sm table-striped display mt-2" id="myTable" border="1">
    <thead class="text-center table-dark">
        <th>#</th>
        <th class="col-1">ID</th>
        <th class="col-4">Nama Karyawan</th>
        <th class="col-1">Jabatan</th>
        <th>Gaji</th>

        <!-- <th>Keterangan</th> -->
    </thead>
    <tbody >
        <?php 
          $no = 1;
            $tgl = $_POST['tgl'];
          $sql = $koneksilama->query("select * from tb_karyawan 
          order by id_peg asc 
         ");
          
          while ($data = $sql->fetch_assoc()) {
        ?>
        <tr>

            
            <td class="text-center"><?= $no++ ?></td>
            <td class=" align-middle"><?= $data['id_peg']?></td>
            <td class=" align-middle">
        <a class="btn  mb-1" data-bs-toggle="collapse" href="#buka_detil_<?= $data['id']  ?>" role="button"  >
                <?= $data['nama']?>
        </a> 
                <div class="collapse" id="buka_detil_<?= $data['id']  ?>">
                        <form action="" method="post">
                            <div class="input-group">
                                <span class="input-group-text"id="basic-addon3">ID</span>
                                <input type="text"  name="id_peg<?= $data['id']  ?>" class="form-control" value="<?= $data['id_peg'] ?>">

                                <input type="text" disabled  name="id" value="<?= $data['id']  ?>" class="form-control" >
                            </div>
                            <div class="input-group">
                                <span class="input-group-text"id="basic-addon3">Nama</span>
                                <input type="text" name="nama<?= $data['id']  ?>" class="form-control" value="<?= $data['nama']  ?>">
                            </div>
                            <div class="input-group">
                                <span class="input-group-text"id="basic-addon3">Jabatan</span>
                                <input type="text" name="jabatan<?= $data['id']  ?>" class="form-control" value="<?= $data['jabatan']  ?>">
                            </div>
                            <div class="input-group">
                                <span class="input-group-text"id="basic-addon3">Upah Perjam</span>
                                <input type="text" name="gaji_perjam<?= $data['id']  ?>" class="form-control" value="<?= $data['gaji_perjam']  ?>">
                            </div>
                            <input type="submit" name="ubah" value="Update" class="btn btn-primary mt-2">
                        </form>
                </div>
            </td>

            <td class=" align-middle"><?= $data['jabatan']?></td>
            <td class=" align-middle">
                <a class="btn  mb-1" data-bs-toggle="collapse" href="#buka_gaji_<?= $data['id']  ?>" role="button"  >
                Upah Perjam = <?= number_format($data['gaji_perjam'])?>
        </a> 
                <div class="collapse" id="buka_gaji_<?= $data['id']  ?>">
                <form action="" method="post">
                            <div class="input-group">
                                <span class="input-group-text"id="basic-addon3">Bulan</span>
                                <!-- <input type="text"  name="bulan<?= $data['id']  ?>" class="form-control" value="<?= $data['bulan'] ?>"> -->

                                <select required name="bulan<?= $data['id']  ?>" class="form-select" id="">
                                    <option selected disabled value="">Pilih Bulan</option>
                                    <option value="Januari">Januari</option>
                                    <option value="Februari">Februari</option>
                                    <option value="Maret">Maret</option>
                                    <option value="April">April</option>
                                    <option value="Mei">Mei</option>
                                    <option value="Juni">Juni</option>
                                    <option value="July">July</option>
                                    <option value="Agustus">Agustus</option>
                                    <option value="September">September</option>
                                    <option value="Oktober">Oktober</option>
                                    <option value="November">November</option>
                                    <option value="Desember">Desember</option>
                                </select>

                                <input type="text"  name="tahun<?= $data['id']  ?>" value="2024" class="form-control" >
                                <!-- <input type="text" disabled hidden name="id2" value="<?= $data['id']  ?>" class="form-control" > -->
                            </div>
                            <div class="input-group">
                                <span class="input-group-text"id="basic-addon3">Jam Masuk</span>
                                <input type="text" name="jam_masuk<?= $data['id']  ?>" class="form-control" value="">
                            </div>
                            <div class="input-group">
                                <span class="input-group-text"id="basic-addon3">Lembur</span>
                                <input type="text" name="lembur<?= $data['id']  ?>" class="form-control" value="">
                            </div>
                            <div class="input-group">
                                <span class="input-group-text"id="basic-addon3">Bonus</span>
                                <input type="text" name="bonus<?= $data['id']  ?>" class="form-control" >
                            </div>
                            <div class="input-group">
                                <span class="input-group-text"id="basic-addon3">Catatan</span>
                                <input type="text" name="catatan<?= $data['id']  ?>" class="form-control" >
                            </div>
                            <div class="input-group">
                                <span class="input-group-text"id="basic-addon3">Dibayar</span>
                                <select required name="dibayar<?= $data['id']  ?>" class="form-select" id="">
                                    <option selected disabled value="">Pilih Pembayaran</option>
                                    <option value="Transfer">Transfer</option>
                                    <option value="Tunai">Tunai</option>
                                  
                                </select>
                            </div>
                            <div class="input-group">
                                <span class="input-group-text"id="basic-addon3">Terbilang</span>
                                <input type="text" name="terbilang<?= $data['id']  ?>" class="form-control" >
                            </div>
                            <div class="input-group">
                                <span class="input-group-text"id="basic-addon3">Periode</span>
                                <input type="text" name="periode<?= $data['id']  ?>" class="form-control" >
                            </div>
                            <input type="submit" name="tambah<?= $data['id']  ?>" value="Tambah" class="btn btn-primary mt-2">
                        </form>
                </div>
            </td>
            </tr>
       
        <?php 

        $id = $_POST['id'];
        if(isset($_POST['ubah'])){
            $id_peg = $_POST['id_peg'.$id];
            $nama = $_POST['nama'.$id];
            $jabatan = $_POST['jabatan'.$id];
            $gaji_perjam = $_POST['gaji_perjam'.$id];

          $sql_ubah = $koneksilama->query("
          update tb_karyawan set
            nama = '$nama',
            jabatan = '$jabatan',
            id_peg = '$id_peg',
            gaji_perjam = '$gaji_perjam'
          where id = '$id'
          "); 

          if($sql_ubah){
            ?>
                <script type="text/javascript">
                    // alert("Transaksi Berhasil Ditambah");
                    window.location.href="?page=gaji";
                </script>
          <?php
            }
        }
        
    

        if(isset($_POST['tambah'.$id])){
            $bulan = $_POST['bulan'.$id]." ".$_POST['tahun'.$id];
            $jam_masuk = $_POST['jam_masuk'.$id];
            $lembur = $_POST['lembur'.$id];
            $bonus = $_POST['bonus'.$id];
            $catatan = $_POST['catatan'.$id];
            $periode = $_POST['periode'.$id];
            $terbilang = $_POST['terbilang'.$id];
            $dibayar = $_POST['dibayar'.$id];
          

          $sql_tambah = $koneksilama->query("
          insert into tb_gaji
          (bulan)
          values
          ('$bulan')
          
          "); 

          if($sql_tambah){
            ?>
                <script type="text/javascript">
                    alert("Data Gaji Berhasil Ditambah");
                    window.location.href="?page=gaji";
                </script>
          <?php
            }
        }
        
    }
    ?>
    </tbody>
</table>



    </div>
    <script>
        $('#myTable').DataTable({
            "pageLength": 100,
            
        });
        
        </script>

</body>

</html>

</body>

</html>