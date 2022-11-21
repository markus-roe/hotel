<?php
require_once  getcwd()."/config.php";

// TODO
/*
    + Singleton-Pattern implementieren
*/
class Model
{

    public $connection;

    public function __construct() 
    {
        $this->connection = $this->connect();
    } 

    public function connect()
    {
        try{
            $config = new Config();
            $mysqli = new mysqli($config->host, $config->user, $config->password, $config->database);

            if ($mysqli -> connect_errno) {
                echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
                exit();
            }

        }
        catch(Exception $e) 
        {
            echo 'Message: ' .$e->getMessage();
        }

        return $mysqli;
    }
}
