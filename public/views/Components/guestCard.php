<?php
require_once getcwd()."/core/component.php";

class GuestCard extends Component
{
    function __construct()
    {
        $this->templates =
        [
            "card" => new Template("guestCardTemplate")
        ];
    }
}