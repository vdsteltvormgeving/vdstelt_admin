<?php

echo ("<div id='gebruiker'>
                <ul id='nav'>
                    <li><a href='#'> <img src='img/gebruiker.png' style='margin-top: -5px;'> <div id='showname'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Admin</div> <img  src='img/pijltje.png' id='pijltje'></a>
                        <ul>
                            <li><a href='AdminOverzicht.php'>Home</a></li>
                            <li><a href='AdminKlantOverzicht.php'>Klanten</a></li>
                            <li><a href='AdminTicketOverzicht.php'>Tickets</a></li>
                            <li><a href='#'>Facturen</a></li>
                            <li id='uitloggen'><a href='Adminlogin.php?link=loguit'>Uitloggen</a></li>
                        </ul>
                    </li>
                </ul>
            </div>");
if (isset($_POST["loguit"])) {
    $username = $_SESSION['username'];
    $password = $_SESSION['password'];
    $loguit = mysqli_prepare($link, "UPDATE User SET status='Offline' WHERE mail='$username'");
    mysqli_stmt_execute($loguit);
    session_destroy();
    header("location: klantlogin.php");
}
echo ("
        </div>
        <div id='menu'>
            <div id='pagina'>
                <a href='AdminTicketOverzicht.php'>Tickets overzicht</a>
            </div>
            <div id='module'>
                <a href='#'>Facturen</a>
            </div>
            </div>");
?>
