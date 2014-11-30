<!-- Jeffrey Hamberg-->
<?php
session_start();
if ($_SESSION["login"] != 1) {
    echo 'YOU DONT BELONG HERE';
    session_unset();
    session_destroy();
} else {
    ?>
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
            <form method="POST" action="AdminKlantOverzicht.php">
                <input type="submit" name="Klanten Overzicht" value="Klanten Overzicht">
            </form>
            <form method="POST" action="AdminTicketOverzicht.php">
                <input type="submit" name="Ticket Overzicht" value="Ticket Overzicht">
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