<?php

require_once getcwd()."/core/controller.php";
require_once getcwd()."/model/clientModel.php";

session_status() === PHP_SESSION_ACTIVE ? TRUE : session_start();

class ClientController extends Controller
{
    public function init()
    {
        // $client = new ClientModel();
        // echo $client->getUsername(1);

        $this->getView("Pages/loginPage");
        $homePage = new LoginPage();
        $homePage->parse();
        $homePage->render();
    }

    public function Authenticate()
    {

    }

    
   
}