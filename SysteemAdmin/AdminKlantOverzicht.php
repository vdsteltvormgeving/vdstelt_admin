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
                <?php                                        
                    include 'menu.php';                
                ?>

            <div id='content'>

                <p><?php
                    include "link.php";



                    $stat = mysqli_prepare($link, "SELECT company_name, emailadress, customer_id FROM Customer ORDER BY customer_id");
                    mysqli_stmt_execute($stat);
                    mysqli_stmt_bind_result($stat, $comname, $mail, $CID);
                    print("<table><tr><th>Bedrijfs naam</th><th>E-mail</th><th></th></tr>");
                    while (mysqli_stmt_fetch($stat)) {
                        print("<form method='POST' action='AdminKlantInzien.php' ><tr><td>$comname</td><td>$mail</td><td><input type='hidden' name=CID[$CID] ><input type='submit' name='submit' value='Bekijken'></form></td></tr>");
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