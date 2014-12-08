<!DOCTYPE html><?php session_start(); ?>
<!-- Joshua van Gelder, Jeffrey Hamberg, Bart Holsappel, Sander van der Stelt -->
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
                    include 'menubackend.php';
                    ?>
                </div>
                <!--EINDE MENU-->
            </header>
            <!--BEGIN CONTENT-->
            <div id="content">
                <h1>Ticket</h1>
                <?php
                if (isset($_POST["submit"]))
                {
                    $ticket_id = $_POST["ticketid"];
                    include "link.php";
                    $description = $_POST["beschrijving"];
                    $reactionquery = mysqli_prepare($link, "INSERT INTO Reaction SET ticket_id=$ticket_id, text='$description', time=NOW(), user_id=1");
                    mysqli_stmt_execute($reactionquery);
                    while (mysqli_stmt_fetch($reactionquery))
                    {
                        
                    }
                    //header("klantticketoverzicht.php");
                }
                else
                {
                    foreach ($_POST["close/wijzig"] AS $ticketid => $notused)
                    {
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
                    while (mysqli_stmt_fetch($loginQuery))
                    {
                        $login;
                    }
                    mysqli_close($link);
                    include "link.php";
                    //De if loop is hieronder nodig om te true/false status van de ticket om te zetten naar text.
                    $stmt1 = mysqli_prepare($link, "SELECT C.company_name, T.category, T.description, T.completed_status, C.customer_id, T.creation_date, R.text, R.time FROM customer C JOIN ticket T ON C.customer_id = T.customer_id JOIN Reaction R ON R.ticket_id = T.ticket_id WHERE T.ticket_id=$ticket_id ORDER BY R.time ASC");
                    mysqli_stmt_bind_result($stmt1, $compname, $cat, $desc, $completed, $CID, $creation, $text, $time);
                    mysqli_stmt_execute($stmt1);
                    while (mysqli_stmt_fetch($stmt1))
                    {
                        echo "<label>Ticket ID: $ticket_id</label><br><label>Klant ID:$compname</label><br><label>Category: $cat</label><br><label>Status:";
                        if ($completed == 1)
                        {
                            echo "Gesloten";
                        }
                        else
                        {
                            echo "Open";
                        }
                        echo "</label><br><label>Klant ID:$CID</label><br><label>Description:<br>$desc</label><label>$creation</label><br><label>Reactions:<br>$text</label><label>$time</label>";
                    }
                }
                ?>
                <br>
                <form method="POST" action="klantticketbeantwoorden.php">
                    Uw antwoord:<br>
                    <textarea name="beschrijving">                        
                    </textarea>                                                                                        
                    <input type="submit" name="submit" value="Beantwoorden">
                    <input type="hidden" name="ticketid['<?php echo "$ticketid"; ?>']">
                </form>
                <form method="POST" action='klantticketoverzicht.php'>
                    <input type='submit' name='terug' value='terug'>
                    <input type='hidden' name="" value="">
                </form>
            </div>
            <!--EINDE CONTENT-->
        </div>
        <footer>
            <?php include 'footer.php'; ?>
        </footer>
    </body>
</html>

