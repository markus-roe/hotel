<?php

require_once getcwd()."/public/views/Components/menu.php";

class MenuLarge extends Menu
{
    function __construct()
    {
        parent::__construct("large");
    }
}