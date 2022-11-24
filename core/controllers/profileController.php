<?php

require_once  getcwd()."/core/controller.php";

class HomeController extends Controller
{
    public function init()
    {
        parent::init();

    }



    public function indexAction()
    {
        switch ($this->requestedView)
        {
            case "admin":
                $this->renderAdminProfilePage();
                break;
            case "user":
                $this->renderUserProfilePage();
                break;
            default:
                $this->renderErrorPage();
                break;
        }
    }

    private function renderAdminProfilePage()
    {
        $this->getView("/Pages/adminProfilePage");
        $page = new AdminProfilePage();
        $page->parse($this->userData);
        $page->render();
    }

    private function renderUserProfilePage()
    {
        $this->getView("/Pages/userProfilePage");
        $page = new UserProfilePage();
        $page->parse($this->userData);
        $page->render();
    }
}

/*
    /login
    /login/
*/