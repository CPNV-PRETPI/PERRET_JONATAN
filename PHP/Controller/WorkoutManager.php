<?php

use PhpParser\JsonDecoder;


/**
 * @param string $name
 * @return Workout
 * @throws WorkoutException
 */
function GetWorkout(string $name):Workout{
    include_once "Models/Workout.php";
    // Read the workout files
    $fileContent = file_get_contents("DATA/Workouts.json");
    // Deserialize the json into object
    try {
        $Workouts = json_decode($fileContent, TRUE);
    } catch (Exception $e) {
        throw new WorkoutException("An error occurred");
    }
    // Get the wanted workout with its name
    try {
        foreach ($Workouts as $workoutTmp) {
            if ($workoutTmp["name"] == $name) {
                $Workout = new Workout();
                $Workout->FromJson($workoutTmp);
                return $Workout;
            }
        }
    }catch (Exception $e){
        throw new WorkoutException("An error occurred");
    }
    // throw an exception if workout is not found
    throw new WorkoutException("Workout not found");
}


?>