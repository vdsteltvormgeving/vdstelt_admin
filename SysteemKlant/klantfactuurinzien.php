<!DOCTYPE html>
<!--Bart Holsappel -->
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
                <?php
                include "link.php";
                session_start();
                $username = $_SESSION['username'];
                $password = $_SESSION['password'];
                $userid   = mysqli_prepare($link, "SELECT user_id FROM User WHERE mail='$username'");
                mysqli_stmt_execute($userid);
                mysqli_stmt_bind_result($userid, $user);
                while (mysqli_stmt_fetch($userid))
                {
                    $userid;
                }
                mysqli_close($link);
                
                ?> <!-- Dit maakt connectie met de database en zorgt voor de start van de inlogsessie -->
                <div id="factuur">
                    <p>Naam: <?php
                        include"link.php";
                        $stmt = mysqli_prepare($link, "SELECT first_name, last_name FROM User WHERE mail='$username'");
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_bind_result($stmt, $fname, $lname);
                        while (mysqli_stmt_fetch($stmt))
                        {
                            echo "$fname $lname <br>";
                        }
                        
                        mysqli_close($link);
                        ?>
                    </p>
                    
                    <p>Adres: <?php
                    include "link.php";
                    $stat1 = mysqli_prepare($link, "SELECT street, house_number, city, kvk_number, btw_number FROM Customer WHERE customer_id = $user");
                mysqli_stmt_execute($stat1);
                mysqli_stmt_bind_result($stat1, $street, $housen, $city, $kvk, $btw);
                while (mysqli_stmt_fetch($stat1)){
                    echo "$street $housen <br>";
                    echo "Woonplaats: $city";
                    
                }
                        
                        mysqli_close($link);
                    ?>
                <p><?php
                    include "link.php";
                    $stat2 = mysqli_prepare($link, "SELECT date FROM invoice WHERE user_id = $user");
                mysqli_stmt_execute($stat2);
                mysqli_stmt_bind_result($stat2, $date);
                while (mysqli_stmt_fetch($stat2)){
                    
                }
                mysqli_close($link);
                    $factuurarray = $_POST["CID"];
                    foreach ($factuurarray as $invoice => $notused)
                    {
                        $invoiceID = $invoice;
                    }
                    echo "<label>Factuur nummer:</label><label>$invoiceID</label>";
                    echo "<br>";
                    echo "<label>Datum:</label><label> $date</label>";
                    ?>
                </p>
                
                <p>Factuur:
                <?php
                $total = 0;
                include"link.php";
                $stmt3 = mysqli_prepare($link, "SELECT line_id, invoice_number, description, description2, amount, price, btw FROM line WHERE invoice_number = $invoiceID");
                mysqli_stmt_execute($stmt3);
                mysqli_stmt_bind_result($stmt3, $lineID, $IN, $D1, $D2, $amount, $price, $BTW);
                echo "<table><th>Beschrijving</th><th>Aantal</th><th>prijs</th>";
                while (mysqli_stmt_fetch($stmt3)){
                   $total = $total + ($amount * $price); 
                   echo "<tr><td>$D1</td><td>$amount</td><td>$price</td></tr>" ;
                   
                }
                $BTWsub = ($BTW/100)+1;
                $totalincbtw = $total * $BTWsub;
                $BTWtotal = $totalincbtw - $total;
                
                echo "<tr><td>Totaal</td><td>€ $total</td></tr>";
                echo "<tr><td>BTW $BTW %</td><td>€ $BTWtotal</td></tr>";
                echo "<tr><td>Totaal inc. btw</td><td>$totalincbtw</td></tr>";
                echo "</table>";
                ?>
                </p>
                <p> IBAN: NL 83 RABO 0344 4625 36 <br>
                    
                <form class="knop_link" method="post" action="Klantfactuurverzicht.php">
                <input type="submit" name="back" value="Terug">
            </form>
                    <br>
        </div>
        </div></div>
        <footer>
        <?php include 'footer.php'; ?>
        </footer>
    </body>
</html>
