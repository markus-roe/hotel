<?php

require_once  getcwd()."/core/controller.php";
require_once  getcwd()."/core/models/bookingModel.php";

class MainController extends Controller
{
    public function init()
    {
        parent::init();

        $booking = new BookingModel();
        // var_dump($booking->getBookingById(1));
        var_dump($booking->getBookingByUserId(11));

    }



    public function indexAction()
    {
        parent::indexAction();

    }

    protected function renderFaqPage()
    {
        $this->getTemplate("/Pages/faqPage");
        $page = new FaqPage();
        $page->parse($this->userData);
        $page->render();
    }

    protected function renderImprintPage()
    {
        $this->getTemplate("/Pages/imprintPage");
        $page = new ImprintPage();
        $page->parse($this->userData);
        $page->render();
    }

    protected function renderHomePage()
    {
        $this->getTemplate("/Pages/homePage");
        $homePage = new HomePage();
        $homePage->parse($this->userData);
        $homePage->render();
    }
}

/*
    /login
    /login/
*/