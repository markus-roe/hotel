<?php 

require_once  getcwd()."/core/model.php";

class ClientModel extends Model
{



    public function __construct()
    {
        $this->connection = parent::connect();
    }

    public function getArticles()
    {
        return "all Articles in Array";
    }

}
