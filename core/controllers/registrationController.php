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
            case "missing":
                $this->renderMissingInputPage();
                break;
            case "passwordnotmatching":
                $this->renderPasswordNotMatchingPage();
                break;
            default:
                $this->renderErrorPage();
                break;
        }

    }

    private function renderPasswordNotMatchingPage()
    {
        $this->getTemplate("/Pages/registrationPage");
        $page = new RegistrationPage();
        $page->parse(["cssinputclass"=>"inputError", "errormsg"=>"Passwords not matching!"]);
        $page->render();
    }

    private function renderRegistrationPage()
    {
        $this->getTemplate("/Pages/registrationPage");
        $page = new RegistrationPage();
        $page->parse();
        $page->render();
    }

    private function renderMissingInputPage()
    {
        $this->getTemplate("/Pages/registrationPage");
        $page = new RegistrationPage();
        $page->parse(["cssinputclass"=>"inputError", "errormsg"=>"Inputs missing!"]);
        $page->render();
    }

    public function registerAction()
    {
        /*
            return ErrorCode::MISSING_INPUT;
            return ErrorCode::PASSWORD_TOO_LONG;

        */
        if (
            !isset($_POST["gender"]) ||
            !isset($_POST["firstname"]) ||
            !isset($_POST["surname"]) ||
            !isset($_POST["username"]) ||
            !isset($_POST["password"]) ||
            !isset($_POST["email"]) ||
            !isset($_POST["password2"]))
            {
                header("Location: ../registration/missing/index");
                return false;
            }
    
            if ($_POST["password"] != $_POST["password2"])
            {
                header("Location: ../registration/passwordnotmatching/index");
                return false;
            }
    
            

        $registrationSuccessfull = $this->clientModel->registerNewUser(
            $_POST["firstname"],
            $_POST["surname"],
            $_POST["username"],
            $_POST["password"],
            $_POST["gender"],
            $_POST["email"]
        );

        if ($registrationSuccessfull)
        {
            $this->clientModel->loginUser($_POST["username"], $_POST["password"]);
            header("Location: ../profile/".$_SESSION["rolename"]."/index");

        }

    }
}

/*
    /login
    /login/
*/