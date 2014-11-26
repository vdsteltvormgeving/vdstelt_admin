<?php
session_start();
if ($_SESSION["login"] != 1) {
    echo 'YOU DONT BELONG HERE';
} else {
    session_close()
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
                        session_start();
                        ?>
                    </div>
                    <!--EINDE MENU-->
                </header>
                <!--BEGIN CONTENT-->
                <div id="content">
                    <h1>Admin ticket selecteren</h1>
                    <!-- NIEUW GEPLAATSTE CODE-->
                    <?php include "link.php" ?> <!-- Dit maakt connectie met de database -->
                    <div id="ticket">
                        <p>Tickets:</p>
                        <table>
                            <tr>
                                <th>
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
                            $i = 0;
                            if (isset($_POST["sortcat"])) { // Elke if en elseif die hier volgen zijn verschillende clausules voor omhoog en omlaag gesorteerde categorien.
                                $stmt4 = mysqli_prepare($link, " SELECT category, creation_date, completed_status, ticket_ID, C.company_name FROM Ticket T JOIN User U ON T.user_ID = U.user_ID JOIN Customer C On U.user_ID=C.customer_ID ORDER BY category");
                                mysqli_stmt_execute($stmt4);
                                mysqli_stmt_bind_result($stmt4, $category, $creation, $completed, $ticket_ID, $company_name);
                                while (mysqli_stmt_fetch($stmt4)) {
                                    if ($completed == 1) {
                                        $completed = "Betaald";
                                    } else {
                                        $completed = "Niet Betaald";
                                    }
                                    print("<tr><td>$company_name</td><td>$category</td><td>$creation</td><td>$completed</td><td><form><input type='checkbox'</form></td><td><form><input type='checkbox'></form></td><td><form method='POST' action=ticket.php><input type='submit' name='ticket_ID[$ticket_ID]' value='Bekijken'></form></td></tr>");
                                }
                            } elseif (isset($_POST["sortcatDESC"])) {
                                $stmt5 = mysqli_prepare($link, " SELECT category, creation_date, completed_status, ticket_ID, C.company_name FROM Ticket T JOIN User U ON T.user_ID = U.user_ID JOIN Customer C On U.user_ID=C.customer_ID ORDER BY category DESC ");
                                mysqli_stmt_execute($stmt5);
                                mysqli_stmt_bind_result($stmt5, $category, $creation, $completed, $ticket_ID, $company_name);
                                while (mysqli_stmt_fetch($stmt5)) {
                                    if ($completed == 1) {
                                        $completed = "Betaald";
                                    } else {
                                        $completed = "Niet Betaald";
                                    }
                                    print("<tr><td>$company_name</td><td>$category</td><td>$creation</td><td>$completed</td><td><form><input type='checkbox'</form></td><td><form><input type='checkbox'></form></td><td><form method='POST' action=ticket.php><input type='submit' name='ticket_ID[$ticket_ID]' value='Bekijken'></form></td></tr>");
                                }
                            } elseif (isset($_POST["sortct"])) {
                                $stmt6 = mysqli_prepare($link, " SELECT category, creation_date, completed_status, ticket_ID, C.company_name FROM Ticket T JOIN User U ON T.user_ID = U.user_ID JOIN Customer C On U.user_ID=C.customer_ID ORDER BY creation_date ");
                                mysqli_stmt_execute($stmt6);
                                mysqli_stmt_bind_result($stmt6, $category, $creation, $completed, $ticket_ID, $company_name);
                                while (mysqli_stmt_fetch($stmt6)) {
                                    if ($completed == 1) {
                                        $completed = "Betaald";
                                    } else {
                                        $completed = "Niet Betaald";
                                    }
                                    print("<tr><td>$company_name</td><td>$category</td><td>$creation</td><td>$completed</td><td><form><input type='checkbox'</form></td><td><form><input type='checkbox'></form></td><td><form method='POST' action=ticket.php><input type='submit' name='ticket_ID[$ticket_ID]' value='Bekijken'></form></td></tr>");
                                }
                            } elseif (isset($_POST["sortctDESC"])) {
                                $stmt7 = mysqli_prepare($link, " SELECT category, creation_date, completed_status, ticket_ID, C.company_name FROM Ticket T JOIN User U ON T.user_ID = U.user_ID JOIN Customer C On U.user_ID=C.customer_ID ORDER BY creation_date DESC ");
                                mysqli_stmt_execute($stmt7);
                                mysqli_stmt_bind_result($stmt7, $category, $creation, $completed, $ticket_ID, $company_name);
                                while (mysqli_stmt_fetch($stmt7)) {
                                    if ($completed == 1) {
                                        $completed = "Betaald";
                                    } else {
                                        $completed = "Niet Betaald";
                                    }
                                    print("<tr><td>$company_name</td><td>$category</td><td>$creation</td><td>$completed</td><td><form><input type='checkbox'</form></td><td><form><input type='checkbox'></form></td><td><form method='POST' action=ticket.php><input type='submit' name='ticket_ID[$ticket_ID]' value='Bekijken'></form></td></tr>");
                                }
                            } elseif (isset($_POST["sortcomp"])) {
                                $stmt8 = mysqli_prepare($link, " SELECT category, creation_date, completed_status, ticket_ID, C.company_name FROM Ticket T JOIN User U ON T.user_ID = U.user_ID JOIN Customer C On U.user_ID=C.customer_ID ORDER BY company_name ");
                                mysqli_stmt_execute($stmt8);
                                mysqli_stmt_bind_result($stmt8, $category, $creation, $completed, $ticket_ID, $company_name);
                                while (mysqli_stmt_fetch($stmt8)) {
                                    if ($completed == 1) {
                                        $completed = "Betaald";
                                    } else {
                                        $completed = "Niet Betaald";
                                    }
                                    print("<tr><td>$company_name</td><td>$category</td><td>$creation</td><td>$completed</td><td><form><input type='checkbox'</form></td><td><form><input type='checkbox'></form></td><td><form method='POST' action=ticket.php><input type='submit' name='ticket_ID[$ticket_ID]' value='Bekijken'></form></td></tr>");
                                }
                            } elseif (isset($_POST["sortcompDESC"])) {
                                $stmt9 = mysqli_prepare($link, " SELECT category, creation_date, completed_status, ticket_ID, C.company_name FROM Ticket T JOIN User U ON T.user_ID = U.user_ID JOIN Customer C On U.user_ID=C.customer_ID ORDER BY company_name DESC");
                                mysqli_stmt_execute($stmt9);
                                mysqli_stmt_bind_result($stmt9, $category, $creation, $completed, $ticket_ID, $company_name);
                                while (mysqli_stmt_fetch($stmt9)) {
                                    if ($completed == 1) {
                                        $completed = "Betaald";
                                    } else {
                                        $completed = "Niet Betaald";
                                    }
                                    print("<tr><td>$company_name</td><td>$category</td><td>$creation</td><td>$completed</td><td><form><input type='checkbox'</form></td><td><form><input type='checkbox'></form></td><td><form method='POST' action=ticket.php><input type='submit' name='ticket_ID[$ticket_ID]' value='Bekijken'></form></td></tr>");
                                }
                            } elseif (isset($_POST["sortstat"])) {
                                $stmt8 = mysqli_prepare($link, " SELECT category, creation_date, completed_status, ticket_ID, C.company_name FROM Ticket T JOIN User U ON T.user_ID = U.user_ID JOIN Customer C On U.user_ID=C.customer_ID ORDER BY completed_status ");
                                mysqli_stmt_execute($stmt8);
                                mysqli_stmt_bind_result($stmt8, $category, $creation, $completed, $ticket_ID, $company_name);
                                while (mysqli_stmt_fetch($stmt8)) {
                                    if ($completed == 1) {
                                        $completed = "Betaald";
                                    } else {
                                        $completed = "Niet Betaald";
                                    }
                                    print("<tr><td>$company_name</td><td>$category</td><td>$creation</td><td>$completed</td><td><form><input type='checkbox'</form></td><td><form><input type='checkbox'></form></td><td><form method='POST' action=ticket.php><input type='submit' name='ticket_ID[$ticket_ID]' value='Bekijken'></form></td></tr>");
                                }
                            } elseif (isset($_POST["sortstatDESC"])) {
                                $stmt9 = mysqli_prepare($link, " SELECT category, creation_date, completed_status, ticket_ID, C.company_name FROM Ticket T JOIN User U ON T.user_ID = U.user_ID JOIN Customer C On U.user_ID=C.customer_ID ORDER BY completed_status DESC");
                                mysqli_stmt_execute($stmt9);
                                mysqli_stmt_bind_result($stmt9, $category, $creation, $completed, $ticket_ID, $company_name);
                                while (mysqli_stmt_fetch($stmt9)) {
                                    if ($completed == 1) {
                                        $completed = "Betaald";
                                    } else {
                                        $completed = "Niet Betaald";
                                    }
                                    print("<tr><td>$company_name</td><td>$category</td><td>$creation</td><td>$completed</td><td><form><input type='checkbox'</form></td><td><form><input type='checkbox'></form></td><td><form method='POST' action=ticket.php><input type='submit' name='ticket_ID[$ticket_ID]' value='Bekijken'></form></td></tr>");
                                }
                            } else {
                                $stmt10 = mysqli_prepare($link, " SELECT category, creation_date, completed_status, ticket_ID, C.company_name FROM Ticket T JOIN User U ON T.user_ID = U.user_ID JOIN Customer C On U.user_ID=C.customer_ID ");
                                mysqli_stmt_execute($stmt10);
                                mysqli_stmt_bind_result($stmt10, $category, $creation, $completed, $ticket_ID, $company_name);
                                while (mysqli_stmt_fetch($stmt10)) {
                                    if ($completed == 1) {
                                        $completed = "Betaald";
                                    } else {
                                        $completed = "Niet Betaald";
                                    }
                                    print("<tr><td>$company_name</td><td>$category</td><td>$creation</td><td>$completed</td><td><form><input type='checkbox'</form></td><td><form><input type='checkbox'></form></td><td><form method='POST' action=ticket.php><input type='submit' name='ticket_ID[$ticket_ID]' value='Bekijken'></form></td></tr>");
                                }
                            }
                            ?>
                        </table>
                        <br>
                        <form class="knop_link" method="post" action="AdminOverzicht.php">
                            <input type="submit" name="back" value="Terug">
                        </form>
                        <form class="knop_link" method="post" action="editticket.php">
                            <input type="submit" name="edit" value="Ticket Wijzigen">
                        </form>
                        <form>
                            <input class="knop_link" type="submit" name="delete" value="Ticket Verwijderen">
                        </form>
                    </div>
                    <!-- EINDE NIEUW GEPLAATSTE CODE -->
                </div>
                <!--EINDE CONTENT-->
                <footer>
                    <p class="copyright">Copyright Â© 2014 <b>Bens Development</b>, All Right Reserved.</p>
                </footer>
            </div>
        </body>
    </html>

<?php } ?>