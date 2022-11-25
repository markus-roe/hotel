<?php
session_start();
// session_destroy();
require_once "./core/console_log.php";
require_once "./core/app.php";
require_once "./core/router.php";


try {
    
    $app = new App();

    $app->router->get("/:controller/:action");
    $app->router->get("/:controller/:view/:action");
    $app->router->get("/:controller");
    $app->router->post("/:controller/:action");
    $app->router->get("/news/:controller/:view/:action/id/:articleid");
    $app->router->get("/news/:controller/:view/:action");
    $app->router->post("/news/:controller/:action");


    $app->run();

} catch (\Throwable $th) {
    echo $th;
}

