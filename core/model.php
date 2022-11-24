<?php
 class Model {
  // Hold the class instance.
  private static $instance = null;
  public static $connection;

   
  // The db connection is established in the private constructor.
  public function __construct()
  {
    if(!self::$connection)
    {
      self::$connection = new mysqli("localhost", "root", "", "ipsum");
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

  protected function executeQuery($table, $arr)
  {
      $sql = "SELECT * FROM " . $table . " WHERE";

      // * insert keys in SQL string
      for ($i = 0; $i < count($arr); $i++) 
      {
          $sql = $sql . " " . array_keys($arr)[$i] . " = ?";

          if ($i < count($arr)-1)
          {
              $sql = $sql . " AND ";
          }
      }

      $params = array();

      // * push params to bind in array
      foreach ($arr as $key => $value)
      {
          array_push($params, $value);
      }

      //* bind param type string e.g. "ss" for two params strings
      $paramstring = "";
      
      $len = count($arr);
      while ($len) {
          $paramstring = $paramstring . "s";
          $len--;
      }
      
      // * execute sql with parent model connection
      $stmt = self::$connection->prepare($sql);
      $stmt->bind_param($paramstring, ...$params);
      $stmt->execute();
      $result = $stmt->get_result();
      $row = $result->fetch_array(MYSQLI_ASSOC);
      
      return $row;
  }

}
