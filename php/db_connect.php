<?php

$host = "localhost";
$user="root";
$pass="";
$db="moda_db_sliit_y1_s2_wad";
$conn=new mysqli($host, $user, $pass, $db);
if($conn->connect_error){
    echo "Failed to connect DB".$conn->connect_error;
}
?>
