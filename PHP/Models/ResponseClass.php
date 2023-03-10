<?php

class ResponseClass
{
    public string $Code;
    public string $Status;
    public string $Message;
    public string $Content;

    /**
     * @param string $Code
     * @param string $Status
     * @param string $Message
     * @param string $Content
     */
    public function __construct(string $Code, string $Status, string $Message, string $Content = "")
    {
        $this->Code = $Code;
        $this->Status = $Status;
        $this->Message = $Message;
        $this->Content = $Content;
    }


}