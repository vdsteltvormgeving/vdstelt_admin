<!DOCTYPE html>
<!-- Joshua van Gelder, Jeffrey Hamberg, Sander van der Stelt -->
<html>    
    <head>
        <meta charset="UTF-8">
        <title>Bens Developement</title>
        <link href="stijl.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div id="container">
            <header>
                <div id="logo">
                    <img src="afbeeldingen/logo-bens.png" alt="Bens Development"/>
                </div>
                <!--BEGIN MENU-->
                <div id="menu">
                    <?php
                    include 'menu.php';
                    ?>
                </div>
                <!--EINDE MENU-->
            </header>
            <!--BEGIN CONTENT-->
            <div id="content">
                <h1>Ticket inzien</h1>
                <?php
                session_start();
                $username=$_SESSION['username'];
                $password=$_SESSION['password'];
                include "link.php";
                $loginQuery=mysqli_prepare($link, "SELECT user_id FROM User WHERE mail='$username'");
                mysqli_stmt_execute($loginQuery); 
                mysqli_stmt_bind_result($loginQuery, $Login);
                while (mysqli_stmt_fetch($loginQuery))
                {
                    echo $Login;
                }
                mysqli_close($link);
                date_default_timezone_set('CET');
                $datetime = date("F j, Y");  //function to get date and time
                
                include "link.php";
                $stat = mysqli_prepare($link, "SELECT C.customer_id, C.company_name, C.street, C.house_number, c.postal_code,c.city, C.phone_number, C.fax_number, C.emailadress, C.btw_number FROM customer C JOIN Invoice I ON I.customer_id=C.customer_id JOIN User U ON U.user_id=I.user_id WHERE U.user_id = $Login");
                mysqli_stmt_execute($stat);
                mysqli_stmt_bind_result($stat, $customerid, $comnam, $street, $housenr, $postalcode, $city, $phonenr, $faxnr, $mail, $btwnr);
                while(mysqli_stmt_fetch($stat))
                {
                    
                }
                mysqli_close($link);                                
                               
                ?>
                <form method="POST" action="klantticketaanmaken.php">
                    <p> Naam Klant: <?php include"link.php"; echo $Fname . " " . $lname; ?> </p>
                    <br>
                    Klant ID: <?php echo $customerid; ?>
                    <br><!-- dropdown menu -->         
                    <p> 
                        E-mail klant: <?php echo $mail; ?> 
                    </p>
                    <!--<form method="POST" action="">
                        <input type="submit" name="BestandUploaden" value="Bestand Uploaden">
                    </form> -->                  
                    <p> 
                        Datum: <?php echo $datetime;                        
                        ?> 
                    </p>                                        
                    <p>TicketID: <?php echo $TicketID['TicketID']; ?></p>
                    <p>Beschrijving:<?php
                        include "link.php";
                        $query=mysqli_prepare($link, "SELECT description FROM Ticket WHERE user_id=$Login");
                        mysqli_stmt_execute($query);
                        mysqli_stmt_bind_result($query, $description);
                        while(mysqli_stmt_fetch($query))
                        {
                            $descriptions=$description;
                            echo $descriptions;                                           
                        }                        
                        mysqli_close($link);                        
                        ?>                        
                    </p>                    
                </form>
                <form method="POST" action="klantticketoverzicht.php">
                    <input type="submit" name="Back" value="Terug">
                </form><!-- text field and button to send text field and cancel button to go back -->                            
            </div>
            <!--EINDE CONTENT-->
            <footer>
                <p class="copyright">Copyright © 2014 <b>Bens Development</b>, All Right Reserved.</p>
            </footer>
        </div>
    </body>
</html>

