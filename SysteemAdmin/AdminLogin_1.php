<html>
    <head>
        <meta charset="UTF-8">
        <title>Bens Developement</title>
        <link href="stijl.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div id='bovenbalk'>

            <div id='logo'>    
                <img src="img/logo-bens.png" alt=""/>
            </div>
            <?php
            session_start(); //start sessie
            if (isset($_POST["login"])) {
                $username = $_POST["username"];
                $password = $_POST["password"];
                $login = $_POST["login"];
                if (empty($username) || empty($password) || empty($username) && empty($password)) {
                    $error = "Gebruikersnaam of Wachtwoord verkeerd.";
                    print($error);
                } else {
                    if (isset($login)) {
                        $username = $_POST["username"];
                        $password = $_POST["password"];
                        $result = mysqli_query($link, "SELECT username, password FROM User WHERE username='$username' AND password='$password'");
                        $login1 = mysqli_prepare($link, "SELECT username, password FROM User WHERE username=? AND password=?");
                        mysqli_stmt_bind_param($login1, 'ss', $username, $password);
                        mysqli_stmt_execute($login1);
                        $rows = mysqli_num_rows($result);
                        $_SESSION['username'] = $_POST['username'];
                        $_SESSION['password'] = $_POST['password'];
                        print($_SESSION['username']);
                        if ($rows == 1) {

                            header("location: AdminOverzicht.php");
                        } else {
                            $error = "Gebruikersnaam of Wachtwoord verkeerd.";
                            print($error);
                        }
                    }
                }
            }
            if (!(isset($_SESSION['username']) && $_SESSION['password'] == '')) {
                echo("<div id='gebruiker'></div><div id='menu'></div>");
            } else {
                echo ("<div id='gebruiker'>
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

            </div>");
            }
            ?>
        </div>
        <div id='content'>
            <h1>login</h1>
            <div class="login">
                <form action="AdminLogin.php" method="POST">
                    <label>Gebruikersnaam:</label><br>
                    <input type="text" name="username">
                    <br>
                    <label>Wachtwoord:</label><br>
                    <input type="password" name="password">
                    <br>
                    <input type="submit" name="login" value="login">
                    <br><br>
                    <a href="#">wachtwoord vergeten</a>
                </form>
            </div>
        </div>
        <div class='push'></div>
        <div id='footer'>
            <div id='footerleft'>Admin Systeem</div>

            <div id='footerright'>&copy;Bens Development 2013 - 2014</div>
        </div>
    </body>
</html>
</body>
</html>
