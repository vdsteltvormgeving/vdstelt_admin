<?php
Function($localhost,$username,$password,$database,$port){
$link = mysqli_connect("$localhost","$username","$password" ,"$database","$port");
        if($link)   
        {
            
        }       
        else 
        {
            print("Kan helaas geen verbinding maken");
            print(mysqli_connect_error());
        }
}
?>