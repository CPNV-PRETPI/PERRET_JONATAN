<?php


use PHPUnit\Framework\TestCase;

class WorkoutManager_Test extends TestCase
{
    function test_GetWorkout_Exist(){
        include_once "Controller/WorkoutManager.php";
        try {
            $expectedName = "Legs";
            $workout = GetWorkout($expectedName);
            $this->assertEquals($expectedName, $workout->Name);
        }catch(WorkoutException $e){
            $i = 0;
        }
    }
    function test_GetWorkout_NotExist(){
        include_once "Controller/WorkoutManager.php";
        include_once "Models/Workout.php";
        $expectedName = "Legss";
        $this->expectException(WorkoutException::class);
        $workout = GetWorkout($expectedName);
    }

    function test_GetWorkouts_GetAllWorkouts(){
        include_once "Controller/WorkoutManager.php";
        $expectedJson = '[{"Name":"Legs","ApproxTime":"1h","Series":[{"Name":"Squats","NumberOfSets":"3","TimeBetweenSets":"1min 30","TimeAfterSets":"2min","Exercise":{"Name":"Squat","NumberOfRepetitions":"until failure","PathToVideo":"","PathToCoverImage":""}},{"Name":"Leg presses","NumberOfSets":"3","TimeBetweenSets":"1min 30","TimeAfterSets":"2min","Exercise":{"Name":"Leg press","NumberOfRepetitions":"until failure","PathToVideo":"","PathToCoverImage":""}}]}]';
        $workouts = GetWorkouts();
        $this->assertEquals($expectedJson, json_encode($workouts));
    }
}
