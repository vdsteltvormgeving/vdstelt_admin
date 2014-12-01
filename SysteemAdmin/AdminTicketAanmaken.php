<!-- Joshua van Gelder, Jeffrey Hamberg, Bart Holsappel -->
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
            <link href="stijl.css" rel="stylesheet" type="text/css"/>
        </head>
        <body>
            <div id='bovenbalk'>
                <div id='logo'>
                    <img src="img/logo-bens.png" alt=""/>
                </div>
                <div id='gebruiker'>
                    <ul id='nav'>
                        <li><a href='#'> <img src='img/gebruiker.png' style='margin-top: -5px;'> <div id='showname'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Admin</div> <img  src='img/pijltje.png' id='pijltje'></a>
                            <ul>

                                <li><a href='#'>Klanten</a></li>
                                <li><a href='#'>Tickets</a></li>
                                <li><a href='#'>Facturen</a></li>
                                <li id='uitloggen'><a href='#'>Uitloggen</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>

            <div id='menu'>

                <div id='pagina'>
                    <a href='#'>Tickets</a>
                </div>

                <div id='module'>
                    <a href='#'>Facturen</a>
                </div>

            </div>

            <div id='content'>

                <p>
                <h1>Ticket aanmaken</h1>
                <?php
                include "link.php";
                $customerID = 1; //name or Id of the customer
                date_default_timezone_set('CET');
                $datetime = date("F j, Y");  //function to get date and time

                $stat = mysqli_prepare($link, "SELECT * FROM customer WHERE customer_id = $customerID");
                mysqli_stmt_execute($stat);
                mysqli_stmt_bind_result($stat, $comname, $adres, $Res, $IBAN, $KVK, $BTW, $Fname, $lname, $mail, $Customer_ID);
                mysqli_stmt_fetch($stat); //Get information out of the database
                ?>
                <form method="GET" action="AdminTicketAanmaken.php">
                    <p> Naam Klant: <?php print ($Fname . " " . $lname); ?> </p>
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
                        Datum: <?php
                        print($datetime);
                        mysqli_close($link);
                        ?>
                    </p>
                    <select id="Categorie" name="Categorie">
                        <option value="">Selecteer Categorie</option>
                        <option value="Webapplication">Webapplication</option>
                        <option value="Internetsite">Internetsite</option>
                        <option value="Hosting">Hosting</option>
                    </select>
                    <?php
                    include "link.php";
                    $result = mysqli_query($link, "SELECT COUNT(ticket_id) FROM Ticket");
                    $stam = mysqli_prepare($link, "SELECT COUNT(ticket_id) FROM Ticket");
                    mysqli_stmt_execute($stam);
                    mysqli_stmt_bind_result($stam, $TicketIDcount);
                    mysqli_stmt_fetch($stam); //Get information out of the database
                    $TicketID = $TicketIDcount + 1; //Counting the number of tickets in the database and gives the ticket a uniek ID
                    ?>
                    <p> Beschrijving:</p><p>TicketID: <?php print($TicketID); ?></p>
                    <textarea name="Beschrijving"></textarea><br>
                    <input type="submit" name="Verzenden" value="Verzenden">
                </form>
                <form method="GET" action="AdminKlantOverzicht.php">
                    <input type="submit" name="Annuleren" value="Annuleren">
                </form><!-- text field and button to send text field and cancel button to go back -->
                <?php
                include"link.php";
                if (isset($_GET["Verzenden"])) {
                    $description = $_GET["Beschrijving"];
                    $category = $_GET["Categorie"];
                    if ($description == "" || $category == "") {
                        print ("Er is geen categorie en/of beschrijving gegeven.");
                    } else {
                        print("Beschrijving = " . $description . "<br>");
                        print("Categorie = " . $category . "<br>");
                    }
                    //$stat = mysqli_prepare($link, "INSERT INTO ticket VALUES (?,?,?,?,?,?,?,?,?, ?)");
                    //mysqli_stmt_bind_param($stat, "sssssssss", $TicketID, $category, $datetime, $datetime, $description, $datetime, $customerID, 0, 0, NUll);
                    //mysqli_stmt_execute($stat);
                    //mysqli_close($link);
                }
                ?>
                <form class="knop_link" method="post" action="AdminTicketOverzicht.php">
                    <input type="submit" name="back" value="Terug">
                </form>
            </p>
        </div>

        <div class='push'></div>
        <div id='footer'>
            <div id='footerleft'>Admin Systeem</div>

            <div id='footerright'>&copy;Bens Development 2013 - 2014</div>
        </div>
    </body>
    </html>

<?php } ?>