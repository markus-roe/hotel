<?php
session_start();
// session_destroy();
require_once "./core/app.php";
require_once "./core/router.php";
// include "./core/acl.php";
// new AccessControl();

// $r = new Router();

// $r->createRegexPattern()

try {
    
    $app = new App();

    $app->router->get("/:controller/:action");
    $app->router->get("/:controller");
    $app->router->post("/:controller/:action");
    $app->router->get("/news/:controller/:action/id/:articleid");
    $app->router->get("/news/:controller/:action");
    $app->router->post("/news/:controller/:action");

    $app->run();

} catch (\Throwable $th) {
    echo $th;
}

