<!DOCTYPE html>
<!-- Joshua van Gelder, Sander van der Stelt -->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Overzicht</title>
        <link rel="stylesheet" href="stijl.css" type="text/css"/>
    </head>    
    <body>        
        <div id="container">
            <header>
                <div id="logo">
                    <img src="afbeeldingen/logo-bens.png" alt="Bens Development"/>
                </div>
                <div id="menu">
                    <?php
                    session_start();
                    include 'menu.php';
                    include 'link.php';                    
                    ?>
                </div>
                <div id="content">
                    <form method="POST" action="klantticketaanmaken.php">
                        <input type="submit" name="ticketmaken" value="Ticket aanmaken">
                    </form>
                    <form method="POST" action="klantticketoverzicht.php">
                        <input type="submit" name="ticketinzien" value="Tickets inzien">
                    </form> 
                    <form>
                        <input type="submit" name="loguit" value="Uitloggen">
                    </form>
                    <?php //print($_SESSION['username']."<br>".$_SESSION['password']) ?>
                </div>
            </header>            
        </div>
    </body>
</html>
