<!DOCTYPE html>
<!-- Joshua van Gelder, Jeffrey Hamberg, Bart Holsappel, Sander van der Stelt -->
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
                    include 'menubackend.php';
                    ?>
                </div>
                <!--EINDE MENU-->
            </header>
            <!--BEGIN CONTENT-->
            <div id="content">
                <h1>Ticket wijzigen</h1>
                <?php
                session_start();

                $username = $_SESSION['username'];
                $password = $_SESSION['password'];
                if (isset($_POST["verzenden"]))
                {
                    $tidarray = $_POST['tid'];
                    foreach ($tidarray as $t => $notused)
                    {
                        $ticketid = $t;
                    }
                    echo $ticketid;
                }
                else
                {
                    $ticketidarray = $_POST["ticketid"];
                    foreach ($ticketidarray as $ticket => $notused)
                    {
                        $ticketid = $ticket;
                    }
                }
                include "link.php";
                $loginQuery = mysqli_prepare($link, "SELECT user_id FROM User WHERE mail='$username'");
                mysqli_stmt_execute($loginQuery);
                mysqli_stmt_bind_result($loginQuery, $userid);
                while (mysqli_stmt_fetch($loginQuery))
                {
                    $userid;
                }
                mysqli_close($link);

                date_default_timezone_set('CET');
                $datetime = date("Y-m-d H:i:s");  //function to get date and time

                include "link.php";
                $GetDescription = mysqli_prepare($link, "SELECT description, category FROM Ticket WHERE ticket_id=$ticketid");
                mysqli_stmt_execute($GetDescription);
                mysqli_stmt_bind_result($GetDescription, $description, $category);
                while (mysqli_stmt_fetch($GetDescription))
                {
                    $description;
                    $category;
                }
                mysqli_close($link);

                include "link.php";
                $id = mysqli_prepare($link, "SELECT ticket_id FROM Ticket WHERE ticket_id=$ticketid");
                mysqli_stmt_execute($id);
                mysqli_stmt_bind_result($id, $tid);
                while (mysqli_stmt_fetch($id))
                {
                    $tid;
                }
                mysqli_close($link);

                include "link.php";
                $names = mysqli_prepare($link, "SELECT first_name, last_name FROM User WHERE mail='$username'");
                mysqli_stmt_execute($names);
                mysqli_stmt_bind_result($names, $fname, $lname);
                while (mysqli_stmt_fetch($names))
                {
                    $fname;
                    $lname;
                }
                ?>                
                <p> 
                    Naam: <?php echo $fname . " " . $lname; ?> 
                </p>                                                            
                <!--<form method="POST" action="">
                    <input type="submit" name="BestandUploaden" value="Bestand Uploaden">
                </form> -->                  
                <p> 
                    Datum: <?php echo $datetime; mysqli_close($link); ?> 
                </p>                
                <form method="POST" action="klantticketwijzigen.php">
                    <p>
                        <select id="Categorie" name="categorie">
                            <option value=""><?php echo $category; ?></option>
                            <option value="website">Website</option>
                            <option value="cms">CMS</option>
                            <option value="hosting">Hosting</option>
                        </select>                                                            
                    </p>                    
                    <textarea name="beschrijving"><?php echo "$description" ?></textarea>
                    <br>
                    <input type="hidden" <?php echo 'name="tid[' . $tid . ']"' ?>>
                    <input type="submit" name="verzenden" value="Verzenden">                    
                </form>
                <form method="POST" action="klantticketoverzicht.php">
                    <input type="submit" name="annuleren" value="Annuleren"> 
                </form>

                <!-- text field and button to send text field and cancel button to go back -->            
                <?php
                if (isset($_POST["verzenden"]))
                {
                    $description   = $_POST["beschrijving"];
                    $category      = $_POST["categorie"];
                    $creation_date = $datetime;
                    if ($description == "")
                    {
                        echo "<p class='foutmelding'>Er is geen categorie en/of beschrijving gegeven.</p>";
                    }
                    else
                    {
                        include"link.php";
                        $insert = mysqli_prepare($link, "UPDATE ticket SET last_time_date=NOW(), description='$description' WHERE ticket_id=$ticketid");
                        mysqli_stmt_execute($insert);
                        mysqli_close($link);

                        echo "<p class='succesmelding'>Uw ticket is verzonden.</p>";
                        header("location: klantticketoverzicht.php");

                        /* Deze code werkt niet op de local server.
                          //default headers
                          $headers = "MIME-Version: 1.0" . "\r\n";
                          $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                          //more headers
                          $headers .= 'From: <ticketsysteem@bensdevelopment.nl>' . "\r\n";
                          $headers .= 'Cc: admin@bensdevelopment.nl' . "\r\n";
                          $to="jpjvangelder@gmail.com";
                          $subject="Niewe ticket aangemaakt";
                          $message="Beste, <br><br> er is een niewe ticket aangemaakt met category:$category";
                          mail($to,$subject,$message,$headers); */
                    }
                }
                ?>
            </div>
            <!--EINDE CONTENT-->
        </div>
        <footer>
            <?php include 'footer.php'; ?>
        </footer>
    </body>
</html>

