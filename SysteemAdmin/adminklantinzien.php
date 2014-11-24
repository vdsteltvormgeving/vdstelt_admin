<!DOCTYPE html>
<html>
    <head>        
        <link rel="stylesheet" type="text/css" href="style.css">
        <meta charset="UTF-8">
        <title>adminklantinzien</title>
    </head>
    <body>
        <div>
        <p> klant gegevens:</p>
        <p>
            <?php
            include "link.php";
            
            $customerIDarray = $_POST["CID"];
            foreach ($customerIDarray as $customer => $troep) 
            {
                $customerID = $customer;
            }
            print("Klant ID: 00".$customerID);
            if ($customerID != "") 
            {
                $stat = mysqli_prepare($link, "SELECT First_Name, Last_Name, Email, Company_name, Adres, Residence, IBAN, KVK, BTW_Number FROM customer WHERE customer_id = $customerID ");
                mysqli_stmt_execute($stat);
                mysqli_stmt_bind_result($stat, $fname, $lname, $email, $comname, $adres, $Res, $IBAN, $KVK, $btw);                
                while (mysqli_stmt_fetch($stat))
                {
                    print("<br>Bedrijfsnaam: $comname <br>Adres: $adres <br>Email: $email <br>Woonplaats: $Res <br>IBAN nummer: $IBAN <br>KVK nummer: $KVK <br>BTW nummer: $btw<br>");
                }
            } 
            else 
            {
                print ("customer ID is niet geselecteerd");
            }
            mysqli_close($link);
            ?>
        </p>
        </div>        
        <div>  
        <br>
        <form method="post" action="Adminklantoverzicht.php">
            <input type="submit" name="back" value="Terug">
        </form>
        <form>
            <input type="submit" name="edit" value="Klant Bewerken">
        </form>
        </div>
    </body>
</html>
