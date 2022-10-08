<?php
// $headerTitle;
// $mainSection;
// $displayMainSection;
// include("./routing.php");
// $topSectionType = "-main";
// include("./public/templates/header.php");
// include("./public/templates/menu.php");

// if ($displayMainSection == true)
// {
//     include("./public/templates/mainSection.php");
//     include("./public/templates/mainSectionEnd.php");
//     include("./public/templates/footer.php");
// }
// include("./public/templates/footer.php");

require_once("./public/views/home.php");
$home = new Home(null);
$home->render();
$home->display();