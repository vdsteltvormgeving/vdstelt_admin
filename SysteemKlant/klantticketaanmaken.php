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
                <h1>Ticket aanmaken</h1>
                <?php
                session_start();
                $username=$_SESSION['username'];
                $password=$_SESSION['password'];
                include "link.php";
                $loginQuery=mysqli_prepare($link, "SELECT user_id FROM User WHERE mail='$username'");
                mysqli_stmt_execute($loginQuery); 
                mysqli_stmt_bind_result($loginQuery, $login);
                while (mysqli_stmt_fetch($loginQuery))
                {
                    $login;
                }
                mysqli_close($link);
                date_default_timezone_set('CET');
                $datetime = date("Y-m-d H:i:s");  //function to get date and time
                
                include "link.php";
                $stat = mysqli_prepare($link, "SELECT C.customer_id, C.company_name, C.street, C.house_number, C.postal_code,C.city, C.phone_number, C.fax_number, C.emailadress, C.btw_number FROM customer C JOIN Invoice I ON I.customer_id=C.customer_id JOIN User U ON U.user_id=I.user_id WHERE U.user_id = $login");
                mysqli_stmt_execute($stat);
                mysqli_stmt_bind_result($stat, $customerID, $comnam, $street, $housenr, $postalcode, $city, $phonenr, $faxnr, $mail, $btwnr);
                while(mysqli_stmt_fetch($stat))
                {
                    
                }
                mysqli_close($link);
                
                include "link.php";
                $names = mysqli_prepare($link, "SELECT first_name, last_name FROM User WHERE mail='$username'");                
                mysqli_stmt_execute($names);
                mysqli_stmt_bind_result($names, $fname, $lname);
                while(mysqli_stmt_fetch($names))
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
                <form method="POST" action="klantticketaanmaken.php">
                    <p>
                        <select id="Categorie" name="categorie">
                            <option value="">Selecteer Categorie</option>
                            <option value="website">Website</option>
                            <option value="cms">CMS</option>
                            <option value="hosting">Hosting</option>
                        </select>                                                            
                    </p>                    
                    <textarea name="beschrijving"></textarea>
                    <br>
                    <input type="submit" name="verzenden" value="Verzenden">                                       
                </form>
                <form method="POST" action="klantoverzicht.php">
                    <input type="submit" name="annuleren" value="Annuleren"> 
                </form>
                        
                <!-- text field and button to send text field and cancel button to go back -->            
                <?php
                include"link.php";                
                if (isset($_POST["verzenden"])) 
                {
                    $description = $_POST["beschrijving"];
                    $category = $_POST["categorie"];
                    $creation_date=$datetime;
                    if ($description == "" || $category == "") 
                    {
                        echo "Er is geen categorie en/of beschrijving gegeven.";
                    } 
                    else 
                    {                            
                        mysqli_close($link);                        
                        include"link.php";
                        $insert = mysqli_prepare($link, "INSERT INTO ticket SET category='$category', creation_date='$creation_date', last_time_date='$creation_date', description='$description', user_id=$login, completed_status=0, archived_status=0");
                        mysqli_stmt_execute($insert);
                        mysqli_close($link);
                        echo "Uw ticket is verzonden.";
                        
                        /*Deze code werkt niet op de local server.
                        //default headers
                        $headers = "MIME-Version: 1.0" . "\r\n";
                        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                        //more headers
                        $headers .= 'From: <ticketsysteem@bensdevelopment.nl>' . "\r\n";
                        $headers .= 'Cc: admin@bensdevelopment.nl' . "\r\n";
                        $to="jpjvangelder@gmail.com";
                        $subject="Niewe ticket aangemaakt";
                        $message="Beste, <br><br> er is een niewe ticket aangemaakt met category:$category";
                        mail($to,$subject,$message,$headers);*/
                    }                                        
                }
                ?>
            </div>
            <!--EINDE CONTENT-->
            <footer>
                <p class="copyright">Copyright © 2014 <b>Bens Development</b>, All Right Reserved.</p>
            </footer>
        </div>
    </body>
</html>

