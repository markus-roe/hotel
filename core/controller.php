<?php

require_once  getcwd()."/core/view.php";
require_once  getcwd()."/core/component.php";
require_once  getcwd()."/public/views/menu.php";
require_once  getcwd()."/public/views/home.php";
require_once  getcwd()."/public/views/page.php";
require_once  getcwd()."/mock_params.php";


class HomeController
{

    function __construct($request)
    {
        $this->request = $request;
    }

    public function before()
    {
        // user authentifizieren / validieren etc
        // userdaten laden aus DB
    }

    public function after()
    {

    }

    public function execute()
    {
        $mock_params = ["menu-username"=>"Maximilian Sinnl", "documentTitle"=>"Ipsum-Hotel", "menu-links"=>"TEST LINK", "content-headline" => "CONTENT-HEADLINE"];
$mock_params["content-body"] = "    <b>Lorem ipsum dolor</b> sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.   

Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.   

Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.   

Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer
    ";
        $page = new Page();
        $page->parse($mock_params);
        $page->render();
    }
}