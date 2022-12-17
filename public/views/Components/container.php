<?php
require_once getcwd()."/core/component.php";

class Container extends Component
{
    function __construct()
    {
        parent::__construct();
    }

    public function add($element)
    {
        array_push($this->templates, $element);
    }
}