<!DOCTYPE html>
<!-- Jeffrey Hamberg, Joshua van Gelder, Sander van der Stelt-->
<?php
session_start();
if ($_SESSION['login'] != 1)
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
            <title>Admin Systeem</title>
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
                <form method="POST" action="AdminTicketAanmaken.php">
                    <input type="submit" name="Ticket aanmaken" value="Ticket aanmaken">
                </form>
                <form method="POST" action="AdminFactuurAanmaken.php">
                    <input type="submit" name="Factuur aanmaken" value="Factuur aanmaken">
                </form>        
            </div>
            <?php 
                include 'footeradmin.php';
                ?>
        </body>       
    </html>
<?php } ?>
