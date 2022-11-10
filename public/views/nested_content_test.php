<?php

require_once getcwd()."/core/compoundView.php";

class InputField extends Compound
{
    function __construct()
    {
        $this->views =
        [
            "nested" => new View("nested_content_test", ["test"])
        ];
    }
}