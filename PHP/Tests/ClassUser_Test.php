<?php


use PHPUnit\Framework\TestCase;

class ClassUser_Test extends TestCase
{
    public User $user;
    public string $expectedUsername;
    public string $expectedSecureString;
    public string $expectedPolicies;
    public string $expectedLoginDate;


    public function setUp(): void
    {
        include_once "Models/User.php";
        $this->expectedUsername = "";
        $this->expectedSecureString = "";
        $this->expectedPolicies = "";
        $this->expectedLoginDate = date("Y-m-d H:i:s");
        $this->user = new User($this->expectedUsername, $this->expectedSecureString, $this->expectedPolicies, $this->expectedLoginDate);
    }

    public function testGetLoginDate()
    {
        $this->assertSame($this->expectedLoginDate, $this->user->getLoginDate());

    }

    public function testGetSecureString()
    {
        $this->assertSame($this->expectedSecureString, $this->user->getSecureString());
    }

    public function testGetUsername()
    {
        $this->assertSame($this->expectedUsername, $this->user->getUsername());
    }

    public function testGetPolicies()
    {
        $this->assertSame($this->expectedPolicies, $this->user->getPolicies());
    }

    public function testSetLoginDate()
    {
        $this->assertSame($this->expectedLoginDate, $this->user->getLoginDate());
        $this->expectedLoginDate = date('Y-m-d H:i:s', strtotime($this->user->getLoginDate(). ' + 3 hours'));
        $this->user->setLoginDate($this->expectedLoginDate);
        $this->assertSame($this->expectedLoginDate, $this->user->getLoginDate());
    }

    public function testSetSecureString()
    {
        $this->assertSame($this->expectedSecureString, $this->user->getSecureString());
        $this->expectedSecureString = "new secureString";
        $this->user->setSecureString($this->expectedSecureString);
        $this->assertSame($this->expectedSecureString, $this->user->getSecureString());
    }

    public function testSetUsername()
    {
        $this->assertSame($this->expectedUsername, $this->user->getUsername());
        $this->expectedUsername = "new Username";
        $this->user->setUsername($this->expectedUsername);
        $this->assertSame($this->expectedUsername, $this->user->getUsername());
    }

    public function testSetPolicies()
    {
        $this->assertSame($this->expectedPolicies, $this->user->getPolicies());
        $this->expectedPolicies = "new policies";
        $this->user->setPolicies($this->expectedPolicies);
        $this->assertSame($this->expectedPolicies, $this->user->getPolicies());
    }

    public function test__construct()
    {
        $expectedUsername = $this->expectedUsername;
        $expectedSecureString = $this->expectedSecureString;
        $expectedPolicies = $this->expectedPolicies;
        $expectedLoginDate = $this->expectedLoginDate;
        $user = new User($this->expectedUsername, $this->expectedSecureString, $this->expectedPolicies, $this->expectedLoginDate);
        $this->assertSame($this->expectedUsername, $this->user->getUsername());
        $this->assertSame($this->expectedSecureString, $this->user->getSecureString());
        $this->assertSame($this->expectedPolicies, $this->user->getPolicies());
        $this->assertSame($this->expectedLoginDate, $this->user->getLoginDate());
    }
}