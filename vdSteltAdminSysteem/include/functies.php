<?php

$host = 'localhost';
$user = 'root';
$pass = 'usbw';
$db = 'vdstelt_admin';


$link = mysqli_connect($host, $user, $pass, $db, 3306);
if ($link) {
    
} else {
    print("Kan helaas geen verbinding maken!");
    print(mysqli_connect_error());
}

?>
  