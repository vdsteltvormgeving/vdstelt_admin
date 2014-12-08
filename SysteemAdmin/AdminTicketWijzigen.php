<!DOCTYPE html>
<!-- Joshua van Gelder, Jeffrey Hamberg, Daan Hagemans-->
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
                <?php
                // Hieronder wordt gechecked welke POST moet gebruikt worden
                include 'link.php';
                if (isset($_POST["wijzigen"])) {
                    foreach ($_POST["ticket_id"] AS $ticketid => $notused) {
                        $ticket_id = $ticketid;
                    }
                } else {
                    foreach ($_POST["close/wijzig"] AS $ticketid => $notused) {
                        $ticket_id = $ticketid;
                    }
                }
                $stmt1 = mysqli_prepare($link, "SELECT T.customer_id, creation_date, last_time_date, send_date, T.user_id, C.company_name, U.mail, category, description FROM ticket T JOIN customer C On c.customer_id = T.customer_id JOIN User U ON U.user_id = T.user_id WHERE ticket_id=$ticket_id ");
                mysqli_stmt_bind_result($stmt1, $CID, $creation, $lastchanged, $send, $userid, $mail, $compname, $category, $desc);
                mysqli_execute($stmt1);
                while (mysqli_stmt_fetch($stmt1)) {
                    echo"
                <form action='' method='POST'>
                    Customer ID: <input type='text' value='$CID' name='Customer_ID'><br>
                    Klant: $compname <br>
                    Aanmaak Datum: $creation <br>
                    Laatst Gewijzigd: $lastchanged <br>
                    Verzonden Hosting: $send <br>
                    User ID: <input type='text' value='$userid' name='User ID'><br>
                    Mail:$mail<br>
                    Categorie: <input type='text' value='$category' name='Category'><br>
                    Omschrijving:<br> <textarea rows='4' cols='40' name='Description'>$desc</textarea><br>"
                    . "<input type='hidden' name='ticket_id[$ticket_id]'";
                }
                $stmt2 = mysqli_prepare($link, "SELECT text, time, U.mail FROM reaction R JOIN User U ON R.user_id = U.user_id WHERE R.ticket_id = $ticket_id");
                mysqli_stmt_bind_result($stmt2, $text, $time, $mail);
                mysqli_execute($stmt2);
                echo 'Reactions:<br>';
                while (mysqli_stmt_fetch($stmt2)) {
                    echo"
                <textarea rows='4' cols='40' name='Reaction'>$text @ $time --$mail</textarea><br>";
                }
                ?>
                <input type="submit" name="wijzigen" value="wijzigen">

                </form>
                <div class='push'></div>
                <div id='footer'>
                    <div id='footerleft'>Admin Systeem</div>

                    <div id='footerright'>&copy;Bens Development 2013 - 2014</div>
                </div>
        </body>
    </html>

<?php } ?>