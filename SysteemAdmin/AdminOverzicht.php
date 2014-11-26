
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
                    ;
                    include 'menu.php';
                    ?>
                </div>
                <!--EINDE MENU-->
            </header>
            <!--BEGIN CONTENT-->
            <div id="content">
                <form method="POST" action="AdminKlantOverzicht.php">
                    <input type="submit" name="Klanten Overzicht" value="Klanten Overzicht">
                </form>
                <form method="POST" action="AdminTicketOverzicht.php">
                    <input type="submit" name="Ticket Overzicht" value="Ticket Overzicht">
                </form>
            </div>
            <?php
            session_start();
            ?>
            <!--EINDE CONTENT-->
            <footer>
                <p class="copyright">Copyright © 2014 <b>Bens Development</b>, All Right Reserved.</p>
            </footer>
        </div>
    </body>
</html>


