<?php

require_once getcwd()."/core/component.php";

class Content extends Component
{
    function __construct()
    {
        $this->view =
        [
            "content" => new View("content", ["content-body", "content-headline"])
        ];
    }
}