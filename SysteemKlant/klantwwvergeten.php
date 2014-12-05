<!DOCTYPE html>
<!-- Sander van der Stelt -->
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
                    ?>
                </div>
            </header>
            <div id="content">
                <h1>Wachtwoord vergeten</h1>
                <form action="klantwwvergeten.php" method="POST">
                    <label>E-mail:</label><br>
                    <input type="text" name="email">
                    <br>
                    <input type="submit" name="wwaanvragen" value="wachtwoord aanvragen">
                </form>
                <?php
                include "link.php";

                if (isset($_POST['wwaanvragen']))
                {
                    $email = $_POST['email']; //Hier komt de waarde die ingevuld is door bezoeker
                    $check1 = mysqli_query($link, "SELECT * FROM user WHERE mail = '$email' "); //Hier kijkt 
                    /* $check2 = mysqli_prepare($link, "SELECT * FROM user WHERE email = '$email' ");
                      mysqli_stmt_execute($check2); */
                    $vind = mysqli_num_rows($check1);
                    if ($vind)
                    {
                        function makepassword($length)
                        {
                            $validCharacters = "abcdefghijklmnopqrstuvwxyz123456789";
                            $validCharNumber = strlen($validCharacters);
                            $result = '';
                            for ($i = 0; $i < $length; $i++)
                            {
                                $result .= $validCharacters[mt_rand(0, $validCharNumber - 1)];
                            }
                            return $result;
                        }
                        $random_password = makepassword(10);
                        $final_result = mysqli_query($link, "UPDATE user SET password ='$random_password' WHERE mail = '$email' ");
                        if ($final_result)
                        {
                            echo "<p class='succesmelding'>" . "E-mail: " . $email . "<br>Uw wachtwoord is:" . $random_password . "</p>";
                        }
                    }
                    else
                    {
                        echo "<p class='foutmelding'>Uw e-mail is niet bekend.</p>";
                    }
                }
                ?>
            </div>
        </div>
        <footer>
            <?php include 'footer.php'; ?>
        </footer>
    </body>
</html>