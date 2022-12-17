<?php

include 'koneksi.php';

$kdkec = $_POST['kdkec'];
 
$sqlkel = "SELECT * FROM villages WHERE district_id = '$kdkec' ORDER BY name ASC";
$rstkel = mysqli_query($con, $sqlkel);

if ($rstkel->num_rows > 0 ) {
    $output = "<option value=''>-- Pilih Kelurahan --</option>";
    while($rwkel = mysqli_fetch_array($rstkel)) {
        $output = $output."<option value=".$rwkel['id'].">".$rwkel['name']."</option>";
    }
    
    echo $output;
} else {
    $output = "<option value=''>-- Pilih Kelurahan --</option>";
    echo $output;
}


?>