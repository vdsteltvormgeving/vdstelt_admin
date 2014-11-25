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
                <h1>Klant inzien</h1>
                <!-- ongebruikte code
                <form method="POST" action="Admin-klant-inzien.php">
                    <input type="text" name="zoeken" value="">
                    <input type="submit" name="Zoeken" value="Zoeken">
                </form>
                -->
                <?php
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
            <!--EINDE CONTENT-->
            <footer>
                <p class="copyright">Copyright © 2014 <b>Bens Development</b>, All Right Reserved.</p>
            </footer>
        </div>
    </body>
</html>

