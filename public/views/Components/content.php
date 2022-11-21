<?php

require_once getcwd()."/core/component.php";

class Content extends Component
{
    function __construct()
    {
        $this->views =
        [
            "contentWrapperStart" => new View("contentWrapperStart"),
            "contentBody" => new View("contentBasic", ["content-title", "content-body"]),
            "contentWrapperEnd" => new View("contentWrapperEnd")
        ];
    }

    public function changeContentBody($newContentBody)
    {
        $this->insert("contentBody", $newContentBody);
    }
}