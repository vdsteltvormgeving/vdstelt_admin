<?php
$link = mysqli_connect("bensdevelopment.nl","bensdeve_project","6IjuyLDT","bensdeve_cmsbackup");
        if($link)   
            {
            
            }       
        else 
            {
            print("Kan helaas geen verbinding maken");
            print(mysqli_connect_error());
            }
?>
