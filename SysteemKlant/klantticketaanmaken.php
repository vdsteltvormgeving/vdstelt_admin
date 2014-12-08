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
                include "link.php"; // Met deze query wordt de naam en userid van de ingelogde klant opgehaald.
                $userinfo=mysqli_prepare($link, "SELECT user_id, first_name, last_name FROM User WHERE mail='$username'");
                mysqli_stmt_execute($userinfo); 
                mysqli_stmt_bind_result($userinfo, $login, $fname, $lname);
                while (mysqli_stmt_fetch($userinfo))
                {
                    $login;
                    $fname;
                    $lname;
                }
                mysqli_close($link);                                                
                
                date_default_timezone_set('CET');
                $datetime = date("Y-m-d H:i:s");  //Met deze functie wordt de datum bepaald.
                ?>                
                <p> 
                    Naam: <?php echo "$fname $lname"; ?> 
                </p>
                <!-- Bij deze form kan een bestand worden geupload om mee te geven met de ticket -->
                <form action="Upload.php" method="POST" enctype="multipart/form-data">
                    Selecteer een bestand om te uploaden:<br><br>
                 <input type="file" name="fileToUpload" id="fileToUpload"><br>
                <input type="submit" value="upload" name="submit">
                </form>                  
                <p> 
                    Datum: <?php echo $datetime; ?> 
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
                        echo "<p class='foutmelding'>Er is geen categorie en/of beschrijving gegeven.</p>";
                    } 
                    else 
                    {                                                                            
                        include"link.php"; //Dit is de insert query waar de nieuwe informatie in de tabel wordt geinsert.
                        $insert = mysqli_prepare($link, "INSERT INTO ticket SET category='$category', creation_date=NOW(), last_time_date='$creation_date', description='$description', user_id=$login, completed_status=0, archived_status=0");
                        mysqli_stmt_execute($insert);
                        mysqli_close($link);
                        echo "<p class='succesmelding'>Uw ticket is verzonden.</p>";
                        
                        /* !Deze code werkt niet op de local server.!
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
                    </div>
            <footer>
                <?php include 'footer.php';?>
            </footer>
    </body>
</html>

