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
                $loginQuery=mysqli_prepare($link, "SELECT user_ID FROM User WHERE username='$username'");
                mysqli_stmt_execute($loginQuery); 
                mysqli_stmt_bind_result($loginQuery, $Login);
                while (mysqli_stmt_fetch($loginQuery))
                {
                    print($Login);
                }
                mysqli_close($link);
                date_default_timezone_set('CET');
                $datetime = date("F j, Y");  //function to get date and time
                
                include "link.php";
                $stat = mysqli_prepare($link, "SELECT C.company_name, C.adres, C.residence, C.iban_nr, C.kvk_nr, C.btw_nummer, C.first_name, C.last_name, C.email, C.customer_ID FROM customer C JOIN user U ON U.user_ID=C.customer_ID WHERE U.user_ID = $Login");
                mysqli_stmt_execute($stat);
                mysqli_stmt_bind_result($stat, $comname, $adres, $Res, $IBAN, $KVK, $BTW, $Fname, $lname, $mail, $customerID);
                while(mysqli_stmt_fetch($stat))
                {
                    
                }
                mysqli_close($link);                                
                               
                ?>
                <form method="POST" action="klantticketaanmaken.php">
                    <p> Naam Klant: <?php include"link.php"; print ($Fname . " " . $lname); ?> </p>
                    <br>
                    Klant ID: <?php print ($customerID); ?>
                    <br><!-- dropdown menu -->         
                    <p> 
                        E-mail klant: <?php print ($mail); ?> 
                    </p>
                    <!--<form method="POST" action="">
                        <input type="submit" name="BestandUploaden" value="Bestand Uploaden">
                    </form> -->                  
                    <p> 
                        Datum: <?php print($datetime);
                        mysqli_close($link);
                        ?> 
                    </p>                    
                    <?php
                    include "link.php";                    
                    $stam = mysqli_prepare($link, "SELECT MAX(ticket_ID) FROM ticket");
                    mysqli_stmt_execute($stam);
                    mysqli_stmt_bind_result($stam, $TicketIDcount);
                    mysqli_stmt_fetch($stam); //Get information out of the database
                    $TicketID = $TicketIDcount + 1; //Counting the number of tickets in the database and gives the ticket a uniek ID
                    ?>
                    <p>TicketID: <?php print($TicketID); mysqli_close($link); ?></p>
                    <p>Beschrijving:<?php
                        include "link.php";
                        $query=mysqli_prepare($link, "SELECT description FROM Ticket WHERE user_ID=$Login");
                        mysqli_stmt_execute($query);
                        mysqli_stmt_bind_result($query, $description);
                        mysqli_stmt_fetch($query);                    
                        $descriptions=$description;
                        print($descriptions);                                        
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

