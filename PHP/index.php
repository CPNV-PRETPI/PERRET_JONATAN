<?php

if(!isset($_GET['apimethod'])) {
    print "no apimethod specified";
    exit;
}

// switch with get field apimethode
switch($_GET['apimethod']) {
    case 'ping':
        print "pong";
        break;
    default:
        print "this apimethod is not supported";
        break;
}

?>