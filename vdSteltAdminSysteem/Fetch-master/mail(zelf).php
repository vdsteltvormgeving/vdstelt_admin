<?php

$connect = "{imap.localhost:143/notls}";
$user    = "root";
$pass    = "usbw";

$mbox = imap_open($connect, $user, $pass);

echo "<h1>Mailboxes</h1>\n";
$folders = imap_listmailbox($mbox, "{imap.localhost:143}", "*");

if ($folders == false) {
    echo "Call failed<br />\n";
} else {
    foreach ($folders as $val) {
        echo $val . "<br />\n";
    }
}

echo "<h1>Headers in INBOX</h1>\n";
$headers = imap_headers($mbox);

if ($headers == false) {
    echo "Call failed<br />\n";
} else {
    foreach ($headers as $val) {
        echo $val . "<br />\n";
    }
}

imap_close($mbox);
?>