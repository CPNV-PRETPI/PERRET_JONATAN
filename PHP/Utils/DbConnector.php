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
            die("Connection failed: " . $conn->connect_error);
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
            throw new Exception("Invalid security string");
        }

        $conn->close();

        require_once("Models/User.php");
        // create the new user object
        $user = new User();
        $user->username = $usertmp['username'];
        $user->secure_string = $securityString;
        $user->policies = $usertmp['policies'] == null ? "" : $usertmp['policies'];
        $user->login_date = date("Y-m-d H:i:s");


        return $user;
    }

?>