<?php



/**
 *
 */
class Workout
{
    public string $Name;
    public string $ApproxTime;
    public string $CoverImageUrl;
    public array $Series;

    /**
     * @throws WorkoutException
     */
    function FromJson($json):void{
        try {
            $this->Name = $json["Name"];
            $this->ApproxTime = $json["ApproxTime"];
            $this->CoverImageUrl = $json["CoverImageUrl"];
            $this->Series = [];
            foreach ($json["Series"] as $serieTmp) {
                include_once "Models/Serie.php";
                $serie = new Serie();
                $serie->Name = $serieTmp["Name"];
                $serie->NumberOfSets = $serieTmp["NumberOfSets"];
                $serie->TimeBetweenSets = $serieTmp["TimeBetweenSets"];
                $serie->TimeAfterSets = $serieTmp["TimeAfterSets"];
                include_once "Models/Exercise.php";
                $exercise = new Exercise();
                $exercise->Name = $serieTmp["Exercise"]["Name"];
                $exercise->NumberOfRepetitions = $serieTmp["Exercise"]["NumberOfRepetitions"];
                $exercise->PathToVideo = $serieTmp["Exercise"]["PathToVideo"];
                $exercise->PathToCoverImage = $serieTmp["Exercise"]["PathToCoverImage"];
                $serie->Exercise = $exercise;
                array_push($this->Series, $serie);
            }
        }catch(TypeError $e){
            throw new WorkoutException("Cannot create object from json");
        }
    }
}


class WorkoutException extends Exception{}