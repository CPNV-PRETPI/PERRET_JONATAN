<?php

class ErrorClass
{
    public string $Code;
    public string $Name;
    public string $Message;

    /**
     * @param string $Code
     * @param string $Name
     * @param string $Message
     */
    public function __construct(string $Code, string $Name, string $Message)
    {
        http_response_code($Code);
        $this->Code = $Code;
        $this->Name = $Name;
        $this->Message = $Message;
    }


}