<?php 

    function ConnectToDB(){
        // Get the database credentials from the DbCrendentials.json file
        $json = file_get_contents('DATA/DbCredentials.json');
        $obj = json_decode($json);
        $url = $obj->url;
        $port = $obj->port;
        $user = $obj->user;
        $database = $obj->database;
        $password = $obj->password;

        // Connect to the database
        $conn = new mysqli($url, $user, $password, $database, $port);
        if ($conn->connect_error) {
            http_response_code(500);
            $conn->close();
            throw new Exception("Connection failed");
        }
        return $conn;
    }

    function Authenticate($securityString){
        // connect to db
        $conn = ConnectToDB();

        // check if securityString is valid
        $sql = "SELECT * FROM users WHERE secure_string = '$securityString'";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $usertmp = $row;
            }
        } else {
            throw new LoginException("Invalid security string");
        }

        $conn->close();

        require_once("Models/User.php");
        // create the new user object
        $user = new User($usertmp['username'], $securityString, $usertmp['policies'] == null ? "" : $usertmp['policies']);


        return $user;
    }

    class LoginException extends Exception{}


?>