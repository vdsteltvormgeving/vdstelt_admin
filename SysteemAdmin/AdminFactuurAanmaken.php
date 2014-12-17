
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
            <form method="POST">
                <?php
                include 'link.php';
                date_default_timezone_set('Europe/Amsterdam');
                echo '<label>Datum: </label>' . date('Y-m-d H:i:s') . '<br>';
                $stmt1 = mysqli_prepare($link, "SELECT company_name FROM Customer");
                mysqli_execute($stmt1);
                mysqli_stmt_bind_result($stmt1, $comp);
                ?> <label>Categorie: </label><select id='Categorie' name='categorie'> <?php
                while (mysqli_stmt_fetch($stmt1)) {
                    echo" <label><option value='$comp'>$comp</option></label>";
                }
                ?>
                </select></label> <br>
                <label>Factuur nummer:</label> <input type="text" name="invoicenr"><br>
                <table>
                    <tr><th><label>Omschrijving:</label></th><th><label>Aantal:</label></th><th><label>Prijs:</label></th></tr>
                    <tr><td><input type="text" name="description1"></td><td><input type="text" name="Count1"></td><td><input type="text" name="Price1"></td></tr>
                    <tr><td><input type="text" name="description2"></td><td><input type="text" name="Count2"></td><td><input type="text" name="Price2"></td></tr>
                    <tr><td><input type="text" name="description3"></td><td><input type="text" name="Count3"></td><td><input type="text" name="Price3"></td></tr>
                    <tr><td><input type="text" name="description4"></td><td><input type="text" name="Count4"></td><td><input type="text" name="Price4"></td></tr>
                    <tr><td><input type="text" name="description5"></td><td><input type="text" name="Count5"></td><td><input type="text" name="Price5"></td></tr>
                </table>
                <input type="submit" onclick="history.go(-1)" value="terug" name="terug">
                <input type="submit" name="opslaan" value="opslaan" fromaction="">
            </form>
        </div>

        <?php 
                include 'footeradmin.php';
                ?>
    </body>

</html>

