<?php
session_start();
require_once "./core/app.php";
require_once "./core/router.php";
// include "./core/acl.php";
// new AccessControl();

// $r = new Router();

// $r->createRegexPattern()

$app = new App();

$app->router->get("/:controller/:action");
$app->router->get("/news/:controller/:action/id/:articleid");
$app->router->post("/news/:controller/:action");

// $app->router->get("/news/{controller}/{action}/id/{articleid}");


$app->run();