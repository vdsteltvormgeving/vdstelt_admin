<!DOCTYPE html>
<!--Joshua van Gelder, Jeffrey Hamberg, , Sander van der Stelt-->
<?php
session_start();
if ($_SESSION["login"] != 1) {
    echo 'U moet ingelogd zijn om deze pagina te bekijken';
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
                <h1>Ticket beantwoorden</h1>
                <div id="ticket">
    <?php
    if (isset($_POST["submit"])) {
        $ticket_id = $_POST["ticketid"];
        include "link.php";
        $description = $_POST["beschrijving"];
        $reactionquery = mysqli_prepare($link, "INSERT INTO Reaction SET ticket_id=$ticket_id, text='$description', time=NOW(), user_id=1");
        mysqli_stmt_execute($reactionquery);
        while (mysqli_stmt_fetch($reactionquery)) {

        }
        //header("AdminTicketOverzicht.php");
    } else {
        foreach ($_POST["Beantwoorden"] AS $ticketid => $notused) {
            include "link.php";
            $ticket_id = $ticketid;
            $change = mysqli_prepare($link, "UPDATE ticket SET archived_status = 1 WHERE ticket_id = $ticket_id ");
            mysqli_execute($change);
            mysqli_close($link);
        }
        $username = $_SESSION['username'];
        $password = $_SESSION['password'];
        include "link.php";
        $loginQuery = mysqli_prepare($link, "SELECT user_id FROM User WHERE mail='$username'");
        mysqli_stmt_execute($loginQuery);
        mysqli_stmt_bind_result($loginQuery, $login);
        while (mysqli_stmt_fetch($loginQuery)) {
            $login;
        }
        mysqli_close($link);
        include "link.php";
        //De if loop is hieronder nodig om te true/false status van de ticket om te zetten naar text.
        $stmt1 = mysqli_prepare($link, "SELECT C.company_name, T.category, T.description, T.completed_status, C.customer_id, T.creation_date, R.text, R.time FROM customer C JOIN ticket T ON C.customer_id = T.customer_id JOIN Reaction R ON R.ticket_id = T.ticket_id WHERE T.ticket_id=$ticket_id ORDER BY R.time ASC");
        mysqli_stmt_bind_result($stmt1, $compname, $cat, $desc, $completed, $CID, $creation, $text, $time);
        mysqli_stmt_execute($stmt1);
        while (mysqli_stmt_fetch($stmt1)) {
            echo "<label>Ticket ID: </label><label>$ticket_id</label><br><label>Klant ID: </label><label>$compname</label><br><label>Category: </label><label>$cat</label><br><label>Status: </label><label>";
            if ($completed == 1) {
                echo "Gesloten";
            } else {
                echo "Open";
            }
            echo "</label><br><label>Klant ID:</label><label>$CID</label><br><label><b>Description:</b></label><br><label>$creation</label><br><label>$desc</label><br><label><b>Reactions:</b></label><br><label>$time</label><br><label>$text</label>";
        }
    }
    ?>
                    <br>
                    <form method="POST" action="AdminTicketBeantwoorden.php">
                        Uw antwoord:<br>
                        <textarea name="beschrijving"></textarea><br>
                        <input type="submit" name="submit" value="Beantwoorden">
                    </form>
                    <form method="POST" action='AdminTicketOverzicht.php'>
                        <input type='submit' name='terug' value='terug'>
                        <input type="hidden" name="ticketid['<?php echo "$ticketid"; ?>']">
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
