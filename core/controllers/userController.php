<?php

require_once  getcwd()."/core/controller.php";
require_once  getcwd()."/core/user.php";
require_once  getcwd()."/core/models/clientModel.php";

//TODO

class UserController extends Controller
{
    public function init()
    {
        parent::init();

    }



    public function indexAction()
    {
       parent::indexAction();
    }

    private function renderAdminProfilePage()
    {
        $this->getTemplate("/Pages/adminProfilePage");
        $page = new AdminProfilePage();
        $page->parse($this->userData);
        $page->render();
    }

    public function renderProfilePage()
    {
        $this->getTemplate("/Pages/userPage");
        $page = new UserPage();
        $page->parse($this->userData);
        $page->render();
    }

    // private function renderProfilePage()
    // {
    //     $this->getTemplate("/Pages/profilePage");
    //     $page = new ProfilePage();
    //     $page->parse($this->userData);
    //     $page->render();
    // }

    public function updateAction()
    {

        $user = new User();
        $client = new ClientModel();
        echo $userId;


        $userId = $user->userId;
        $post_firstname = $_POST['firstname'] ? $_POST['firstname'] : "";
        $post_surname = $_POST['surname'] ? $_POST['surname'] : "";
        $post_email = $_POST['email'] ? $_POST['email'] : "";



        $client->updateUserData($post_firstname, $post_surname, $post_email, $userId);


    
        header("Location: /hotel/profile/personaldata");
    }

}

/*
    /login
    /login/
*/