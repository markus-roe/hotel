<?php

function getData($path) {
    $jsonDerulo = file_get_contents($path);
    $jsonDecoded = json_decode($jsonDerulo, true);
    return $jsonDecoded;
}
