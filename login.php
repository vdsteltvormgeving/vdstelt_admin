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
                <div id="menu">
                    <?php
                    include 'menu.php';
                    include 'link.php';
                    ?>
                </div>
            </header>
            <div id="content">
                <h1>login</h1>                
                <div class="login">                        
                    <form action="login.php" method="POST">
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
                <?php
                session_start(); //start sessie
                if (isset($_POST["login"])) 
                {
                    $username = $_POST["username"];
                    $password = $_POST["password"];
                    $login = $_POST["login"];
                    if (empty($username) || empty($password) || empty($username) && empty($password)) 
                    {
                        $error = "Gebruikersnaam of Wachtwoord verkeerd.";
                        print($error);                    
                    }                        
                    else 
                    {
                        if(isset($login)) 
                        { 
                            $username = $_POST["username"];
                            $password = $_POST["password"];
                            $login1 = mysqli_stmt_prepare($link, "SELECT username, password FROM user WHERE username=$username AND password=$password");
                            mysqli_stmt_execute($login1);
                            $rows = mysqli_num_rows($login1);
                            if($rows==1)
                            {
                                $_SESSION['login_user'];
                                header("location: overzicht.php");
                            }
                            else
                            {
                                $error = "Gebruikersnaam of Wachtwoord verkeerd.";
                                print($error);
                            }
                        }
                    }                        
                }                                                        
                ?>
            </div>
            <footer>
                <p class="copyright">Copyright © 2014 <b>Bens Development</b>, All Right Reserved.</p>
            </footer>
        </div>
    </body>
</html>

