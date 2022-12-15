<?php
// include_once("./public/utils/createHTML.php");

// function createLink($link) {
//     $li = new html_element("li");
//     $li->set("id", "TEST");
//     return $li->output();
//     $li->build();
//     $a_tag = new html_element("a");
//     $a_tag->set("href", $link->href);
//     $a_tag->set("text", $link->textContent);
 
//     if (getCurrentPage() == $link->href) {
//        $a_tag->set("class", "active-link");
//     }
//     $a_tag->build();

//     $li->inject($a_tag);
//     return $link;
// }
function createLink($link) {
    $class = getCurrentPage() == $link["href"] ? "active-link" : "";

    return '<li><a class="'.$class.'" href="'.$link["href"].'">'.$link["textContent"].'</a></li>';
 }