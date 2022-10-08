<?php

function getData($path) {
    $jsonString = file_get_contents($path);
    $jsonDecoded = json_decode($jsonString, true);
    return $jsonDecoded;
}
