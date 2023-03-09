<?php

if(!isset($_GET['apimethod'])) {
    print "no apimethod specified";
    exit;
}
require_once "Models/ErrorClass.php";

// switch with get field apimethod
switch($_GET['apimethod']) {
    case 'ping':
        print "pong";
        break;
    case 'phpinfo':
        phpinfo();
        break;
    case "authenticate" :
        // Login 
        try{
            require_once("Controller/user.php");
            $tmpUser = Login($_POST);
            $user = array("secureString"=>$tmpUser->getSecureString(), "username"=>$tmpUser->getUsername(), "policies"=>$tmpUser->getPolicies());
            print json_encode($user);
        }catch(LoginException $e) {
            switch ($e->getMessage()) {
                case"No SecureString specified":
                    $error = new ErrorClass("401", "Bad parameter", "You need to provide a secure string");
                    print (json_encode($error));
                    break;
                case"Invalid security string":
                    $error = new ErrorClass("401", "Not authorized", "Incorrect login");
                    print (json_encode($error));
                    break;
            }
        }
        break;
    case "workouts":
        // Verify Login
        try {
            require_once "Controller/user.php";
            $tmpUser = Login($_POST);

            // Get all available workouts
            require_once("Controller/WorkoutManager.php");
            try {
                $workouts = GetWorkouts();
                print json_encode($workouts);
            } catch (WorkoutException $e) {
                $error = new ErrorClass("400", "Bad parameter", "You need to provide a secure string");
                print (json_encode($error));
            }
        }catch(LoginException $e){
            switch($e->getMessage()) {
                case"No SecureString specified":
                    $error = new ErrorClass("401", "Bad parameter", "You need to provide a secure string");
                    print (json_encode($error));
                    break;
                case"Invalid security string":
                    $error = new ErrorClass("401", "Not authorized", "Incorrect login");
                    print (json_encode($error));
                    break;
            }
        }


        break;
    case 'test':
        $path = $_SERVER['DOCUMENT_ROOT'] . "Logs/";
        $filename = "log_api.txt";
        $fullpath = $path . $filename;
        print $fullpath;
        break;
    default:
        print "this apimethod is not supported";
        break;
}

?>