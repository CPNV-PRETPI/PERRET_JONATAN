<?php

use PhpParser\JsonDecoder;


/**
 * @param string $name
 * @return Workout
 * @throws WorkoutException
 */
function GetWorkout(string $name):Workout{
    $workouts = GetWorkouts();
    // Get the wanted workout with its name
    try {
        foreach ($workouts as $workoutTmp) {
            if ($workoutTmp->Name == $name) {
                return $workoutTmp;
            }
        }
    }catch (Exception $e){
        throw new WorkoutException("An error occurred");
    }
    // throw an exception if workout is not found
    throw new WorkoutException("Workout not found");
}

function GetWorkouts():array{
    $time_pre = microtime(true);
    include_once ("Utils/DbConnector.php");

    include_once "Models/Workout.php";
    // Read the workout files
    $fileContent = file_get_contents("DATA/Workouts.json");
    // Deserialize the json into object
    try {
        $workouts = json_decode($fileContent, TRUE);
    } catch (Exception $e) {
        throw new WorkoutException("An error occurred");
    }

    $workoutsArray = [];

    try {
        foreach ($workouts as $workoutTmp) {
            $Workout = new Workout();
            $Workout->FromJson($workoutTmp);
            array_push($workoutsArray, $Workout);
        }
        $time_post = microtime(true);
        $exec_time = $time_post - $time_pre;
        include_once("Utils/LogManager.php");
        WriteLog($_SESSION["username"] . " get all workouts: ", $exec_time);
        return $workoutsArray;
    }catch (Exception $e){
        throw new WorkoutException("An error occurred");
    }
}


?>