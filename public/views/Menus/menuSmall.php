<?php

require_once getcwd()."/public/views/Components/menu.php";

class MenuSmall extends Menu
{
    function __construct()
    {
        parent::__construct("small");
    }
}