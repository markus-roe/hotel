<?php

require_once getcwd()."/core/component.php";

class Content extends Component
{
    function __construct()
    {
        $this->views =
        [
            "content" => new View("content", ["content-body"=>"<h1>TEST</h1>", "content-headline"])
        ];
    }
}