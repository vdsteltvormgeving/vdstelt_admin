<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Van der Stelt Vormgeving - Administratie systeem</title><link href='http://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700,300italic,400italic,500italic,700italic' rel='stylesheet' type='text/css'>
        <link href="adminstijl.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <?php
        include 'connect.php';
        ?>

        <header>
            <h1>Administratie Systeem</h1>
            <p>versie 1.0</p>
        </header>
        <div id="content">
            <div class="column_small column_line side-shadow">
                <h1>Welkom</h1>
                <p style="color:lightgrey; font-size:10px;">Saturday, December 13 2014, 1:13</p>
                <p>Goedendag <b>Sander</b>, Hoe gaat het met u?</p>
                <p>Dit adminstratie systeem staat weer voor uw klaar.</p>
                <?php
                   /*$mydate=getdate(date("U"));
                   for($i=0; $i<$mydate[hours];$i++){
                       $uur = $mydate[hours] + 1;
                   }
                    echo "<p> $mydate[weekday], $mydate[month] $mydate[mday] $mydate[year], $mydate[hours]+1 :$mydate[minutes] </p>";
                    */
                    ?>
                <p>Klik hier onder om uit te loggen:<br>
                <a href="#">Uitloggen</a></p>
            </div>
            <div class="column_normal column_line side-shadow">
                <h1>Home</h1>
                <p>Hier kunt u kiezen, deze zin moet lang zijn voor een test kijken wat er precies gaat gebeuren!</p>
                <table>
                    <tr>
                        <td><a href="#">Klanten overzicht</a></td>
                    </tr>
                    <tr>
                        <td><a href="#">Facturen overzicht</a></td>
                    </tr>
                </table>
            </div>
        </div>
        <footer></footer>
    </body>
</html>
