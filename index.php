<?php
session_start();
// session_destroy();
require_once "./core/console_log.php";
require_once "./core/app.php";
require_once "./core/router.php";
require_once "./core/models/bookingModel.php";

define('baseURL', "http://localhost/hotel");

$model = new BookingModel();

// $res = $model->createReceipt(69.69);
// var_dump($res);

// return 0;
// die();

// var_dump($_SERVER);receiptId
try {
    
    $app = new App();

    $app->router->get("/main/:view");
    $app->router->get("/booking/rooms");
    $app->router->get("/booking/bookingdetails/:userid");
    $app->router->get("/booking/bookingdetails");
    $app->router->get("/booking/room/:roomid");
    $app->router->post("/booking/:roomid/:action/");
    $app->router->get("/article/preview");
    $app->router->get("/article/newpost");
    $app->router->get("/article/post/:articleid");
    $app->router->get("/article/post/id/:articleid");
    $app->router->post("/article/:action");
    $app->router->get("/client/profile");
    $app->router->get("/admin/guests");
    $app->router->get("/admin/bookingdetails");
    $app->router->get("/admin/userprofile/:userid");
    $app->router->post("/admin/:action/:userid");
    $app->router->post("/admin/:action/:bookingid");
    $app->router->post("/client/:action");
    $app->router->get("/login/:action");
    $app->router->post("/login/:action");
    $app->router->post("/client/:action/:userid");



    $app->run();

} catch (\Throwable $th) {
    echo $th;
}

