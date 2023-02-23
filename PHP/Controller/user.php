<?php 

    function Login($_post){
        $securityString = $_post['security-string'];
        // Hash the security string
        $hashPasswordHash = hash("sha256", $securityString);
        
        try{
            $time_pre = microtime(true);
            require_once("Utils/DbConnector.php");
            $user = Authenticate($hashPasswordHash);
            $time_post = microtime(true);
            $exec_time = $time_post - $time_pre;
            require_once("Utils/LogManager.php");
            WriteLog($user->username . " logged in: ", $exec_time);
            return $user;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
?>