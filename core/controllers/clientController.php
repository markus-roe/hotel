<?php

require_once  getcwd() . "/core/controller.php";
require_once  getcwd() . "/core/user.php";
require_once  getcwd() . "/core/models/clientModel.php";

//! nicht direkt verwenden. Vererbt an UserController u. AdminController
class ClientController extends Controller
{
    protected $profilePage;
    protected $bookingPage;

    public function init()
    {
        parent::init();
    }

    public function indexAction()
    {
        $requestedMethod = "render".ucfirst($this->requestedView)."Page";
        if (method_exists($this, $requestedMethod))
        {
            $this->$requestedMethod();
        }
    }

    public function updateprofileAction()
    {

        $user = new User();
        $client = new ClientModel();

        $userId = $user->userId;
        $post_firstname = $_POST['firstname'] ? $_POST['firstname'] : "";
        $post_surname = $_POST['surname'] ? $_POST['surname'] : "";
        $post_email = $_POST['email'] ? $_POST['email'] : "";

        $client->changeUserData($post_firstname, $post_surname, $post_email, $userId);
    
        header("Location: ../".$_SESSION["rolename"]."/profile/index");
    }

    protected function renderProfilePage()
    {
        $this->profilePage->parse([...$this->userData, $this->request["current_uri"]]);
        $this->profilePage->render();
    }
}
