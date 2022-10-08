<?php

class Controller
{
    $this->routingInfo = [];
    function __construct($routingInfo)
    {
        $this->routingInfo = $routingInfo;
    }

    public function before()
    {
        // user authentifizieren / validieren etc
        // userdaten laden aus DB
    }

    public function after()
    {

    }
}


function run()
{
    
}