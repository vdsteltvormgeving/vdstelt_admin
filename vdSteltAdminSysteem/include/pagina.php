<?php

function Content() {
    if (!isset($_GET['p'])) {
        Home();
    } elseif ($_GET['p'] == 'Klanten') {
        Klantenoverzicht();
    } elseif ($_GET['p'] == 'Klant') {
        Klant();
    } elseif ($_GET['p'] == 'Facturen') {
        Facturenoverzicht();
    } elseif ($_GET['p'] == 'Factuur') {
        Factuur();
    }
}

function Home() {
    //Deze inhoud wordt standaard geladen.
    include 'paginaID/id1.php';
}

function Klantenoverzicht() {
    //Toont het Klantenoverzicht.
    include '';
    echo '<a href="Home">Terug naar home</a>';
}

function Klant() {
    //Toont klantgegevens.
    include '';
    echo '<a href="Home">Terug naar home</a>';
}

function Facturenoverzicht() {
    //Toont het Facturenoverzicht
    include '';
    echo '<a href="Home">Terug naar home</a>';
}

function Factuur() {
    //Toont het Facturenoverzicht
    include '';
    echo '<a href="Home">Terug naar home</a>';
}

?>