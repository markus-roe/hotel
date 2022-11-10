<?php


require_once("./public/views/page.php");
// require_once("./public/views/nested_content_test.php");

$mock_params = ["menu-username"=>"Maximilian Sinnl", "documentTitle"=>"Ipsum-Hotel", "menu-links"=>"TEST LINK", "content-headline" => "CONTENT-HEADLINE"];
$mock_params["content-body"] = "    <b>Lorem ipsum dolor</b> sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.   

Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.   

Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.   

Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer
    ";


// $content = new Content();
// $content->parse(["content-body" => $mockString, "content-headline"=>"CONTENT HEADLINE"]);

// $mock_params["content-body"] = $content->getView();

//BUG Fatal error: Uncaught TypeError: htmlspecialchars(): Argument #1 ($string) must be of type string, Content given in C:\xampp\htdocs\hotel\core\view.php:46 Stack trace: #0 C:\xampp\htdocs\hotel\core\view.php(46): htmlspecialchars(Object(Content)) #1 C:\xampp\htdocs\hotel\core\view.php(57): View::parseTemplate('<div>\r\n <h1>...', Array) #2 C:\xampp\htdocs\hotel\core\compoundView.php(68): View->parse(Array) #3 C:\xampp\htdocs\hotel\index.php(24): Compound->parse(Array) #4 {main} thrown in C:\xampp\htdocs\hotel\core\view.php on line 46

$page = new Page();
$page->parse($mock_params);
$page->render();