<?php

require_once getcwd()."/public/views/Components/Menu.php";

class MenuSmall extends Menu
{
    function __construct()
    {
        parent::__construct("small");
    }
}