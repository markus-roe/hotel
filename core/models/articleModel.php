<?php 

require_once  getcwd()."/core/model.php";


//! Pfad f. pictures zB: ./public/uploads/pictures/stockmarket.jpg

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
