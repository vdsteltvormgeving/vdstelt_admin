<?php
$link = mysqli_connect("localhost","root","usbw","vdstelt_admin",3306);
        if($link)   
        {
            
        }       
        else 
        {
            print("Kan helaas geen verbinding maken");
            print(mysqli_connect_error());
        }
?>