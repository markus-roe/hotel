<?php
include("./utils.php");
include("./createLinks.php");

$linksDataCollJSON = file_get_contents("./menuLinks.txt");
$linksDataColl = json_decode($linksDataCollJSON, true);
$linksHTML = '';

foreach($linksDataColl as $linkData) {
   $linksHTML .= createLink($linkData);
}
echo $linksHTML;