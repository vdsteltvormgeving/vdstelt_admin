<!DOCTYPE html>
<!-- Joshua van Gelder, Jeffrey Hamberg, Daan Hagemans-->
<?php
session_start();
if ($_SESSION["login"] != 1) {
    echo 'YOU DONT BELONG HERE';
    session_unset();
    session_destroy();
} else {
    ?>
    <html>
        <head>
            <meta charset="UTF-8">
            <title>Admin Systeem</title>
            <link href="stijl.css" rel="stylesheet" type="text/css">
        </head>
        <body>
            <div id='bovenbalk'>
                <div id='logo'>
                    <img src="img/logo-bens.png" alt="">
                </div>
    <?php
    include 'menu.php';
    ?>
            </div>
            <div id='content'>
                <?php
                include 'link.php';
                foreach ($_POST["close/wijzig"] AS $ticketid => $notused) {
                    $ticket_id = $ticketid;
                }
                $stmt1 = mysqli_prepare($link, "SELECT customer_id, creation_date, last_change_date, send_date, user_id C.company_name, U.mail FROM ticket T JOIN customer C On c.customer_id = T.customer_id JOIN User U ON U.user_id = T.user_id WHERE ticket_id=$ticket_id ");
                echo'  
                <form action="" method="POST">
                    <input type="text" value="" name="Customer_ID">
                    Klant:
                    <input type="text" value="" name="Creation Date"> 
                    <input type="text" value="" name="Last Changed Date"> 
                    <input type="text" value="" name="Send Date to Hosting"> 
                    <input type="text" value="" name="User ID"> 
                    Mail: 
                    <input type="text" value="" name="Category">';
                        
                    echo'    
                    <textarea cols="4" name="Description"></textarea>
                    <textarea cols="4" name="Reaction"></textarea>
                    <input type="submit" formaction=" if(isset("WijzigenTO"))"';
                ?>
            </form>
            <div class='push'></div>
            <div id='footer'>
                <div id='footerleft'>Admin Systeem</div>

                <div id='footerright'>&copy;Bens Development 2013 - 2014</div>
            </div>
    </body>
    </html>

<?php } ?>