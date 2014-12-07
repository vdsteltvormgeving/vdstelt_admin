<!DOCTYPE html>
<!-- Joshua van Gelder, Jeffrey Hamberg, Daan Hagemans-->
<?php
session_start();
if ($_SESSION["login"] != 1)
{
    echo 'YOU DONT BELONG HERE';
    session_unset();
    session_destroy();
}
else
{
    ?>
    <html>
        <head>
            <meta charset="UTF-8">
            <title>Admin Systeem</title>
            <link href="stijl.css" rel="stylesheet" type="text/css">
        </head>
        <body>
            <div id='bovenbalk'>
                <div id='logo'>
                    <img src="img/logo-bens.png" alt="">
                </div>
                <?php
                include 'menu.php';
                ?>
            </div>
            <div id='content'>
                <h1>Ticket wijzigen</h1>
                <?php
                include "link.php";
                $UserIDarray = $_POST["user_id"];
                foreach ($cUserIDarray as $user => $troep)
                {
                    $userID = $user;
                }
                ?>
                Klant: <?php
                $query1 = mysqli_prepare($link, "SELECT username FROM User WHERE user_id=$customerID");
                mysqli_stmt_execute($query1);
                mysqli_stmt_bind_result($query1, $Username);
                while (mysqli_stmt_fetch($query1))
                {
                    echo $Username;
                }
                ?>

                Categorie:<form method="post" action="Category">
                    <select name="Categorie">
                        <option value="Select Category">Select categorie</option>
                        <option value="Category1">Category1</option>
                        <option value="Category2">Category2</option>
                        <option value="Category3">Category3</option>
                    </select>
                </form>
                Beschrijving: <?php
                $query2 = mysqli_prepare($link, "SELECT description FROM Ticket WHERE user_id = $customerID");
                mysqli_execute($query2);
                mysqli_stmt_bind_result($query2, $Text);
                While (mysqli_stmt_fetch($query2))
                {
                    echo $Text;
                }
                ?> 
                Categorie wijzigen:<form method="post" action="AdminTicketWijzigen.php">
                    <select name="categorie_wijzigen">
                        <option value="Select Category">Select</option>
                        <option value="website">Category1</option>
                        <option value="cms">CMS</option>
                        <option value="hosting">Hosting</option>
                    </select>
                </form>
                Ticket geschreven op: <?php
                $query3 = mysqli_prepare($link, "SELECT creation_date FROM Ticket WHERE user_id=$customerID");
                mysqli_execute($query3);
                mysqli_stmt_bind_result($query3, $creation_date);
                while (mysqli_stmt_fetch($query3))
                {
                    echo $creation_date;
                }
                ?>
                Datum: <?php
                date_default_timezone_set('CET');
                $today = date("F j, Y");
                echo $today;
                ?>
                Uw reactie:<textarea>                    
                </textarea>
                <form>
                    <input type="submit" name="sumbit changes" value="Wijzigingen doorvoeren">
                </form>
                <form method="POST" action="">
                    <input type="submit" name="back" value="Terug" >
                </form>
                <form method="POST" action="">
                    <input type="submit" name = "Close ticket" value="Ticket sluiten">
                </form>                           
            </div>
            <div class='push'></div>
            <div id='footer'>
                <div id='footerleft'>Admin Systeem</div>

                <div id='footerright'>&copy;Bens Development 2013 - 2014</div>
            </div>
        </body>
    </html>

<?php } ?>