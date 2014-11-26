<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
if ($_SESSION["login"] != 1) {
echo 'YOU DONT BELONG HERE';
} else {
session_close()
?>
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
                    session_start();
                    ?>
                </div>
                <!--EINDE MENU-->
            </header>
            <div id="content">
                <h1>Ticket wijzigen</h1>
                <?php  include "link.php" ?>
                        <p>Klant: <?php
                            $query1 =  mysqli_prepare($link, "SELECT username FROM User WHERE user_ID=1" );
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
                             $query2 =  mysqli_prepare($link, "SELECT description FROM Ticket WHERE user_ID = 1" );
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
                    </SELECT></p>      <?php   ?>

                            <p>Ticket geschreven op: <?php
                        $query3 = mysqli_prepare($link, "SELECT creation_date FROM Ticket WHERE user_ID=1" );
                        mysqli_execute ($query3);
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
            </div>
            <footer>
                <p class="copyright">Copyright © 2014 <b>Bens Development</b>, All Right Reserved.</p>
            </footer>
        </div>
    </body>
</html>

<?php } ?>