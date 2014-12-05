<!-- Joshua van Gelder, Jeffrey Hamberg, Bart Holsappel -->
<?php
session_start();
if ($_SESSION["login"] != 1)
{
    echo 'U moet ingelogd zijn om deze pagina te bekijken.';
    session_unset();
    session_destroy();
}
else
{
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
                <?php
                include 'menu.php';
                ?>
            </div>
            <div id='content'>
                <p><?php
                    include "link.php";
                    $customerIDarray = $_POST["CID"];
                    foreach ($customerIDarray as $customer => $notused)
                    {
                        $customerID = $customer;
                    }
                    echo "<label>Klant ID:</label><label>" . $customerID . "</label>";
                    if ($customerID != "")
                    {
                        $stat = mysqli_prepare($link, "SELECT company_name, street, house_number, postal_code, city, phone_number, fax_number, emailadress, kvk_number, btw_number FROM customer WHERE customer_id = $customerID ");
                        mysqli_stmt_execute($stat);
                        mysqli_stmt_bind_result($stat, $comname, $street, $house, $postal, $city, $phone, $fax, $email, $kvk, $btw);
                        while (mysqli_stmt_fetch($stat))
                        {
                            echo "<br><label>Bedrijfsnaam:</label><label>$comname</label><br><label>Adres:</label><label>" . $street . $house . "</label><br><label>Email:</label><label>$email</label><br><label>Woonplaats:</label><label>$city</label><br><label>Phone:</label><label>$phone</label><br><label>FAX nummer:</label><label>$fax</label><br><label>KVK nummer:</label><label>$kvk</label><br><label>BTW nummer:</label><label>$btw</label>";
                        }
                    }
                    else
                    {
                        echo "customer ID is niet geselecteerd";
                    }

                    mysqli_close($link);
                    ?>
                </p>            
                <p>Tickets:</p>            
                <table>
                    <tr>
                        <!--<th>
                        <?php
                        // Met de volgende rijen code wordt bepaald welke sorteerknop we willen hebben. Of we een DESC of een ASC knop hebben.
                        //if (isset($_POST["sortcomp"]))
                        //{
                        //    echo "<form class='table_hdr' method='POST' action='AdminKlantInzien.php'><input type='submit' name='sortcompDESC' value='Klant'><input type='hidden' name='CID[$customerID]'></form>";
                        //}
                        //else
                        //{
                        //    echo "<form class='table_hdr' method='POST' action='AdminKlantInzien.php'><input type='submit' name='sortcomp' value='Klant'><input type='hidden' name='CID[$customerID]'></form>";
                        //}
                        ?>
                        </th>-->
                        <th>
                            <?php
                            if (isset($_POST["sortcat"]))
                            {
                                echo "<form class='table_hdr' method='POST' action='AdminKlantInzien.php'><input type='submit' name='sortcatDESC' value='Categorie'><input type='hidden' name='CID[$customerID]'></form>";
                            }
                            else
                            {
                                echo "<form class='table_hdr' method='POST' action='AdminKlantInzien.php'><input type='submit' name='sortcat' value='Categorie'><input type='hidden' name='CID[$customerID]'></form>";
                            }
                            ?>
                        </th>
                        <th>
                            <?php
                            if (isset($_POST["sortct"]))
                            {
                                echo "<form class='table_hdr' method='POST' action='AdminKlantInzien.php'><input type='submit' name='sortctDESC' value='Aanmaak Datum'><input type='hidden' name='CID[$customerID]'></form>";
                            }
                            else
                            {
                                echo "<form class='table_hdr' method='POST' action='AdminKlantInzien.php'><input type='submit' name='sortct' value='Aanmaak Datum'><input type='hidden' name='CID[$customerID]'></form>";
                            }
                            ?>
                        </th>
                        <th>
                            <?php
                            if (isset($_POST["sortstat"]))
                            {
                                echo "<form class='table_hdr' method='POST' action='AdminKlantInzien.php'><input type='submit' name='sortstatDESC' value='Status'><input type='hidden' name='CID[$customerID]'></form>";
                            }
                            else
                            {
                                echo "<form class='table_hdr' method='POST' action='AdminKlantInzien.php'><input type='submit' name='sortstat' value='Status'><input type='hidden' name='CID[$customerID]'></form>";
                            }
                            ?>
                        </th>
                        <th></th>                                
                        <th>Bekijken</th>                                
                    </tr>
                    <?php
                    include "link.php";
                    if (isset($_POST["sortcat"]))
                    { // Elke if en elseif die hier volgen zijn verschillende clausules voor omhoog en omlaag gesorteerde categorien.
                        $stmt4 = mysqli_prepare($link, "SELECT C.company_name, T.category, T.creation_date, T.completed_status, T.ticket_id FROM Ticket T JOIN Customer C ON T.customer_id = C.customer_id WHERE T.customer_id=$customerID ORDER BY category");
                        mysqli_stmt_execute($stmt4);
                        mysqli_stmt_bind_result($stmt4, $company_name, $category, $creation, $completed, $ticket_ID);
                        while (mysqli_stmt_fetch($stmt4))
                        {
                            if ($completed == 1)
                            {
                                $completed = "Gesloten";
                            }
                            else
                            {
                                $completed = "Open";
                            }
                            echo "<form><tr><td>$category</td><td>$creation</td><td>$completed</td><td><form method='POST' action='AdminTicketSelecteren.php'><input type='checkbox'</td><td><input type='submit' name='ticket_id[$ticket_ID]' value='Bekijken'></form></td></tr>";
                        }
                    }
                    elseif (isset($_POST["sortcatDESC"]))
                    {
                        $stmt5 = mysqli_prepare($link, "SELECT C.company_name, T.category, T.creation_date, T.completed_status, T.ticket_id FROM Ticket T JOIN Customer C ON T.customer_id = C.customer_id WHERE T.customer_id=$customerID ORDER BY category DESC");
                        mysqli_stmt_execute($stmt5);
                        mysqli_stmt_bind_result($stmt5, $company_name, $category, $creation, $completed, $ticket_ID);
                        while (mysqli_stmt_fetch($stmt5))
                        {
                            if ($completed == 1)
                            {
                                $completed = "Gesloten";
                            }
                            else
                            {
                                $completed = "Open";
                            }
                            echo "<tr><td>$category</td><td>$creation</td><td>$completed</td><td><form method='POST' action='AdminTicketSelecteren.php'><input type='checkbox'</td><td><input type='submit' name='ticket_id[$ticket_ID]' value='Bekijken'></form></td></tr>";
                        }
                    }
                    elseif (isset($_POST["sortct"]))
                    {
                        $stmt6 = mysqli_prepare($link, "SELECT C.company_name, T.category, T.creation_date, T.completed_status, T.ticket_id FROM Ticket T JOIN Customer C ON T.customer_id = C.customer_id WHERE T.customer_id=$customerID ORDER BY creation_date ");
                        mysqli_stmt_execute($stmt6);
                        mysqli_stmt_bind_result($stmt6, $company_name, $category, $creation, $completed, $ticket_ID);
                        while (mysqli_stmt_fetch($stmt6))
                        {
                            if ($completed == 1)
                            {
                                $completed = "Gesloten";
                            }
                            else
                            {
                                $completed = "Open";
                            }
                            echo "<tr><td>$category</td><td>$creation</td><td>$completed</td><td><form method='POST' action='AdminTicketSelecteren.php'><input type='checkbox'</td><td><input type='submit' name='ticket_id[$ticket_ID]' value='Bekijken'></form></tr>";
                        }
                    }
                    elseif (isset($_POST["sortctDESC"]))
                    {
                        $stmt7 = mysqli_prepare($link, "SELECT C.company_name, T.category, T.creation_date, T.completed_status, T.ticket_id FROM Ticket T JOIN Customer C ON T.customer_id = C.customer_id WHERE T.customer_id=$customerID ORDER BY creation_date DESC ");
                        mysqli_stmt_execute($stmt7);
                        mysqli_stmt_bind_result($stmt7, $company_name, $category, $creation, $completed, $ticket_ID);
                        while (mysqli_stmt_fetch($stmt7))
                        {
                            if ($completed == 1)
                            {
                                $completed = "Gesloten";
                            }
                            else
                            {
                                $completed = "Open";
                            }
                            echo "<tr><td>$category</td><td>$creation</td><td>$completed</td><td><form method='POST' action='AdminTicketSelecteren.php'><input type='checkbox'</td><td><input type='submit' name='ticket_id[$ticket_ID]' value='Bekijken'></form></td></tr>";
                        }
                    }
                    elseif (isset($_POST["sortcomp"]))
                    {
                        $stmt8 = mysqli_prepare($link, "SELECT C.company_name, T.category, T.creation_date, T.completed_status, T.ticket_id FROM Ticket T JOIN Customer C ON T.customer_id = C.customer_id WHERE T.customer_id=$customerID ORDER BY company_name ");
                        mysqli_stmt_execute($stmt8);
                        mysqli_stmt_bind_result($stmt8, $company_name, $category, $creation, $completed, $ticket_ID);
                        while (mysqli_stmt_fetch($stmt8))
                        {
                            if ($completed == 1)
                            {
                                $completed = "Gesloten";
                            }
                            else
                            {
                                $completed = "Open";
                            }
                            echo "<tr><td>$category</td><td>$creation</td><td>$completed</td><td><form method='POST' action='AdminTicketSelecteren.php'><input type='checkbox'</td><td><input type='submit' name='ticket_id[$ticket_ID]' value='Bekijken'></form></td></tr>";
                        }
                    }
                    elseif (isset($_POST["sortcompDESC"]))
                    {
                        $stmt9 = mysqli_prepare($link, "SELECT C.company_name, T.category, T.creation_date, T.completed_status, T.ticket_id FROM Ticket T JOIN Customer C ON T.customer_id = C.customer_id WHERE T.customer_id=$customerID ORDER BY company_name DESC ");
                        mysqli_stmt_execute($stmt9);
                        mysqli_stmt_bind_result($stmt9, $company_name, $category, $creation, $completed, $ticket_ID);
                        while (mysqli_stmt_fetch($stmt9))
                        {
                            if ($completed == 1)
                            {
                                $completed = "Gesloten";
                            }
                            else
                            {
                                $completed = "Open";
                            }
                            echo "<tr><td>$category</td><td>$creation</td><td>$completed</td><td><form method='POST' action='AdminTicketSelecteren.php'><input type='checkbox'</td><td><input type='submit' name='ticket_id[$ticket_ID]' value='Bekijken'></form></td></tr>";
                        }
                    }
                    elseif (isset($_POST["sortstat"]))
                    {
                        $stmt8 = mysqli_prepare($link, "SELECT C.company_name, T.category, T.creation_date, T.completed_status, T.ticket_id FROM Ticket T JOIN Customer C ON T.customer_id = C.customer_id WHERE T.customer_id=$customerID ORDER BY completed_status ");
                        mysqli_stmt_execute($stmt8);
                        mysqli_stmt_bind_result($stmt8, $company_name, $category, $creation, $completed, $ticket_ID);
                        while (mysqli_stmt_fetch($stmt8))
                        {
                            if ($completed == 1)
                            {
                                $completed = "Gesloten";
                            }
                            else
                            {
                                $completed = "Open";
                            }
                            echo "<tr><td>$category</td><td>$creation</td><td>$completed</td><td><form method='POST' action='AdminTicketSelecteren.php'><input type='checkbox'</td><td><input type='submit' name='ticket_id[$ticket_ID]' value='Bekijken'></form></td></tr>";
                        }
                    }
                    elseif (isset($_POST["sortstatDESC"]))
                    {
                        $stmt9 = mysqli_prepare($link, "SELECT C.company_name, T.category, T.creation_date, T.completed_status, T.ticket_id FROM Ticket T JOIN Customer C ON T.customer_id = C.customer_id WHERE T.customer_id=$customerID ORDER BY completed_status DESC");
                        mysqli_stmt_execute($stmt9);
                        mysqli_stmt_bind_result($stmt9, $company_name, $category, $creation, $completed, $ticket_ID);
                        while (mysqli_stmt_fetch($stmt9))
                        {
                            if ($completed == 1)
                            {
                                $completed = "Gesloten";
                            }
                            else
                            {
                                $completed = "Open";
                            }
                            echo "<tr><td>$category</td><td>$creation</td><td>$completed</td><td><form method='POST' action='AdminTicketSelecteren.php'><input type='checkbox'</td><td><input type='submit' name='ticket_id[$ticket_ID]' value='Bekijken'></form></td></tr>";
                        }
                    }
                    else
                    {
                        $stmt10 = mysqli_prepare($link, "SELECT C.company_name, T.category, T.creation_date, T.completed_status, T.ticket_id FROM Ticket T JOIN Customer C ON T.customer_id = C.customer_id WHERE T.customer_id=$customerID");
                        mysqli_stmt_execute($stmt10);
                        mysqli_stmt_bind_result($stmt10, $company_name, $category, $creation, $completed, $ticket_ID);
                        while (mysqli_stmt_fetch($stmt10))
                        {
                            if ($completed == 1)
                            {
                                $completed = "Gesloten";
                            }
                            else
                            {
                                $completed = "Open";
                            }
                            echo "<tr><td>$category</td><td>$creation</td><td>$completed</td><td><form method='POST' action='AdminTicketSelecteren.php'><input type='checkbox'</td><td><input type='submit' name='ticket_id[$ticket_ID]' value='Bekijken'></form></td></tr>";
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
            </div>
            <div class='push'></div>
            <div id='footer'>
                <div id='footerleft'>Admin Systeem</div>

                <div id='footerright'>&copy;Bens Development 2013 - 2014</div>
            </div>
        </body>
    </html>
<?php }
?>