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
}
