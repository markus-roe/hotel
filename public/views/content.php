<?php

require_once getcwd()."/core/compoundView.php";

class Content extends Compound
{
    function __construct()
    {
        $this->views =
        [
            "content" => new View("content", ["content-headline", "content-body"])
        ];
    }
}