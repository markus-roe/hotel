<?php

require_once getcwd()."/public/views/Components/Page.php";

class ImprintPage extends Page
{
    function __construct()
    {
        parent::__construct();

        $this->requireView("/Content/imprintContent");
        $imprintContent = new ImprintContent();
        $this->insert("content", $imprintContent);
    }

}