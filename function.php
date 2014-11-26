<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function connect () {
   $link = mysqli_connect("localhost", "root", "usbw", "bensdevelopment", 3306); 
 if ($link) {
} else {
    print("Kan helaas geen verbinding maken");
print(mysqli_connect_error());} 
return $link;
}



