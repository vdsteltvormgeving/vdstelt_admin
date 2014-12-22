<?php
function URL(){
	if(isset($_GET['index.php'])){}
	else {
            if(empty($_SERVER['QUERY_STRING'])){
	Home();
	}
	}
	if (isset($_SESSION['naam'])){
            if (isset($_GET['klantoverzicht'])){KlantOverzicht();};
            if (isset($_GET['klant'])){Klant();};
            if (isset($_GET['factuuroverzicht'])){FactuurOverzicht();};
	    if (isset($_GET['klantfactuur'])){KlantFactuur();};
	}
	else{
	if(!empty($_SERVER['QUERY_STRING'])){
            echo 'Er gaat iets fout!';
        }  	
}}
?>