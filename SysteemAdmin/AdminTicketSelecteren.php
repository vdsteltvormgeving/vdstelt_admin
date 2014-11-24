<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ticket Select</title>
        <link type="text/css" href="style.css" rel="stylesheet">
    </head>
    <body>
        <?php include "link.php" ?> <!-- Dit maakt connectie met de database -->        
        <div>
            <p>Klant I.D.: 00<?php             
            $stmt1=mysqli_prepare($link,"SELECT Customer_id FROM user WHERE Is_admin=1"); //Code nog niet af, er moet hier nog een login connectie komen die nog niet bestaad omdat we nog geen connectie hebben met de database van de opdrachtgever.
            mysqli_stmt_execute($stmt1); 
            mysqli_stmt_bind_result($stmt1,$customerID);
            while(mysqli_stmt_fetch($stmt1))
                {
                    print ($customerID);
                }
            ?>
            </p>
            <br>
            <p>
            Bedrijfsnaam:
            <?php            
            $stmt2=mysqli_prepare($link, " SELECT C.Company_name FROM customer C JOIN user U ON U.Customer_id=C.Customer_id WHERE C.Customer_id='$customerID' "); //Code nog niet af, er moet hier nog een login connectie komen die nog niet bestaad omdat we nog geen connectie hebben met de database van de opdrachtgever.
            mysqli_stmt_execute($stmt2);
            mysqli_stmt_bind_result($stmt2,$name);
            while(mysqli_stmt_fetch($stmt2))
                {
                    print ($name);
                }
            ?>            
            </p>
            <p>
            Datum:
            <?php                        
            $stmt3=mysqli_prepare($link, " SELECT Time FROM reaction WHERE Customer_id='$customerID' "); //Code nog niet af, er moet hier nog een login connectie komen die nog niet bestaad omdat we nog geen connectie hebben met de database van de opdrachtgever.
            mysqli_stmt_execute($stmt3);
            mysqli_stmt_bind_result($stmt3,$time);
            while(mysqli_stmt_fetch($stmt3))
                {
                    print ($time);
                }            
            ?>
            </p>
            <br>
            <br>
            <p>Tickets:</p>
            <table>
                <tr>
                    <th></th>
                    <th>
                    <?php // Met de volgende rijen code wordt bepaald welke sorteerknop we willen hebben. Of we een DESC of een ASC knop hebben.
                        if(isset($_POST["sortcat"]))
                        {
                            print ("<form method='POST' action='AdminTicketSelecteren.php'><input type='submit' name='sortcatDESC' value='Categorie'></form>");
                        }
                        else
                        {
                            print ("<form method='POST' action='AdminTicketSelecteren.php'><input type='submit' name='sortcat' value='Categorie'></form>");
                        }
                    ?>
                    </th>
                    <th>
                    <?php
                        if(isset($_POST["sortct"]))
                        {
                            print("<form method='POST' action='AdminTicketSelecteren.php'><input type='submit' name='sortctDESC' value='Aanmaak Datum'></form>");
                        }
                        else
                        {
                            print("<form method='POST' action='AdminTicketSelecteren.php'><input type='submit' name='sortct' value='Aanmaak Datum'></form>");
                        }
                    ?>                    
                    </th>
                    <th>
                    <?php
                        if(isset($_POST["sortstat"]))
                        {
                            print("<form method='POST' action='AdminTicketSelecteren.php'><input type='submit' name='sortstatDESC' value='Status'></form>");
                        }
                        else
                        {
                            print("<form method='POST' action='AdminTicketSelecteren.php'><input type='submit' name='sortstat' value='Status'></form>");
                        }
                    ?>                
                    </th>
                    <th>Wijzigen</th>                    
                    <th>Sluiten</th>
                    <th>Bekijken</th>
                </tr>                
                <?php
                $i=0;
                    if(isset($_POST["sortcat"])) // Elke if en elseif die hier volgen zijn verschillende clausules voor omhoog en omlaag gesorteerde categorien.
                    {
                        $stmt4=mysqli_prepare($link, " SELECT T.ticketID, T.Category, T.Creation_Date, T.Completed_Status FROM ticket T ORDER BY T.Category "); 
                        mysqli_stmt_execute($stmt4); 
                        mysqli_stmt_bind_result($stmt4, $ticketname, $category, $creation, $completed);
                        while(mysqli_stmt_fetch($stmt4))
                        {                        
                            if($completed==1)
                            {
                                $completed="Betaald";
                            }
                            else
                            {
                                $completed="Niet Betaald";
                            }
                            print("<tr><td>$ticketname</td><td>$category</td><td>$creation</td><td>$completed</td><td><form><input type='checkbox'</form></td><td><form><input type='checkbox'></form></td><td><form method='POST' action=ticket.php><input type='submit' name=".$i++." value='Bekijken'></form></td></tr>");                            
                        }                       
                    }
                    elseif(isset($_POST["sortcatDESC"]))
                    {
                        $stmt5=mysqli_prepare($link, " SELECT T.ticketID, T.Category, T.Creation_Date, T.Completed_Status FROM ticket T ORDER BY T.Category DESC "); 
                        mysqli_stmt_execute($stmt5); 
                        mysqli_stmt_bind_result($stmt5, $ticketname, $category, $creation, $completed);
                        while(mysqli_stmt_fetch($stmt5))
                        {                        
                            if($completed==1)
                            {
                                $completed="Betaald";
                            }
                            else
                            {
                                $completed="Niet Betaald";
                            }
                            print("<tr><td>$ticketname</td><td>$category</td><td>$creation</td><td>$completed</td><td><form><input type='checkbox'</form></td><td><form><input type='checkbox'></form></td><td><form method='POST' action=ticket.php><input type='submit' name=".$i++." value='Bekijken'></form></td></tr>");                            
                        }
                    }
                    elseif(isset($_POST["sortct"]))
                    {
                        $stmt6=mysqli_prepare($link, " SELECT T.ticketID, T.Category, T.Creation_Date, T.Completed_Status FROM ticket T ORDER BY T.Creation_Date "); 
                        mysqli_stmt_execute($stmt6); 
                        mysqli_stmt_bind_result($stmt6, $ticketname, $category, $creation, $completed);
                        while(mysqli_stmt_fetch($stmt6))
                        {                        
                            if($completed==1)
                            {
                                $completed="Betaald";
                            }
                            else
                            {
                                $completed="Niet Betaald";
                            }
                            print("<tr><td>$ticketname</td><td>$category</td><td>$creation</td><td>$completed</td><td><form><input type='checkbox'</form></td><td><form><input type='checkbox'></form></td><td><form method='POST' action=ticket.php><input type='submit' name=".$i++." value='Bekijken'></form></td></tr>");                            
                        }
                    }
                    elseif(isset($_POST["sortctDESC"]))
                    {
                        $stmt7=mysqli_prepare($link, " SELECT T.ticketID, T.Category, T.Creation_Date, T.Completed_Status FROM ticket T ORDER BY T.Creation_Date DESC "); 
                        mysqli_stmt_execute($stmt7); 
                        mysqli_stmt_bind_result($stmt7, $ticketname, $category, $creation, $completed);
                        while(mysqli_stmt_fetch($stmt7))
                        {                        
                            if($completed==1)
                            {
                                $completed="Betaald";
                            }
                            else
                            {
                                $completed="Niet Betaald";
                            }
                                print("<tr><td>$ticketname</td><td>$category</td><td>$creation</td><td>$completed</td><td><form><input type='checkbox'</form></td><td><form><input type='checkbox'></form></td><td><form method='POST' action=ticket.php><input type='submit' name=".$i++." value='Bekijken'></form></td></tr>");                            
                        }
                    }                    
                    elseif(isset($_POST["sortstat"]))
                    {
                        $stmt8=mysqli_prepare($link, " SELECT T.ticketID, T.Category, T.Creation_Date, T.Completed_Status FROM ticket T ORDER BY T.Completed_Status "); 
                        mysqli_stmt_execute($stmt8); 
                        mysqli_stmt_bind_result($stmt8, $ticketname, $category, $creation, $completed);
                        while(mysqli_stmt_fetch($stmt8))
                        {                        
                            if($completed==1)
                            {
                                $completed="Betaald";
                            }
                            else
                            {
                                $completed="Niet Betaald";
                            }
                            print("<tr><td>$ticketname</td><td>$category</td><td>$creation</td><td>$completed</td><td><form><input type='checkbox'</form></td><td><form><input type='checkbox'></form></td><td><form method='POST' action=ticket.php><input type='submit' name=".$i++." value='Bekijken'></form></td></tr>");                        
                        }                        
                    }
                    elseif(isset($_POST["sortstatDESC"]))
                    {
                        $stmt9=mysqli_prepare($link, " SELECT T.ticketID, T.Category, T.Creation_Date, T.Completed_Status FROM ticket T ORDER BY T.Completed_Status DESC "); 
                        mysqli_stmt_execute($stmt9); 
                        mysqli_stmt_bind_result($stmt9, $ticketname, $category, $creation, $completed);
                        while(mysqli_stmt_fetch($stmt9))
                        {                        
                            if($completed==1)
                            {
                                $completed="Betaald";
                            }
                            else
                            {
                                $completed="Niet Betaald";
                            }
                            print("<tr><td>$ticketname</td><td>$category</td><td>$creation</td><td>$completed</td><td><form><input type='checkbox'</form></td><td><form><input type='checkbox'></form></td><td><form method='POST' action=ticket.php><input type='submit' name=".$i++." value='Bekijken'></form></td></tr>");                            
                        }
                    }
                    else 
                    {
                        $stmt10=mysqli_prepare($link, " SELECT T.ticketID, T.Category, T.Creation_Date, T.Completed_Status FROM ticket T "); 
                        mysqli_stmt_execute($stmt10); 
                        mysqli_stmt_bind_result($stmt10, $ticketname, $category, $creation, $completed);
                        while(mysqli_stmt_fetch($stmt10))
                        {                        
                            if($completed==1)
                            {
                                $completed="Betaald";
                            }
                            else
                            {
                                $completed="Niet Betaald";
                            }
                            print("<tr><td>$ticketname</td><td>$category</td><td>$creation</td><td>$completed</td><td><form><input type='checkbox'</form></td><td><form><input type='checkbox'></form></td><td><form method='POST' action=ticket.php><input type='submit' name=".$i++." value='Bekijken'></form></td></tr>");                        
                        }     
                    }
                ?>                    
            </table>
            <br>            
            <form method="post" action="login.php">
                <input type="submit" name="back" value="Terug">
            </form>
            <form method="post" action="editticket.php">
                <input type="submit" name="edit" value="Ticket Wijzigen">
            </form>
            <form>
                <input type="submit" name="delete" value="Ticket Verwijderen">
            </form>
        </div>        
    </body>
</html>
