<?php 
    function WriteLog($message, $timeToExecute){
        $path = "Logs/";
        $filename = "log_api.txt";
        $fullpath = $path . $filename;

        $message = date("Y-m-d H:i:s") . " - " . $message . " - " . round($timeToExecute, 3) . " seconds";

        $logFile = fopen($fullpath, "a");
        fwrite($logFile, $message . "\n");
        fclose($logFile);
    }
?>