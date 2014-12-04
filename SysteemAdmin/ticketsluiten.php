<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        include 'function.php';
        $link = connect();
        $ticketID = 1; //Word een $_POST
        
        //Er moet nog een isset voor zodat hij niet automatich gaat veranderen
        
         $stat = mysqli_prepare($link, "UPDATE Ticket SET completed_status = 1, archived_status = 1 WHERE ticket_ID= $ticketID;");
                mysqli_stmt_execute($stat);
                
        ?>
    </body>
</html>
