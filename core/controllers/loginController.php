<?php

require_once  getcwd() . "/core/controller.php";

class LoginController extends Controller
{
    public function init()
    {
        parent::init();
    }

    public function indexAction()
    {
        parent::indexAction();
    }

    public function logoutAction()
    {
        $this->clientModel->logoutUser();
        header("Location: ../".$this->userData["profilepath"]);
    }

    protected function renderLoginFailurePage()
    {
        $this->getTemplate("/Pages/loginPage");
        $loginPage = new LoginPage();
        $errorData = ["inputerror" => "inputError", "inputerrormsg" => "Benutzername oder Passwort falsch!"];
        $data = array_merge($errorData, $this->userData);
        $loginPage->parse($data);
        $loginPage->render();
    }

    protected function renderAttemptPage()
    {
        $this->getTemplate("/Pages/loginPage");
        $loginPage = new LoginPage();
        $loginPage->parse($this->userData);
        $loginPage->render();
    }

    public function loginrequestAction()
    {

        if (
            !isset($_POST["password"]) || !isset($_POST["username"]) ||
            !$this->clientModel->loginUser($_POST["username"], $_POST["password"])
        ) {
            header("Location: ../login/attemptfailed/index");

            return false;
        }

        // PATCH
        header("Location: ../".$_SESSION["rolename"]."/profile/index");

        return 1;
    }
}

/*
    /login
    /login/
*/