<?php
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
