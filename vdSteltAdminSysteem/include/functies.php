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


// Aantal openstaande facturen
    $stmt = mysqli_prepare($link, "SELECT COUNT(status) AS open_factuur FROM factuur");

    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $count);
    mysqli_stmt_fetch($stmt);

    mysqli_stmt_free_result($stmt); // resultset opschonen
    mysqli_stmt_close($stmt); // statement opruimen
    


//Factuur ID en Factuur titel
    $stmt1 = mysqli_prepare($link, "SELECT factuurID, factuurtitel FROM factuur");

    mysqli_stmt_execute($stmt1);
    mysqli_stmt_bind_result($stmt1, $factuurid, $factuurtitel);

?>