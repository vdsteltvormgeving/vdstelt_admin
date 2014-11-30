<!-- Joshua van Gelder, Jeffrey Hamberg, Daan-->
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
                <h1>Ticket wijzigen</h1>
                <?php include "link.php" ?>
                <p>Klant: <?php
                    $query1 = mysqli_prepare($link, "SELECT username FROM User WHERE user_ID=1");
                    mysqli_stmt_execute($query1);
                    mysqli_stmt_bind_result($query1, $Username);
                    while (mysqli_stmt_fetch($query1)) {
                        print($Username);
                    }
                    ?> </p>
                <p>Categorie: <form METHOD="post" ACTION ="Category">
                    <SELECT NAME="Categorie">
                        <option value="Select Category">Select categorie</option>
                        <option value="Category1">Category1</option>
                        <option value="Category2">Category2</option>
                        <option value="Category3">Category3</option>
                        <option value="Category4">Category4</option>
                        <option value="Category5">Category5</option>
                    </SELECT>
                </form></p>
            <p>Beschrijving:  <?php
                $query2 = mysqli_prepare($link, "SELECT description FROM Ticket WHERE user_ID = 1");
                mysqli_execute($query2);
                mysqli_stmt_bind_result($query2, $Text);
                While (mysqli_stmt_fetch($query2)) {
                    print($Text);
                }
                ?> </p>

            <p> Categorie wijzigen:  <form METHOD="post" ACTION ="Ticketwijzigingen">
                <SELECT NAME="Categorie wijzigen">
                    <option value="Select Category">Categorie</option>
                    <option value="Category1">Category1</option>
                    <option value="Category2">Category2</option>
                    <option value="Category3">Category3</option>
                    <option value="Category4">Category4</option>
                    <option value="Category5">Category5</option>
                </SELECT></p>      <?php ?>

                <p>Ticket geschreven op: <?php
                    $query3 = mysqli_prepare($link, "SELECT creation_date FROM Ticket WHERE user_ID=1");
                    mysqli_execute($query3);
                    mysqli_stmt_bind_result($query3, $creation_date);
                    while (mysqli_stmt_fetch($query3)) {
                        print($creation_date);
                    }
                    ?>
                </p>
                <p>Datum: <?php
                    date_default_timezone_set('CET');
                    $today = date("F j, Y");
                    print($today);
                    ?>      </p>
                <p>Uw reactie: <textarea>  </textarea> </p>

                <form method="POST" action="">
                    <input type="submit" name="back" value="Terug" >
                    <?php
                    include "link.php";
                    /*
                      de code voor de submitknop: 'terug' komt hier te staan:
                     */
                    ?>
                </form>
                <form method="POST" action="">
                    <input type="submit" name = "Close ticket" value="Ticket sluiten">
                    <?php
                    include "link.php";
                    /*
                      de code voor de submitknop: 'Ticket sluiten' komt hier te staan:
                     */
                    ?>
                </form>
                <form method="POST" action="">
                    <input type="submit" name="sumbit changes" value="Wijzigingen doorvoeren">
                    <?php
                    include "link.php";
                    /*
                      de code voor de submitknop: 'Wijzigingen doorvoeren' komt hier te staan:
                     */
                    ?>
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