<?php

require_once getcwd()."/core/compoundView.php";

class Home extends Compound
{
    function __construct()
    {
        // parent::__construct($params);
        
        $this->views = 
        [
            "header" => new View(["documentTitle"=>"Ipsum Hotel"], "header"),
            "menu" => new View(["menu-links"], "menu"),
            "footer" => new View($this->params, "footer")
        ];
    }
}