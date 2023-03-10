<?php 
    function WriteLog($message, $timeToExecute){
        try{
            $path = $_SERVER['DOCUMENT_ROOT'] . "/Logs/";
            $filename = "log_api.txt";
            $fullpath = $path . $filename;

            $message = date("Y-m-d H:i:s") . " - " . $message . " - " . round($timeToExecute*1000, 3) . " ms";

            if(file_exists($fullpath)){
                $logFile = fopen($fullpath, "a+") or die("Can't open log file");
                fwrite($logFile, $message . "\n");
            }else{
                $logFile = fopen($fullpath, "w");
                fwrite($logFile, $message . "\n");
            }
            fclose($logFile);
        }catch (Exception $e){
            print($e);
        }
    }
?>