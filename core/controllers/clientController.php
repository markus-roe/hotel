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
        $clientType = $this->userData["userRole"];
        $this->clientPagePrefix = ucfirst($clientType);
    }

    public function indexAction()
    {
        $this->pageName = $this->clientPagePrefix.ucfirst($this->requestedView)."Page";
        $requestedMethod = "render".ucfirst($this->requestedView)."Page";
        if (method_exists($this, $requestedMethod))
        {
            switch($this->pageName)
            {
                case ("UserProfilePage"):
                    $this->getTemplate("/Pages/userProfilePage");
                    break;
                case ("UserBookingdetailsPage"):
                    $this->getTemplate("/Pages/userBookingdetailsPage");
                    break;
                case ("UserProfilePage"):
                    $this->getTemplate("/Pages/userProfilePage");
                    break;  
                case ("AdminProfilePage"):
                    $this->getTemplate("/Pages/adminProfilePage");
                    break;
                case ("AdminProfilePage"):
                    $this->getTemplate("/Pages/adminProfilePage");
                    break;
                case ("AdminGuestsPage"):
                    $this->getTemplate("/Pages/adminGuestsPage");
                    break;
                case ("AdminUserprofilePage"):
                    $this->getTemplate("/Pages/adminUserprofilePage");
                    break;
                case ("AdminBookingdetailsPage"):
                    $this->getTemplate("/Pages/adminBookingdetailsPage");
                    break;
                default:
                    $this->getTemplate("/Pages/$this->pageName");       
                   
            }
            
            $this->$requestedMethod();
        }
    }

    public function updateprofileAction($userId=null)
    {
        // $client = new ClientModel();
        $user = new User();
        
        $userId = $userId ?? $user->userId;
        $post_firstname = $_POST['firstname'] ? $_POST['firstname'] : "";
        $post_surname = $_POST['surname'] ? $_POST['surname'] : "";
        $post_email = $_POST['email'] ? $_POST['email'] : "";
        $post_phone = $_POST['phone'] ? $_POST['phone'] : "";
        $post_password = $_POST['new-password'] ? $_POST['new-password'] : "";
        $post_confirmpassword = $_POST['confirm-new-password'] ? $_POST['confirm-new-password'] : "";

        if ($post_confirmpassword != $post_password)
        {
            header("Location: ../client/profile?res=passworderr");

            return 0;
        }

        $this->clientModel->updateUserData($post_firstname, $post_surname, $post_email, $post_phone, $post_password, $post_confirmpassword, $userId);
        
        header("Location: ../client/profile?res=updatesuccess");
    }

    public function renderProfilePage()
    {
        $this->profilePage = new $this->pageName();
        switch ($this->request["res"])
        {
            case "updatesuccess":
                $this->profilePage->triggerPopup("<span style='font-size:1.5rem'>🥳</span> Update erfolgreich!");
                break;
            case "passworderr":
                $this->profilePage->triggerPopup("<span style='font-size:1.5rem'>😔</span> Passwörter stimmen nicht überein!");
                break;
        }

        $this->profilePage->parse([...$this->userData, $this->request["current_uri"]]);
        $this->profilePage->render();
    }
}
