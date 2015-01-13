<?php

function Content() {
    if (!isset($_GET['p'])) {
        Home();
    } elseif ($_GET['p'] == 'Klanten') {
        Klantenoverzicht();
    } elseif ($_GET['p'] == 'Klant') {
        Klant();
    } elseif ($_GET['p'] == 'Klant toevoegen') {
        Klanttoevoegen();
    } elseif ($_GET['p'] == 'Facturen') {
        Facturenoverzicht();
    } elseif ($_GET['p'] == 'Factuur') {
        Factuur();
    } elseif ($_GET['p'] == 'Factuur toevoegen') {
        Factuurtoevoegen();
    }
}

function Home() {
    //Deze inhoud wordt standaard geladen.
    include 'paginaID/id1.php';
}

function Klantenoverzicht() {
    //Toont het Klantenoverzicht.
    include ('paginaID/id4.php');
}

function Klant() {
    //Toont klantgegevens.
    include ('paginaID/id5.php');
}

function Klanttoevoegen() {
    //Toont klantgegevens.
    include ('paginaID/id6.php');
}

function Facturenoverzicht() {
    //Toont het Facturenoverzicht
    include ('paginaID/id2.php');
}

function Factuur() {
    //Toont het geslecteerde factuur
    include ('paginaID/id3.php');
}

function Factuurtoevoegen() {
    //Toont het geslecteerde factuur
    include ('paginaID/id7.php');
}

?>