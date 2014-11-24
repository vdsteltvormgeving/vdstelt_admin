<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>klant - inloggen</title>
    </head>
    <body>
        <?php
        /*
          Text(gebruikersnaam):
          Deze tekst wordt met behulp van html code gecodeerd in de vorm van
          een <input>  statement.
         */
        ?>
        <label>Gebruikersnaam</label>
        <input type="text" name="username" value=""><br>
        <?php
        /*
          password(wachtwoord):
          Deze tekst wordt met behulp van html code gecodeerd in de vorm
          van een <input>  statement.
         */
        ?>
        <label>password</label>
        <input type="password" name="password" value=""><br>
        <?php
        /*
          link(wachtwoord vergeten):
          Deze link wordt met behulp van html code gecodeerd in de vorm van
          een <a> statement.
          (Er moet een nieuw scherm worden gemaakt waar deze link naar verwijst)
         */
        ?>
        <a href="wachtwoordvergeten.php">wachtwoord vergeten</a>
        <input type="submit" name="inloggen" value="inloggen">
        <?php
        /*
          button(Inloggen):
          Deze knop wordt vormgegeven met behulp van html code in de vorm van een
          <link type=”submit>” statement en zal verder worden gecodeerd met php code.
         */

        $link = mysqli_connect("localhost", "root", "usbw", "bensdevelopment", 3306);
        if (!$link) {
            print("kan helaas geen verbinding maken");
            print(mysql_connect_error());
        }

        if (isset($_POST["inloggen"])) {
            $username = $_POST["username"];
            $password = $_POST["password"];

            $stat = mysqli_prepare($link, "Select username, password VALUES (?,?)");
            mysqli_stmt_bind_param($stat, "ss", $username, $password);
            mysqli_stmt_execute($stat);

            if ($username == $_POST[username] && $password == $_POST[password]) {
                print("U bent ingelogd");
            }
        }
        //mysqli_free_result($UsernameResult); 
        //mysqli_close()
        ?>
    </body>
</html>