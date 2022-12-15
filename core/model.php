<?php

require_once getcwd()."/core/utils.php";
require_once getcwd()."/core/config.php";


 class Model {
  // Hold the class instance.
  private static $instance = null;
  public static $connection;

   
  // The db connection is established in the private constructor.
  public function __construct()
  {
    if(!self::$connection)
    {
      $config = new Config();
      self::$connection = new mysqli($config->host, $config->user, $config->password, $config->database);
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

  public function executeQuery($query, $paramString = "", $paramsArray = [])
  {        
      try
      {
          $rows = [];
          $params = array();

          // * push params to bind in array
          foreach ($paramsArray as $key => $value)
          {
              array_push($params, $value);
          }
          
          // * execute sql with parent model connection
          $stmt = self::$connection->prepare($query);

          if(count($paramsArray))
          {
              $stmt->bind_param($paramString, ...$params);
          }

          $stmt->execute();
          $result = $stmt->get_result();

          if(str_contains($query, "SELECT"))
          {
              while($row = $result->fetch_assoc())
          {
              $rows[] = $row;
          }
          // debug backtrace to know which function executed the query -> slows down app so commented out
          // console_log(debug_backtrace()[1]['function'] . ": ");
          console_log($rows);
          return $rows;
          }
          return self::$connection->insert_id;

      } 
      catch (\Throwable $th) {
          throw $th;
      }
  }

}
