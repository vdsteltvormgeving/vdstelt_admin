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
                    <h1>ticket beantwoorden</h1>
                    <?php include "link.php" ?>
                    <p>
                        Klant: <?php
                        $TicketIDarray = $_POST["ticket_ID"];
                        foreach ($TicketIDarray as $Ticket => $notused) {
                            $ticket_ID = $Ticket;
                        }
                        $query1 = mysqli_prepare($link, "SELECT username FROM User U JOIN Reaction R ON R.user_ID = U.user_ID WHERE r.ticket_ID='$ticket_ID'");
                        mysqli_stmt_execute($query1);
                        mysqli_stmt_bind_result($query1, $flname);
                        while (mysqli_stmt_fetch($query1)) {
                            print($flname);
                        }
                        ?>
                    </p>
                    <p>
                        Beschrijving: <?php
                        $query2 = mysqli_prepare($link, "SELECT description FROM Ticket T JOIN User U ON T.user_ID = U.user_ID WHERE T.ticket_ID='$ticket_ID'");
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
                        $query3 = mysqli_prepare($link, "SELECT creation_date FROM Ticket T JOIN User U ON U.user_ID=T.user_ID WHERE t.ticket_ID='$ticket_ID'");
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
                        ?>
                    </p>
                    <p>Uw reactie: <br>
                        <textarea name="Reactie"></textarea>
                    </p>
                    <form method="POST" action="AdminTicketOverzicht.php">
                        <INPUT Type="button" VALUE="Terug" onClick="history.go(-1);
                                return true;">
                    </form>
                    <input type="submit" name="edit" value="Ticket wijzigen">
                    <input type="submit" name="delete" value="Ticket Verwijderen">
                    <input type="submit" value="Beantwoorden">
                </div>
                <!--EINDE CONTENT-->
                <footer>
                    <p class="copyright">Copyright © 2014 <b>Bens Development</b>, All Right Reserved.</p>
                </footer>
            </div>
        </body>
    </html>

<?php } ?>

