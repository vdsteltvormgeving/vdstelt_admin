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

                <p><?php
                    include "link.php";



                    $stat = mysqli_prepare($link, "SELECT Company_name, Email, Customer_id FROM customer ORDER BY Customer_id");
                    mysqli_stmt_execute($stat);
                    mysqli_stmt_bind_result($stat, $comname, $mail, $CID);
                    print("<table><tr><th>Bedrijfs naam</th><th>E-mail</th><th></th></tr>");
                    while (mysqli_stmt_fetch($stat)) {
                        print("<tr>" . "<td>" . $comname . "</td>" . "<td>" . $mail . "</td>" . "<td>" . "<form method='POST' action='AdminKlantInzien.php' >" . "<input type='submit' name='CID[$CID]' value='Bekijken'>" . "</form>" . "</td>" . "</tr>");
                    } // Door de name te veranderen naar CID[$CID] kan je hem aanvragen op andere pagina's
                    print ("</table>");
                    ?>
                <form class="knop_link" method="post" action="AdminOverzicht.php">
                    <input type="submit" name="back" value="Terug">
                </form>
            </div>

            <div class='push'></div>
            <div id='footer'>
                <div id='footerleft'>Admin Systeem</div>

                <div id='footerright'>&copy;Bens Development 2013 - 2014</div>
            </div>
        </body>
    </html>
<?php } ?>