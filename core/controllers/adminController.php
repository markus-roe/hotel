<?php

require_once  getcwd()."/core/controllers/clientController.php";
require_once  getcwd()."/core/user.php";
require_once  getcwd()."/core/models/clientModel.php";

class AdminController extends ClientController
{
    public function init()
    {
        parent::init();

        $this->getTemplate("/Pages/adminProfilePage");
        $this->profilePage = new AdminProfilePage();
    }



    public function indexAction()
    {
        parent::indexAction();
    }





}

/*
    /login
    /login/
*/