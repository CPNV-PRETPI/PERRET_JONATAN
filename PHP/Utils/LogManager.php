<?php 
    function WriteLog($message, $timeToExecute){
        try{
            $path = $_SERVER['DOCUMENT_ROOT'] . "Logs/";
            $filename = "log_api.txt";
            $fullpath = $path . $filename;

            $message = date("Y-m-d H:i:s") . " - " . $message . " - " . round($timeToExecute*1000, 3) . " ms";

            $logFile = fopen($fullpath, "w+");
            fwrite($logFile, $message . "\n");
            fclose($logFile);
        }catch (Exception $e){

        }
    }
?>