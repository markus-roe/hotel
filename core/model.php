<?php

require_once getcwd()."/core/utils.php";


 class Model {
  // Hold the class instance.
  private static $instance = null;
  public static $connection;

   
  // The db connection is established in the private constructor.
  public function __construct()
  {
    if(!self::$connection)
    {
      self::$connection = new mysqli("207.hosttech.eu:3306", "ipsum_admin", "ipsum123", "ipsum");
    }

  }
  
  public static function getInstance()
  {
    if(!self::$instance)
    {
      self::$instance = new Model();
    }
   
    return self::$instance;
  }
  
  public function getConnection()
  {
    return $this->connection;
  }

}
