<?php

/**
 * @param $_post
 * @return User
 */
function Login(array $_post): User
{
    if(isset($_post['security-string']))
        $securityString = $_post['security-string'];
    else throw new LoginException("No SecureString specified");

    // Hash the security string
    $hashPasswordHash = hash("sha256", $securityString);

    try{
        $time_pre = microtime(true);
        include_once ("Utils/DbConnector.php");
        $user = Authenticate($hashPasswordHash);
        $_SESSION["username"] = $user->getUsername();
        $time_post = microtime(true);
        $exec_time = $time_post - $time_pre;
        include_once("Utils/LogManager.php");
        WriteLog($_SESSION["username"] . " logged in: ", $exec_time);
        return $user;
    } catch (Exception $e) {
        throw new LoginException($e->getMessage());
    }
}
class LoginException extends Exception{}
?>