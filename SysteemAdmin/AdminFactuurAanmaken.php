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
                echo 'datum: ' . date('Y-m-d H:i:s') . '<br>';
                $stmt1 = mysqli_prepare($link, "SELECT company_name FROM Customer");
                mysqli_execute($stmt1);
                mysqli_stmt_bind_result($stmt1, $comp);
                echo "<label>Categorie: </label><select id=''Categorie' name='categorie'>";
                while (mysqli_stmt_fetch($stmt1)) {
                    echo" <option value='$comp]'>$comp</option>";
                }

                echo ' </select></label> <br>';
                ?>
            </form>
        </div>

        <?php 
                include 'footeradmin.php';
                ?>
    </body>
</html>