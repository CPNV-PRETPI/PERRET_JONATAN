<?php


use PHPUnit\Framework\TestCase;

class User_Test extends TestCase
{
    public function test_Authenticate_CorrectLogin(){
        $userName = "UserTest";
        $secureString = "vXjKbLmZcNhGfTdRgHkYbUmNpQsCdHjX";
        $hashedSecureSring = hash("sha256", $secureString);
        $_POST["security-string"] = $secureString;

        include_once "Models/User.php";
        $expectedUser = new User($userName, $hashedSecureSring, "");

        include_once "Controller/user.php";
        try {
            $user = Login($_POST);
        } catch (Exception $e) {

        }

        $this->assertSame($expectedUser->getUsername(), $user->getUsername());
        $this->assertSame($expectedUser->getSecureString(), $user->getSecureString());
        $this->assertSame($expectedUser->getLoginDate(), $user->getLoginDate());
        $this->assertSame($expectedUser->getPolicies(), $user->getPolicies());
    }

    public function test_Authenticate_WrongLogin(){
        $userName = "UserTest";
        $secureString = "WrongSecureString";
        $hashedSecureSring = hash("sha256", $secureString);
        $_POST["security-string"] = $secureString;

        include_once "Models/User.php";
        $expectedUser = new User($userName, $hashedSecureSring, "");

        include_once "Controller/user.php";
        try {
            $user = Login($_POST);
        } catch (Exception $e) {
            $this->assertEquals("Invalid security string", $e->getMessage());
        }

    }
}
