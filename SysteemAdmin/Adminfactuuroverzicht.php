<!DOCTYPE html>
<!--Léyon Courtz -->
<?php
session_start();
if ($_SESSION["login"] != 1)
{
    echo 'U moet ingelogd zijn om deze pagina te bekijken';
    session_unset();
    session_destroy();
}
else
{
    ?>
<html>
        <head>
            <meta charset="UTF-8">
            <title>Admin factuuroverzicht</title>
            <link href="stijl.css" rel="stylesheet" type="text/css">
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
                <h1>Facturen</h1>
       <br>
                    <table>
                        <tr>
                            <th>
                                <?php
                                // Met de volgende rijen code wordt bepaald welke sorteerknop we willen hebben. Of we een DESC of een ASC knop hebben.
                                if (isset($_POST["sortcomp"])) {
                                    echo "<form class='table_hdr' method='POST' action='Adminfactuuroverzicht.php'><input type='submit' name='sortcompDESC' value='Klant'></form>";
                                } else {
                                    echo "<form class='table_hdr' method='POST' action='Adminfactuuroverzicht.php'><input type='submit' name='sortcomp' value='Klant'></form>";
                                }
                                ?>
                            </th>
                            <th>
    </div>
            <div class='push'></div>
            <div id='footer'>
                <div id='footerleft'>Admin Systeem</div>
                <div id='footerright'>&copy;Bens Development 2013 - 2014</div>
            </div>
        </body>       
    </html>
<?php } ?>