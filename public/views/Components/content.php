<?php

require_once getcwd()."/core/component.php";

class Content extends Component
{
    function __construct()
    {
        $this->templates =
        [
            "contentWrapperStart" => new Template("contentWrapperStart"),
            "contentBody" => new Template("contentBasic", ["content-title", "content-body"]),
            "contentWrapperEnd" => new Template("contentWrapperEnd")
        ];
    }

    public function changeContentBody($newContentBody)
    {
        $this->insert("contentBody", $newContentBody);
    }
}