<?php

require_once  getcwd()."/core/controller.php";

class ProfileController extends Controller
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
        $this->getTemplate("/Pages/adminProfilePage");
        $page = new AdminProfilePage();
        $page->parse($this->userData);
        $page->render();
    }

    private function renderUserProfilePage()
    {
        $this->getTemplate("/Pages/userProfilePage");
        $page = new UserProfilePage();
        $page->parse($this->userData);
        $page->render();
    }
}

/*
    /login
    /login/
*/