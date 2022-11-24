<?php

require_once getcwd()."/public/views/Components/page.php";

class ArticlePreviewPage extends Page
{
    function __construct()
    {
        parent::__construct();

        // $this->previewTemplate = View::readFromFile(getcwd()."/public/templates/articlePreviewCard");
        // array der geparsten Preview-Cards (type == Views)
        $this->requireView("/Components/content");
        $this->previewCards = [];
    }


    public function addPreviews($cardsConfig)
    {
        $index = 0;
        $nbrOfCards = count($cardsConfig);
        $card1 = null;
        $card2 = null;
        $row = null;

        $cardCollection = new Component();
        $newContent = new Content();
        // BUG cards überschreiben sich?
        while ($index < $nbrOfCards)
        {
            $tempCardView_2 = "";
            $card1 = new View("articlePreviewCard", $cardsConfig[$index]);
            $card1->parse();
            $tempCardView_1 = $card1->view;

            if ($nbrOfCards - $index  >= 2)
            {
                $card2 = new View("articlePreviewCard", $cardsConfig[$index + 1]);
                $card2->parse();
                $tempCardView_2 = $card2->view;
                $index++;
            }
            $row = new View("articleRow", ["prev-card-1", "prev-card-2"]);
            $row->parse(["prev-card-1"=>$tempCardView_1, "prev-card-2"=>$tempCardView_2]);
            array_push($cardCollection->views, $row);
            $index++;
            
        }

        // $newContent->insert("contentBody", $cardCollection);
        // $this->insert("content", $newContent);

        $this->changeContent($cardCollection);
    }

}