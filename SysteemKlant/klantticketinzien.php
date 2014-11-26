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
                <?php include "link.php" ?>
                <p>
                    Klant: <?php
                    $TicketIDarray = $_POST["TicketID"];
                    foreach ($TicketIDarray as $Ticket => $notused) 
                    {
                        $TicketID = $Ticket;
                    }
                    $query1 = mysqli_prepare($link, "SELECT C.first_name, C.last_name FROM Customer C JOIN User U ON T.user_ID = U.user_ID JOIN Ticket T ON U.user_ID=T.customer_ID WHERE T.ticket_ID=$ticketID");
                    mysqli_stmt_execute($query1);
                    mysqli_stmt_bind_result($query1, $fname, $lname);
                    while (mysqli_stmt_fetch($query1)) 
                    {
                        print("$fname $lname");                        
                    }
                    ?>
                </p>
                <p>
                    Beschrijving: <?php
                    $query2 = mysqli_prepare($link, "SELECT description FROM Ticket WHERE ticket_ID=$TicketID");
                    mysqli_stmt_execute($query2);
                    mysqli_stmt_bind_result($query2, $text);
                    while (mysqli_stmt_fetch($query2)) 
                    {
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
                    $query3 = mysqli_prepare($link, "SELECT creation_date FROM ticket WHERE ticket_ID=$TicketID");
                    mysqli_execute($query3);
                    mysqli_stmt_bind_result($query3, $cd);
                    while (mysqli_stmt_fetch($query3)) 
                    {
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
                <form method="POST" action="AdminTicketSelecteren.php">
                    <input type="submit" value="Terug">
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

