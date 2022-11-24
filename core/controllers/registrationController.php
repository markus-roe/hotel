<?php

require_once  getcwd()."/core/controller.php";

class RegistrationController extends Controller
{


    public function indexAction()
    {
        switch ($this->requestedView)
        {
            case "newuser":
                $this->renderRegistrationPage();
                break;
            default:
                $this->renderErrorPage();
                break;
        }

    }

    private function renderRegistrationPage()
    {
        $this->getView("/Pages/registrationPage");
        $page = new RegistrationPage();
        $page->parse();
        $page->render();
    }

    public function register()
    {
        $result = $this->clientMode->registerNewUser();

        // if ($result == ErrorCode::)

    }
}

/*
    /login
    /login/
*/