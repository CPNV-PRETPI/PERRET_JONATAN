<?php

/**
 * @param $_post
 * @return User
 */
function Login(array $_post): User
{
        $securityString = $_post['security-string'];
        // Hash the security string
        $hashPasswordHash = hash("sha256", $securityString);
        
        try{
            $time_pre = microtime(true);
            include_once ("Utils/DbConnector.php");
            $user = Authenticate($hashPasswordHash);
            $time_post = microtime(true);
            $exec_time = $time_post - $time_pre;
            include_once("Utils/LogManager.php");
            WriteLog($user->getUsername() . " logged in: ", $exec_time);
            return $user;
        } catch (Exception $e) {
            http_response_code(401);
            throw new LoginException($e->getMessage());
        }
    }
?>