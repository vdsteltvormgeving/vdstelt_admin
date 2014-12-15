<!DOCTYPE html>
<?php session_start(); ?>
<!-- Joshua van Gelder, Sander van der Stelt -->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Overzicht</title>
        <link rel="stylesheet" href="stijl.css" type="text/css"/>
    </head>    
    <body>        
        <div id="container">
            <header>
                <div id="logo">
                    <img src="afbeeldingen/logo-bens.png" alt="Bens Development"/>
                </div>
                <div id="menu">
                    <?php
                    include 'menubackend.php';
                    include 'link.php';
                    ?>
                </div>
            </header>
            <div id="content">
                <?php
                $username = $_SESSION['username'];
                $password = $_SESSION['password'];
                $userinfo = mysqli_prepare($link, "SELECT user_id, first_name, last_name FROM User WHERE mail='$username'");
                mysqli_stmt_execute($userinfo);
                mysqli_stmt_bind_result($userinfo, $login, $fname, $lname);
                while (mysqli_stmt_fetch($userinfo))
                {
                    $login;
                    $fname;
                    $lname;
                }
                mysqli_close($link);
                include "link.php";
                $ammount = mysqli_prepare($link, "SELECT COUNT(ticket_id) FROM Ticket WHERE user_id=$login AND completed_status=0");
                mysqli_stmt_execute($ammount);
                mysqli_stmt_bind_result($ammount, $count);
                mysqli_stmt_fetch($ammount);
                mysqli_close($link);
                ?>
                <p>U heeft <?php echo $count; ?> open tickets</p>
                <table>                    
                    <tr>
                        <th>Categorie</th>
                        <th>Aanmaak Datum</th>
                    </tr>                    
                    <?php
                    include "link.php";
                    $tickets = mysqli_prepare($link, " SELECT category, creation_date, ticket_id FROM Ticket WHERE user_id=$login AND completed_status=0 ORDER BY creation_date DESC");
                    mysqli_stmt_execute($tickets);
                    mysqli_stmt_bind_result($tickets, $category, $creation, $ticketid);
                    while (mysqli_stmt_fetch($tickets))
                    {
                        echo "<tr><td>$category</td><td>$creation</td></tr>";
                    }
                    ?>
                </table>
                <form method="POST" action="klantticketaanmaken.php">
                    <input type="submit" name="ticketmaken" value="Ticket aanmaken">
                </form>
                <form method="POST" action="klantticketoverzicht.php">
                    <input type="submit" name="ticketinzien" value="Tickets inzien">
                </form>                     
                <form method="POST" action="klantfactuuroverzicht.php">
                    <input type="submit" name="klantfactuuroverzicht" value="Factuur Overzicht">
                </form>
                <form method="POST" action="klantoverzicht.php">
                    <input type="submit" name="loguit" value="Uitloggen">
                </form>
                <?php
                if (isset($_POST["loguit"])) // Met deze if loop wordt een gebruiker als offline gezet als hij uitlogt
                {
                    $username = $_SESSION['username'];
                    $password = $_SESSION['password'];
                    $loguit = mysqli_prepare($link, "UPDATE User SET status='Offline' WHERE mail='$username'");
                    mysqli_stmt_execute($loguit);
                    session_destroy();
                    header("location: klantlogin.php");
                }
                ?>
            </div>                        
        </div>
        <footer>
            <?php include 'footer.php'; ?>
        </footer>
    </body>
</html>
