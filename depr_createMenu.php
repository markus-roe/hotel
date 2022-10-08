<?php
include_once("./utils.php");
include_once("./htmlElements.php");

$links_string = file_get_contents("./menuLinks.txt");
$links_json = json_decode($links);

// function createLink($link) {
//    $li = new html_element("li");
//    $a_tag = new html_element("a");
//    $a_tag->set("href", $link->href);
//    $a_tag->set("text", $link->textContent);

//    if (getCurrentPage() == $link->href) {
//       $a_tag->set("class", "active-link");
//    }
//    $li->inject($a_tag);
//    return $link;
// }

function createLink($link) {
   $class = getCurrentPage() == $link->href ? "active-link" : "";
   return `<li><a class="$class" href="$link->href">$link->textContent</a></li>`;
}