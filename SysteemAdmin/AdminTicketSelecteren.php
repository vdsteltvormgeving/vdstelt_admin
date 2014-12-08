<!DOCTYPE html>
<!--Joshua van Gelder, Jeffrey Hamberg-->
<?php
session_start();
if ($_SESSION["login"] != 1) {
    echo 'YOU DONT BELONG HERE';
    session_unset();
    session_destroy();
} else {
    ?>
    <html>
        <head>
            <meta charset="UTF-8">
            <title>Admin Systeem</title>
            <link href="stijl.css" rel="stylesheet" type="text/css">
        </head>
        <body>
            <div id='bovenbalk'>
                <div id='logo'>
                    <img src="img/logo-bens.png" alt="">
                </div>
    <?php
    include 'menu.php';
    ?>
            </div>
            <div id='content'>
                <h1>Admin ticket selecteren</h1>
                <div id="ticket">

    <?php
    include "link.php";
    //De Ticked_iD wordt hieronder uit de form gehaald omdat het in array form wordt opgeslagen.
    foreach ($_POST["ticket_id"] AS $ticketid => $notused) {
        $ticket_id = $ticketid;
    }
    //De if loop is hieronder nodig om te true/false status van de ticket om te zetten naar text.
    $stmt1 = mysqli_prepare($link, "SELECT C.company_name, T.category, T.description, T.completed_status, C.customer_id, T.creation_date FROM customer C JOIN ticket T ON C.customer_id = T.customer_id WHERE T.ticket_id=$ticket_id ");
    mysqli_stmt_bind_result($stmt1, $compname, $cat, $desc, $completed, $CID, $creation);
    mysqli_stmt_execute($stmt1);
    while (mysqli_stmt_fetch($stmt1)) {
        echo "<label>Ticket ID: $ticket_id</label><br><label>Klant ID:$compname</label><br><label>Category: $cat</label><br><label>Status:";
        if ($completed == 1) {
            echo "Gesloten";
        } else {
            echo "Open";
        }
        echo "</label><br><label>Customer ID:$CID</label><br><label>Description:$desc</label><label>$creation</label><br>";
    }
    $stmt2 = mysqli_prepare($link, "SELECT time, text, U.mail FROM reaction R JOIN User U ON U.user_id = R.user_ID WHERE R.ticket_id = $ticket_id ORDER BY time ASC ");
    mysqli_stmt_bind_result($stmt2, $time, $text, $mail);
    mysqli_stmt_execute($stmt2);
    while (mysqli_stmt_fetch($stmt2)) {
        echo"<label>Reaction:</label><label>$text</label><label>$time</label><label>$mail</label><br>";
    }
    ?>
                    <form method="POST" action='AdminTicketOverzicht.php'>
                        <input type='submit' name='terug' value='terug'>
                        <input type='submit' name='Wijzigen' formaction='AdminTicketWijzigen.php'>
                    </form>
                    <form method="POST" action="AdminTicketBeantwoorden.php">
                        <input type="submit" name="antwoord" value="ticketbeantwoorden">
                    </form>
                </div>
            </div>
            <div class='push'></div>
            <div id='footer'>
                <div id='footerleft'>Admin Systeem</div>
                <div id='footerright'>&copy;Bens Development 2013 - 2014</div>
            </div>
        </body>
    </html>
<?php } ?>
