<?php

Function Link($localhost, $username, $password, $database, $port) {
    $link = mysqli_connect($localhost, $username, $password, $database, $port);
    return ($link);
}

?>