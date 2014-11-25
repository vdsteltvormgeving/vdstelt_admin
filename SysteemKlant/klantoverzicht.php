<!DOCTYPE html>
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
                </div>
            </header>            
        </div>
    </body>
</html>
