<?php

    echo'
                    <ul><li class="rij"><a href="klantoverzicht.php">Home</a></li>
                        <li class="rij"><a href="klantticketoverzicht.php">Tickets</a>
                        <ul>
                                <li><a href="klantticketoverzicht.php">Tickets inzien</a></li>
                                <li><a href="klantticketaanmaken.php">Ticket aanmaken</a></li>
                        </ul>
                        </li>
                        <li class="rij"><a href="klantfactuuroverzicht.php">Facturen</a>
                        <li class="rij"><a href="index.php?link=loguit">Uitloggen</a>
                    </ul>';
                    
                    if(isset($_POST["loguit"]))
                    {
                        $username=$_SESSION['username'];
                        $password=$_SESSION['password'];                        
                        $loguit=mysqli_prepare($link, "UPDATE User SET status='Offline' WHERE mail='$username'");
                        mysqli_stmt_execute($loguit);                        
                        session_destroy();
                        header("location: klantlogin.php");
                    }
?>
