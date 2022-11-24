<?php

require_once "./core/errorCodes.php";

function getCurrentPage() {
    return $_SERVER['REQUEST_URI'];
}

