<!-- Joshua van Gelder, Jeffrey Hamberg, Bart Holsappel -->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Admin Systeem</title>
        <link href="stijl.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div id='bovenbalk'>
            <div id='logo'>
                <img src="img/logo-bens.png" alt=""/>
            </div>
            <?php                                        
                    include 'menu.php';                
                ?>

        <div id='content'>

            <h1>ticket beantwoorden</h1>
            <?php include "link.php" ?>
            <p>
                Klant: <?php
                $TicketIDarray = $_POST["ticket_ID"];
                foreach ($TicketIDarray as $Ticket => $notused) {
                    $ticket_ID = $Ticket;
                }
                $query1 = mysqli_prepare($link, "SELECT username FROM User U JOIN Reaction R ON R.user_id = U.user_id WHERE r.ticket_id='$ticket_ID'");
                mysqli_stmt_execute($query1);
                mysqli_stmt_bind_result($query1, $flname);
                while (mysqli_stmt_fetch($query1)) {
                    print($flname);
                }
                ?>
            </p>
            <p>
                Beschrijving: <?php
                $query2 = mysqli_prepare($link, "SELECT description FROM Ticket T JOIN User U ON T.user_id = U.user_id WHERE T.ticket_id='$ticket_ID'");
                mysqli_stmt_execute($query2);
                mysqli_stmt_bind_result($query2, $text);
                while (mysqli_stmt_fetch($query2)) {
                    print($text);
                }
                ?>
            </p>
            <p> Categorie: </p>
            <form method="post" action ="Category">
                <select name="Categorie">
                    <option value="">Categorie</option>
                    <option value="Webapplication">Webapplication</option>
                    <option value="Internetsite">Internetsite</option>
                    <option value="Hosting">Hosting</option>
                </select>
            </form>
            <p>
                Ticket geschreven op:
                <?php
                $query3 = mysqli_prepare($link, "SELECT creation_date FROM Ticket T JOIN User U ON U.user_id=T.user_id WHERE t.ticket_id='$ticket_ID'");
                mysqli_execute($query3);
                mysqli_stmt_bind_result($query3, $cd);
                while (mysqli_stmt_fetch($query3)) {
                    print ($cd);
                }
                ?>
            </p>
            <p>Datum:
                <?php
                date_default_timezone_set('CET');
                $today = date("F j, Y");
                print($today);
                $ticket_ID = 1;
                $query4 = mysqli_prepare($link, "SELECT U.user_id FROM User U JOIN Ticket T ON T.user_id = U.user_id WHERE t.ticket_id=$ticket_ID");
                mysqli_stmt_execute($query4);
                mysqli_stmt_bind_result($query4, $CID);
                ?>
            </p>
            <p>Uw reactie: <br>
                <textarea name="Reactie"></textarea>
            </p>
            <form method="POST" action="AdminKlantInzien.php">
                <INPUT Type="submit" name="CID[<?php
                while (mysqli_stmt_fetch($query4)) {
                    print($CID);
                }
                ?>]" value="Terug" >
            </form>
            <input type="submit" name="edit" value="Ticket wijzigen">
            <input type="submit" name="delete" value="Ticket Verwijderen">
            <input type="submit" value="Beantwoorden">
        </div>

        <div class='push'></div>
        <div id='footer'>
            <div id='footerleft'>Admin Systeem</div>

            <div id='footerright'>&copy;Bens Development 2013 - 2014</div>
        </div>
    </body>
</html>