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
            <form method="POST" >

                <?php
                include 'link.php';
                date_default_timezone_set('Europe/Amsterdam');
                echo '<label>Datum: </label>' . date('Y-m-d') . '<br>';
                $stmt1 = mysqli_prepare($link, "SELECT company_name FROM Customer");
                mysqli_execute($stmt1);
                mysqli_stmt_bind_result($stmt1, $comp);
                ?> <label>Bedrijfsnaam: </label><select id='Bedrijfsnaam' name='Bedrijfsnaam'> <?php
                    while (mysqli_stmt_fetch($stmt1)) {
                        echo"<option value='$comp'>$comp</option>";
                    }
                    ?>
                </select></label> <br>
                <label>Factuur nummer:</label> <input type="number" name="invoicenr" value="<?php
                if (isset($_POST["submit"])) {
                    echo $_POST["invoicenr"];
                }
                ?>"><br>
                <table>
                    <tr><th><label>Omschrijving:</label></th><th><label>Aantal:</label></th><th><label>Prijs:</label></th></tr>
                    <tr><td><input type="text" name="description1" value="<?php
                            if (isset($_POST["submit"])) {
                                echo $_POST["description1"];
                            }
                            ?>"></td><td><input type="number" name="Count1" value="<?php
                                if (isset($_POST["submit"])) {
                                    echo $_POST["Count1"];
                                }
                                ?>"></td><td><input type="number" name="Price1" value="<?php
                                       if (isset($_POST["submit"])) {
                                           echo $_POST["Price1"];
                                       }
                                       ?>"></td></tr>
                    <tr><td><input type="text" name="description2" value="<?php
                            if (isset($_POST["submit"])) {
                                echo $_POST["description2"];
                            }
                            ?>"></td><td><input type="number" name="Count2" value="<?php
                                if (isset($_POST["submit"])) {
                                    echo $_POST["Count2"];
                                }
                                ?>"></td><td><input type="number" name="Price2" value="<?php
                                       if (isset($_POST["submit"])) {
                                           echo $_POST["Price2"];
                                       }
                                       ?>"></td></tr>
                    <tr><td><input type="text" name="description3" value="<?php
                            if (isset($_POST["submit"])) {
                                echo $_POST["description3"];
                            }
                            ?>"></td><td><input type="number" name="Count3" value="<?php
                                if (isset($_POST["submit"])) {
                                    echo $_POST["Count3"];
                                }
                                ?>"></td><td><input type="number" name="Price3" value="<?php
                                       if (isset($_POST["submit"])) {
                                           echo $_POST["Price3"];
                                       }
                                       ?>"></td></tr>
                    <tr><td><input type="text" name="description4" value="<?php
                            if (isset($_POST["submit"])) {
                                echo $_POST["description4"];
                            }
                            ?>"></td><td><input type="number" name="Count4" value="<?php
                                if (isset($_POST["submit"])) {
                                    echo $_POST["Count4"];
                                }
                                ?>"></td><td><input type="number" name="Price4" value="<?php
                                       if (isset($_POST["submit"])) {
                                           echo $_POST["Price4"];
                                       }
                                       ?>"></td></tr>
                    <tr><td><input type="text" name="description5" value="<?php
                            if (isset($_POST["submit"])) {
                                echo $_POST["description5"];
                            }
                            ?>"></td><td><input type="number" name="Count5" value="<?php
                                if (isset($_POST["submit"])) {
                                    echo $_POST["Count5"];
                                }
                                ?>"></td><td><input type="number" name="Price5" value="<?php
                                       if (isset($_POST["submit"])) {
                                           echo $_POST["Price5"];
                                       }
                                       ?>"></td></tr>

            <?php
            if (isset($_POST["submit"])) {

                if ($_POST['invoicenr'] == "") {
                    echo 'Invoicenummer moet ingevult worden.';
                } elseif ($_POST["description1"] == "" && $_POST["Price1"] == "" && $_POST["Count1"] == "") {
                    echo "Begin bij de eerste regel met invullen.";
                } else {
                    $invoicenr = $_POST['invoicenr'];
                    $test1 = 1;// test wordt aangemaakt om te checken of beide tests goed zijn uitgevuld. voornamelijk voor het testen van de code
                    for ($i = 1; $i <= 5; $i++) { // for loop zodat alle regels van de if niet handmatig moeten worden geschreven
                        if ($_POST['description' . $i] == "" && $_POST['Count' . $i] == "" && $_POST['Price' . $i] != "" || $_POST['Price' . $i] == "" && $_POST['Count' . $i] == "" && $_POST['description' . $i] != "" || $_POST['description' . $i] == "" && $_POST['Price' . $i] == "" && $_POST['Count' . $i] != "" || $_POST['description' . $i] == "" && $_POST['Count' . $i] != "" && $_POST['Price' . $i] != "" || $_POST['Count' . $i] == "" && $_POST['description' . $i] != "" && $_POST['Price' . $i] != "" || $_POST['Price' . $i] == "" && $_POST['Count' . $i] != "" && $_POST['description' . $i] != "") {
                            echo 'factuur regel ' . $i . ' is niet goed ingevuld.<br>';
                            $test2 = 0;
                            break 1;
                        } else {
                            $test2 = 1;
                            
                        }
                    }
                    if ($test1 == 1 && $test2 == 1) {
                        echo 'success';
                        /*$compname = $_POST['bedrijfsnaam'];
                        $stmt2 = mysqli_prepare($link, "SELECT customer_id FROM Customer WHERE company_name = ?");
                        mysqli_stmt_bind_param($stmt2, 's ', $compname);
                        $stmt3 = mysqli_prepare($link, "Insert into "); */
                    }
                }
            }
            ?>
                                    </table>
                <input type="submit" formaction="AdminOverzicht.php" value="terug" name="terug">
                <input type="submit" name="submit" value="opslaan" onclick="this.form.submit">
            </form>
        </div>
    </body>
</html>
