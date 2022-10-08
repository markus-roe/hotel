<?php

require_once getcwd()."/core/compoundView.php";

class Home extends Compound
{
    function __construct($params)
    {
        parent::__construct($params);
        
        $this->views = 
        [
            "header" => new View($this->params, "header"),
            "nav" => new View($this->params, "menu"),
            "main" => new View($this->params, "mainSection"),
            "mainEnd" => new View($this->params, "mainSectionEnd"),
            "footer" => new View($this->params, "footer")
        ];
    }
}