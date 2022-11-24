<?php

require_once  getcwd()."/core/controller.php";

class RegistrationController extends Controller
{


    public function indexAction()
    {
        switch ($this->request["view"])
        {
            case "alreadyexists":
                break;
            case "pwdsnotmatching":
        }
        $this->getView("/Pages/registrationPage");
        $page = new RegistrationPage();
        $page->parse();
        $page->render();
    }

    public function register()
    {
        $result = $this->clientMode->registerNewUser();

        if ($result == ErrorCode::)

    }
}

/*
    /login
    /login/
*/