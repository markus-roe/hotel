<?php
session_start();
require_once "./core/console_log.php";
require_once "./core/app.php";
require_once "./core/router.php";
require_once "./core/models/bookingModel.php";

// differnt roots on mac and windows
if(str_contains($_SERVER["DOCUMENT_ROOT"], 'lamp'))
{
    // mac baseURL
    define('baseURL', "http://192.168.64.2/hotel");
}
else 
{
    // windows baseURL
    define('baseURL', "http://localhost/hotel");
}

try {
    
    $app = new App();
    
    $app->router->get("/main/:view");
    $app->router->get("/booking/rooms");
    $app->router->get("/booking/bookingdetails/:userid");
    $app->router->get("/booking/bookingdetails");
    $app->router->get("/booking/room/:roomid");
    $app->router->get("/registration/newuser");
    $app->router->get("/registration/:view");
    $app->router->post("/registration/:action");
    $app->router->post("/booking/:id/:action");
    $app->router->get("/article/preview");
    $app->router->get("/article/newpost");
    $app->router->get("/article/post/:articleid");
    $app->router->get("/article/post/id/:articleid");
    $app->router->post("/article/:action");
    $app->router->post("/client/:action/:userid");
    $app->router->get("/client/profile");
    $app->router->get("/admin/guests");
    $app->router->get("/admin/bookingdetails");
    $app->router->get("/admin/userprofile/:userid");
    $app->router->post("/admin/:action/:userid");
    $app->router->post("/admin/:action/:bookingid");
    $app->router->post("/client/:action");
    $app->router->get("/login/:action");
    $app->router->post("/login/:action");



    $app->run();

} catch (\Throwable $th) {
    echo $th;
}

