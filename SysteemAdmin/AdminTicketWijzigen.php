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
                include 'link.php';
                foreach ($_POST["close/wijzig"] AS $ticketid => $notused) {
                    $ticket_id = $ticketid;
                }
                $stmt1 = mysqli_prepare($link, "SELECT customer_id, creation_date, last_change_date, send_date, user_id, C.company_name, U.mail, category, desctription FROM ticket T JOIN customer C On c.customer_id = T.customer_id JOIN User U ON U.user_id = T.user_id WHERE ticket_id=$ticket_id ");
                mysqli_stmt_bind_result($stmt1, $CID, $creation, $lastchanged, $send, $userid, $mail, $compname, $category, $desc);
                mysqli_execute($stmt1);
                echo"
                <form action='' method='POST'>
                    <input type='text value='$CID' name='Customer_ID'><br>
                    Klant:$compname <br>
                    <input type='text' value='$creation' name='Creation Date'><br>
                    <input type='text' value='$lastchanged' name='Last Changed Date'><br>
                    <input type='text' value='$send' name='Send Date to Hosting'><br>
                    <input type='text' value='$userid' name='User ID'><br>
                    Mail:$mail<br>
                    <input type='text' value='$category' name='Category'><br>
                    <textarea cols='4' name='Description'>$desc</textarea><br>";

                echo"

                    <textarea cols='4' name='Reaction'></textarea>";
                ?>
            </form>
            <div class='push'></div>
            <div id='footer'>
                <div id='footerleft'>Admin Systeem</div>

                <div id='footerright'>&copy;Bens Development 2013 - 2014</div>
            </div>
    </body>
    </html>

<?php } ?>