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

                <p><?php
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
                    ?></p>
            </div>

            <div class='push'></div>
            <div id='footer'>
                <div id='footerleft'>Admin Systeem</div>

                <div id='footerright'>&copy;Bens Development 2013 - 2014</div>
            </div>
        </body>
    </html>
<?php } ?>