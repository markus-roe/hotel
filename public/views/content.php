<?php

require_once getcwd()."/core/compoundView.php";

class Content extends Compound
{
    function __construct()
    {
        $this->view =
        [
            "content" => new View("content", ["content-body", "content-headline"])
        ];
    }
}