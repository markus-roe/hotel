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
        switch ($this->requestedView) {
            case "attempt":
                $this->renderLoginPage();
                break;
            case "attemptfailed":
                $this->renderLoginFailurePage();
                break;
            default:
                $this->renderErrorPage();
                break;
        }
    }

    public function logoutAction()
    {
        $this->clientModel->logoutUser();
        header("Location: ../home/index");
    }

    private function renderLoginFailurePage()
    {
        $this->getTemplate("/Pages/loginPage");
        $loginPage = new LoginPage();
        $errorData = ["inputerror" => "inputError", "inputerrormsg" => "Benutzername oder Passwort falsch!"];
        $data = array_merge($errorData, $this->userData);
        $loginPage->parse($data);
        $loginPage->render();
    }

    private function renderLoginPage()
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
        header("Location: ../profile/" . $_SESSION["rolename"] . "/index");

        return 1;
    }
}

/*
    /login
    /login/
*/