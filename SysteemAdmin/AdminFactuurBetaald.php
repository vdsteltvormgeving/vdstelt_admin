<!DOCTYPE html>
<!--
Daan Hagemans
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>bensdevelopment</title>
    </head>
    <body>
        <form>
            <input type="submit" method="POST" name="verwijderen" value="verwijderen">

               <?php
               include link.php;
               // Er moet een factuur geselecteerd zijn om te verwijderen
               
               if (isset($_POST['verwijderen'])) {
                   //er moet eerst gekeken worden of er een factuur geselecteerd is
                   if ($geselecteerd != "") {
                       
                       /*
                       $result = mysqli_query($link, "DELETE invoice_number, date, payment_completed, user_id, customer_id FROM Invoice WHERE invoice_number = ");
                       $stam = mysqli_prepare($link, $result);
                       mysqli_stmt_execute($stam);
                       mysqli_stmt_bind_result($stam, $TicketIDcount);
                       mysqli_stmt_fetch($stam); //Get information out of the database
                       */
                       
                   } else {
                       echo 'Er is geen factuur geselecteerd om te verwijderen';
                   }
               }
               ?>
        </form>
    </body>
</html>
