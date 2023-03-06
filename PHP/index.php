<?php

if(!isset($_GET['apimethod'])) {
    print "no apimethod specified";
    exit;
}

// switch with get field apimethod
switch($_GET['apimethod']) {
    case 'ping':
        print "pong";
        break;
    case "authenticate" :
        // Login 
        require_once("Controller/user.php");
        $tmpUser = Login($_POST);
        $user = array("username"=>$tmpUser->getUsername(), "policies"=>$tmpUser->getPolicies());
        print json_encode($user);
        break;
    case "workouts":
        // Get all available workouts
        require_once("Controller/WorkoutManager.php");
        try {
            $workouts = GetWorkouts();
            print json_encode($workouts);
        } catch (WorkoutException $e) {
        }
        break;
    default:
        print "this apimethod is not supported";
        break;
}

?>