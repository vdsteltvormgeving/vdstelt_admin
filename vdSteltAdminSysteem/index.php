<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <?php 
        include('include/pagina.php');
        ?>
        <meta charset="UTF-8">
        <title>Van der Stelt Vormgeving - Administratie systeem</title>
        <link href='http://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700,300italic,400italic,500italic,700italic' rel='stylesheet' type='text/css'>
        <link href="adminstijl.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <header>
            <h1>Administratie Systeem</h1>
            <p>versie 1.0</p>
        </header>
        <div id="content">
            <!--
            <a href="Klanten">Klanten</a><br/>
            <a href="Facturen">Facturen</a><br/> 
            -->
            <!--HIER KOMT DE INHOUD-->
            <?php Content(); ?>
        </div>
        <footer>
        </footer>
    </body>
</html>

