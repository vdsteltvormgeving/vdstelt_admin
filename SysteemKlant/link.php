<?php
//$link = mysql_connect("bensdevelopment.nl","bensdeve_project","6IjuyLDT","bensdeve_cmsbackup");
$link = mysqli_connect("localhost","root","usbw","bensdevelopment",3306);
        if($link)   
            {
            
            }       
        else 
            {
            print("Kan helaas geen verbinding maken");
            print(mysqli_connect_error());
            }
?>
