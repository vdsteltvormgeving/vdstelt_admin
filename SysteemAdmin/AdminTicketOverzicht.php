<!-- Joshua van Gelder, Jeffrey Hamberg-->
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
                    <?php include "link.php" ?> <!-- Dit maakt connectie met de database -->
                <div id="ticket">
                    <p>Tickets:</p>
                    <table>
                        <tr>
                            <th
                            <?php
                            // Met de volgende rijen code wordt bepaald welke sorteerknop we willen hebben. Of we een DESC of een ASC knop hebben.
                            if (isset($_POST["sortcomp"])) {
                                print ("<form class='table_hdr' method='POST' action='AdminTicketOverzicht.php'><input type='submit' name='sortcompDESC' value='Klant'></form>");
                            } else {
                                print ("<form class='table_hdr' method='POST' action='AdminTicketOverzicht.php'><input type='submit' name='sortcomp' value='Klant'></form>");
                            }
                            ?>
                        </th>
                        <th>
                            <?php
                            if (isset($_POST["sortcat"])) {
                                print ("<form class='table_hdr' method='POST' action='AdminTicketOverzicht.php'><input type='submit' name='sortcatDESC' value='Categorie'></form>");
                            } else {
                                print ("<form class='table_hdr' method='POST' action='AdminTicketOverzicht.php'><input type='submit' name='sortcat' value='Categorie'></form>");
                            }
                            ?>
                        </th>
                        <th>
                            <?php
                            if (isset($_POST["sortct"])) {
                                print("<form class='table_hdr' method='POST' action='AdminTicketOverzicht.php'><input type='submit' name='sortctDESC' value='Aanmaak Datum'></form>");
                            } else {
                                print("<form class='table_hdr' method='POST' action='AdminTicketOverzicht.php'><input type='submit' name='sortct' value='Aanmaak Datum'></form>");
                            }
                            ?>
                        </th>
                        <th>
                            <?php
                            if (isset($_POST["sortstat"])) {
                                print("<form class='table_hdr' method='POST' action='AdminTicketOverzicht.php'><input type='submit' name='sortstatDESC' value='Status'></form>");
                            } else {
                                print("<form class='table_hdr' method='POST' action='AdminTicketOverzicht.php'><input type='submit' name='sortstat' value='Status'></form>");
                            }
                            ?>
                        </th>
                        <th>Wijzigen</th>
                        <th>Sluiten</th>
                        <th>Bekijken</th>
                    </tr>
                    <?php
                    include "link.php";
                    if (isset($_POST["sortcat"])) { // Elke if en elseif die hier volgen zijn verschillende clausules voor omhoog en omlaag gesorteerde categorien.
                        $stmt4 = mysqli_prepare($link, "SELECT category, creation_date, completed_status, ticket_id FROM Ticket WHERE customer_id='$customerID' ORDER BY category");
                        mysqli_stmt_execute($stmt4);
                        mysqli_stmt_bind_result($stmt4, $category, $creation, $completed, $ticket_ID);
                        while (mysqli_stmt_fetch($stmt4)) {
                            if ($completed == 1) {
                                $completed = "Betaald";
                            } else {
                                $completed = "Niet Betaald";
                            }
                            echo "<form method='POST' action=TicketKlantInzien.php><tr><td>$company_name</td><td>$category</td><td>$creation</td><td>$completed</td><td><input type='checkbox' name='delete'></td><td><input type='submit' name='ticket_id[$ticket_ID]' value='Bekijken'></form></td></tr>";
                        }
                    } elseif (isset($_POST["sortcatDESC"])) {
                        $stmt5 = mysqli_prepare($link, "SELECT category, creation_date, completed_status, ticket_id FROM Ticket WHERE customer_id='$customerID'ORDER BY category DESC");
                        mysqli_stmt_execute($stmt5);
                        mysqli_stmt_bind_result($stmt5, $category, $creation, $completed, $ticket_ID);
                        while (mysqli_stmt_fetch($stmt5)) {
                            if ($completed == 1) {
                                $completed = "Betaald";
                            } else {
                                $completed = "Niet Betaald";
                            }
                            echo "<form method='POST' action=TicketKlantInzien.php><tr><td>$company_name</td><td>$category</td><td>$creation</td><td>$completed</td><td><input type='checkbox' name='delete'></td><td><input type='submit' name='ticket_id[$ticket_ID]' value='Bekijken'></form></td></tr>";
                        }
                    } elseif (isset($_POST["sortct"])) {
                        $stmt6 = mysqli_prepare($link, " SELECT category, creation_date, completed_status, ticket_id FROM Ticket WHERE customer_id='$customerID' ORDER BY creation_date ");
                        mysqli_stmt_execute($stmt6);
                        mysqli_stmt_bind_result($stmt6, $category, $creation, $completed, $ticket_ID);
                        while (mysqli_stmt_fetch($stmt6)) {
                            if ($completed == 1) {
                                $completed = "Betaald";
                            } else {
                                $completed = "Niet Betaald";
                            }
                            echo "<form method='POST' action=TicketKlantInzien.php><tr><td>$company_name</td><td>$category</td><td>$creation</td><td>$completed</td><td><input type='checkbox' name='delete'></td><td><input type='submit' name='ticket_id[$ticket_ID]' value='Bekijken'></form></td></tr>";
                        }
                    } elseif (isset($_POST["sortctDESC"])) {
                        $stmt7 = mysqli_prepare($link, " SELECT category, creation_date, completed_status, ticket_id FROM Ticket WHERE customer_id='$customerID' ORDER BY creation_date DESC ");
                        mysqli_stmt_execute($stmt7);
                        mysqli_stmt_bind_result($stmt7, $category, $creation, $completed, $ticket_ID);
                        while (mysqli_stmt_fetch($stmt7)) {
                            if ($completed == 1) {
                                $completed = "Betaald";
                            } else {
                                $completed = "Niet Betaald";
                            }
                            echo "<form method='POST' action=TicketKlantInzien.php><tr><td>$company_name</td><td>$category</td><td>$creation</td><td>$completed</td><td><input type='checkbox' name='delete'></td><td><input type='submit' name='ticket_id[$ticket_ID]' value='Bekijken'></form></td></tr>";
                        }
                    } elseif (isset($_POST["sortcomp"])) {
                        $stmt8 = mysqli_prepare($link, " SELECT category, creation_date, completed_status, ticket_id FROM Ticket WHERE customer_id='$customerID' ORDER BY company_name ");
                        mysqli_stmt_execute($stmt8);
                        mysqli_stmt_bind_result($stmt8, $category, $creation, $completed, $ticket_ID);
                        while (mysqli_stmt_fetch($stmt8)) {
                            if ($completed == 1) {
                                $completed = "Betaald";
                            } else {
                                $completed = "Niet Betaald";
                            }
                            echo "<form method='POST' action=TicketKlantInzien.php><tr><td>$company_name</td><td>$category</td><td>$creation</td><td>$completed</td><td><input type='checkbox' name='delete'></td><td><input type='submit' name='ticket_id[$ticket_ID]' value='Bekijken'></form></td></tr>";
                        }
                    } elseif (isset($_POST["sortcompDESC"])) {
                        $stmt9 = mysqli_prepare($link, " SELECT category, creation_date, completed_status, ticket_id FROM Ticket WHERE customer_id='$customerID' ORDER BY company_name DESC ");
                        mysqli_stmt_execute($stmt9);
                        mysqli_stmt_bind_result($stmt9, $category, $creation, $completed, $ticket_ID);
                        while (mysqli_stmt_fetch($stmt9)) {
                            if ($completed == 1) {
                                $completed = "Betaald";
                            } else {
                                $completed = "Niet Betaald";
                            }
                            echo "<form method='POST' action=TicketKlantInzien.php><tr><td>$company_name</td><td>$category</td><td>$creation</td><td>$completed</td><td><input type='checkbox' name='delete'></td><td><input type='submit' name='ticket_id[$ticket_ID]' value='Bekijken'></form></td></tr>";
                        }
                    } elseif (isset($_POST["sortstat"])) {
                        $stmt8 = mysqli_prepare($link, " SELECT category, creation_date, completed_status, ticket_id FROM Ticket WHERE customer_id='$customerID' ORDER BY completed_status ");
                        mysqli_stmt_execute($stmt8);
                        mysqli_stmt_bind_result($stmt8, $category, $creation, $completed, $ticket_ID);
                        while (mysqli_stmt_fetch($stmt8)) {
                            if ($completed == 1) {
                                $completed = "Betaald";
                            } else {
                                $completed = "Niet Betaald";
                            }
                            echo "<form method='POST' action=TicketKlantInzien.php><tr><td>$company_name</td><td>$category</td><td>$creation</td><td>$completed</td><td><input type='checkbox' name='delete'></td><td><input type='submit' name='ticket_id[$ticket_ID]' value='Bekijken'></form></td></tr>";
                        }
                    } elseif (isset($_POST["sortstatDESC"])) {
                        $stmt9 = mysqli_prepare($link, "SELECT category, creation_date, completed_status, ticket_id FROM Ticket WHERE customer_id='$customerID' ORDER BY completed_status DESC");
                        mysqli_stmt_execute($stmt9);
                        mysqli_stmt_bind_result($stmt9, $category, $creation, $completed, $ticket_ID);
                        while (mysqli_stmt_fetch($stmt9)) {
                            if ($completed == 1) {
                                $completed = "Betaald";
                            } else {
                                $completed = "Niet Betaald";
                            }
                            echo "<form method='POST' action=TicketKlantInzien.php><tr><td>$company_name</td><td>$category</td><td>$creation</td><td>$completed</td><td><input type='checkbox' name='delete'></td><td><input type='submit' name='ticket_id[$ticket_ID]' value='Bekijken'></form></td></tr>";
                        }
                    } else {
                        $stmt10 = mysqli_prepare($link, "SELECT category, creation_date, completed_status, ticket_id FROM Ticket WHERE customer_id='$customerID'");
                        mysqli_stmt_execute($stmt10);
                        mysqli_stmt_bind_result($stmt10, $category, $creation, $completed, $ticket_ID);
                        while (mysqli_stmt_fetch($stmt10)) {
                            if ($completed == 1) {
                                $completed = "Betaald";
                            } else {
                                $completed = "Niet Betaald";
                            }
                            echo "<form method='POST' action=TicketKlantInzien.php><tr><td>$company_name</td><td>$category</td><td>$creation</td><td>$completed</td><td><input type='checkbox' name='delete'></td><td><input type='submit' name='ticket_id[$ticket_ID]' value='Bekijken'></form></td></tr>";
                        }
                    }
                    ?>
                </table>
                <br>
                <form class="knop_link" method="post" action="AdminKlantOverzicht.php">
                    <INPUT type="submit" name="terug" value="Terug" >
                </form>
                <form class="knop_link" method="post" action="AdminTicketWijzigen.php">
                    <input type="submit" name="edit" value="Ticket Wijzigen">
                </form>
                <form>
                    <input class="knop_link" type="submit" name="delete" value="Ticket Verwijderen">
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