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
                    <h1>Klant Inzien</h1>
                    <?php
                    include "link.php";
                    $customerIDarray = $_POST["CID"];
                    foreach ($customerIDarray as $customer => $troep) {
                        $customerID = $customer;
                    }
                    print("<label>Klant ID:</label><label>00" . $customerID . "</label>");
                    if ($customerID != "") {
                        $stat = mysqli_prepare($link, "SELECT first_name, last_name, email, company_name, adres, residence, iban_nr, kvk_nr, btw_nummer FROM customer WHERE customer_ID = $customerID ");
                        mysqli_stmt_execute($stat);
                        mysqli_stmt_bind_result($stat, $fname, $lname, $email, $comname, $adres, $Res, $IBAN, $KVK, $btw);
                        while (mysqli_stmt_fetch($stat)) {
                            print("<br><label>Bedrijfsnaam:</label><label>$comname</label><br><label>Adres:</label><label>$adres</label><br><label>Email:</label><label>$email</label><br><label>Woonplaats:</label><label>$Res</label><br><label>IBAN nummer:</label><label>$IBAN</label><br><label>KVK nummer:</label><label>$KVK</label><br><label>BTW nummer:</label><label>$btw</label><br>");
                        }
                    } else {
                        print ("customer ID is niet geselecteerd");
                    }
                    mysqli_close($link);
                    ?>
                </div>
                <div>
                    <br>
                    <form method="post" action="AdminKlantOverzicht.php">
                        <input type="submit" name="back" value="Terug">
                    </form>
                    <!--<form>
                        <input type="submit" name="edit" value="Klant Bewerken">
                    </form>-->
                </div>
                <!--EINDE CONTENT-->
                <footer>
                    <p class="copyright">Copyright © 2014 <b>Bens Development</b>, All Right Reserved.</p>
                </footer>
            </div>
        </body>
    </html>

<?php } ?>