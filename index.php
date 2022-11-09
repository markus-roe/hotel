<?php


require_once("./public/views/page.php");

$mock_params = ["documentTitle"=>"Ipsum Hotel", "menu-links"=>"TEST LINK"];

$homePage = new Page();
$homePage->render($mock_params);