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
    case "authenticate" :
        // Login 
        require_once("Controller/user.php");
        $tmpUser = Login($_POST);
        $user = array("username"=>$tmpUser->username, "policies"=>$tmpUser->policies);
        print json_encode($user);
        break;
    default:
        print "this apimethod is not supported";
        break;
}

?>