<?php

require_once getcwd()."/public/views/menu.php";

class MenuLarge extends Menu
{
    function __construct()
    {
        parent::__construct("large");
    }
}