<?php
// Connect to the MySQL database
// include('../../../koneksi/koneksi.php');


// Process the uploaded CSV file
if (isset($_FILES['csvFile']['name'])) {
    $csvFile = $_FILES['csvFile']['tmp_name'];
    $handle = fopen($csvFile, "r");

    // Loop through the CSV data and insert it into the database
    while (($data = fgetcsv($handle, 1000, ";")) != false) {
        $NO = $data[0];
        $AWB = $data[1];
        $TGL_PICK_UP = $data[2];
        $REF_NO = $data[3];
        $SHIPPER = $data[4];
        $CONSIGNEE = $data[5];
        $ALAMAT1 = $data[6];
        $ALAMAT2 = $data[7];
        $ALAMAT3 = $data[8];
        $KOTA_KAB = $data[9];
        $KONTEN = $data[10];
        $CNEE_PHONE_NUMBER = $data[11];
        $COD_Amount = $data[12];
        $Payment_Type = $data[13];
    

        // Insert data into the table
        $sql = "INSERT INTO tb_resi_ncs (
            AWB,
            TGL_PICK_UP,
            REF_NO,
            SHIPPER,
            CONSIGNEE,
            ALAMAT1,
            ALAMAT2,
            ALAMAT3,
            KOTA_KAB,
            KONTEN,
            CNEE_PHONE_NUMBER,
            COD_Amount,
            Payment_Type
            ) VALUES (
            '$AWB',
            '$TGL_PICK_UP',
            '$REF_NO',
            '$SHIPPER',
            '$CONSIGNEE',
            '$ALAMAT1',
            '$ALAMAT2',
            '$ALAMAT3',
            '$KOTA_KAB',
            '$KONTEN',
            '$CNEE_PHONE_NUMBER',
            '$COD_Amount',
            '$Payment_Type'
                )";

        $koneksilama->query($sql);
    }


    if($sql){
        ?> 
        
        <script>
            alert("Data berhasil diupload!");
            window.location.href = "?page=penjualan&aksi=lacak_resi";

        </script>
        
        <?php 
    }
}
$koneksilama->close();
?>
