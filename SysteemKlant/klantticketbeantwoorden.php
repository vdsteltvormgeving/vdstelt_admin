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
                <h1>Ticket</h1>
                <?php
                session_start();
                $username=$_SESSION['username'];
                $password=$_SESSION['password'];
                
                include "link.php";
                
                $loginQuery=mysqli_prepare($link, "SELECT user_id FROM User WHERE mail='$username'");
                mysqli_stmt_execute($loginQuery); 
                mysqli_stmt_bind_result($loginQuery, $Login);
                while (mysqli_stmt_fetch($loginQuery))
                {
                    $Login;
                }
                mysqli_close($link);
                
                date_default_timezone_set('CET');
                $datetime = date("d-m-Y H:i:s");  //function to get date and time
                
                include "link.php";
                
                $stat = mysqli_prepare($link, "SELECT C.customer_id, C.company_name, C.street, C.house_number, c.postal_code,c.city, C.phone_number, C.fax_number, C.emailadress, C.btw_number FROM customer C JOIN Invoice I ON I.customer_id=C.customer_id JOIN User U ON U.user_id=I.user_id WHERE U.user_id = $Login");
                mysqli_stmt_execute($stat);
                mysqli_stmt_bind_result($stat, $customerid, $comnam, $street, $housenr, $postalcode, $city, $phonenr, $faxnr, $mail, $btwnr);
                while(mysqli_stmt_fetch($stat))
                {
                    
                }
                mysqli_close($link);
                
                include "link.php";
                $name=mysqli_stmt_prepare($link, "SELECT first_name, last_name FROM User WHERE mail='$username'");
                mysqli_stmt_execute($name);
                mysqli_stmt_bind_result($name, $fname, $lname);
                mysqli_close($link);
                               
                ?>
                <form method="POST" action="klantticketaanmaken.php">
                    <p> Naam Klant: <?php include"link.php"; echo $fname . " " . $lname; ?> </p>
                    <br>
                    Klant ID: <?php echo $customerid; ?>
                    <br><!-- dropdown menu -->         
                    <p> 
                        E-mail klant: <?php echo $mail; ?> 
                    </p>
                    <!--<form method="POST" action="">
                        <input type="submit" name="BestandUploaden" value="Bestand Uploaden">
                    </form> -->                  
                    <p> 
                        Datum: <?php echo $datetime;
                        mysqli_close($link);
                        ?> 
                    </p>                    
                    <select id="Categorie" name="Categorie">
                        <option value="">Selecteer Categorie</option>
                        <option value="a">Webapplication</option>
                        <option value="b">Internetsite</option>
                        <option value="c">Hosting</option>
                    </select>
                    <?php
                    include "link.php";                    
                    $stam = mysqli_prepare($link, "SELECT MAX(ticket_ID) FROM ticket");
                    mysqli_stmt_execute($stam);
                    mysqli_stmt_bind_result($stam, $TicketIDcount);
                    mysqli_stmt_fetch($stam); //Get information out of the database
                    $TicketID = $TicketIDcount + 1; //Counting the number of tickets in the database and gives the ticket a uniek ID
                    ?>
                    <p>TicketID: <?php echo $TicketID; mysqli_close($link); ?></p>
                    <textarea name="Beschrijving"></textarea><br>
                    <input type="submit" name="Verzenden" value="Verzenden">
                </form>
                <form method="POST" action="klantoverzicht.php">
                    <input type="submit" name="Annuleren" value="Annuleren">
                </form><!-- text field and button to send text field and cancel button to go back -->            
                <?php
                include"link.php";
                if (isset($_POST["Verzenden"])) 
                {
                    $description = $_POST["Beschrijving"];
                    $category = $_POST["Categorie"];
                    $creation_date=$datetime;
                    if ($description == "" || $category == "") 
                    {
                        echo "Er is geen categorie en/of beschrijving gegeven.";
                    } 
                    else 
                    {                        
                        echo "Uw ticket is verzonden.";                                                                        
                        $insert = mysqli_prepare($link, "INSERT INTO ticket SET  ticket_ID=$TicketID, category='$category', creation_date='$creation_date', last_time_date='$creation_date', description='$description', user_ID=$Login, completed_status=0, archived_status=0");                                        
                        mysqli_stmt_execute($insert);
                        mysqli_close($link);
                        //default headers
                        $headers = "MIME-Version: 1.0" . "\r\n";
                        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                        //more headers
                        $headers .= 'From: <ticketsysteem@bensdevelopment.nl>' . "\r\n";
                        $headers .= 'Cc: admin@bensdevelopment.nl' . "\r\n";
                        $to="jpjvangelder@gmail.com";
                        $subject="Niewe ticket aangemaakt";
                        $message="Beste, <br><br> er is een niewe ticket aangemaakt met category:$category";
                        mail($to,$subject,$message,$headers);
                    }                                        
                }
                ?>
            </div>
            <!--EINDE CONTENT-->
                     </div>
            <footer>
                <?php include 'footer.php';?>
            </footer>
    </body>
</html>

