<?php

require_once getcwd()."/core/component.php";

class Content extends Component
{
    function __construct()
    {
        $this->views =
        [
            "contentWrapperStart" => new View("contentWrapperStart"),
            "content" => null,
            "contentWrapperEnd" => new View("contentWrapperEnd")
        ];
    }
}