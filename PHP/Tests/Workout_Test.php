<?php


use PHPUnit\Framework\TestCase;

class Workout_Test extends TestCase
{

    public function test_FromJson_Working()
    {
        $initialJson = '{"Name":"Legs","ApproxTime":"1h","Series":[{"Name":"Squats","NumberOfSets":"3","TimeBetweenSets":"1min 30","TimeAfterSets":"2min","Exercise":{"Name":"Squat","NumberOfRepetitions":"until failure","PathToVideo":"","PathToCoverImage":""}}]}';
        include_once "Models/Workout.php";
        $workout = new Workout();
        $workout->FromJson(json_decode($initialJson, TRUE));

        $this->assertEquals($initialJson, json_encode($workout));
    }

    public function test_FromJson_Exception()
    {
        $initialJson = '{"Names":"Legs","ApproxTime":"1h","Series":[{"Name":"Squats","NumberOfSets":"3","TimeBetweenSets":"1min 30","TimeAfterSets":"2min","Exercise":{"Name":"Squat","NumberOfRepetitions":"until failure","PathToVideo":"","PathToCoverImage":""}}]}';
        include_once "Models/Workout.php";
        $workout = new Workout();
        $this->expectException(WorkoutException::class);
        $workout->FromJson(json_decode($initialJson, TRUE));

    }
}
