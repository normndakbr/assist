<?php

include 'koneksi.php';

$kdkota = $_POST['kdkota'];

$sqlkec = "SELECT * FROM districts WHERE regency_id = '$kdkota' ORDER BY name ASC";
$rstkec = mysqli_query($con, $sqlkec);

if ($rstkec->num_rows > 0 ) {
    $output = "<option value=''>-- Pilih Kacamatan --</option>";
    while($rwkec = mysqli_fetch_array($rstkec)) {
        $output = $output."<option value=".$rwkec['id'].">".$rwkec['name']."</option>";
    }
    
    echo $output;
} else {
    $output = "<option value=''>-- Pilih Kacamatan --</option>";
    echo $output;
}


?>