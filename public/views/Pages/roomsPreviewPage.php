<?php
require_once getcwd()."/public/views/Components/page.php";

class RoomsPreviewPage extends Page
{
    function __construct($roomConfig)
    {
        parent::__construct();

        if ($roomConfig != null)
        {
            $roomCards = $this->createCards($roomConfig);
            $this->changeContent($roomCards);
        }
    }

    private function createCards($cardsConfig)
    {
        
        /**
         * erstellte previewCard-Components werden in slots der row-Templates insertiert
         * 'befüllte' row-templates werden im template-Array von CardCollection (Component)
         * gespeichert und als neuer Content in Page eingesetzt
         */

        $index = 0;
        $nbrOfCards = count($cardsConfig);
        $card1 = null;
        $card2 = null;
        $row = null;

        $cardCollection = new Component();
        $newContent = new Content();

        while ($index < $nbrOfCards) {
            $tempCardView_2 = "";
            $card1 = new Template("roomPreviewCardTemplate");
            $card1->parse($cardsConfig[$index]);
            $tempCardView_1 = $card1->template;

            if ($nbrOfCards - $index  >= 2) {
                $card2 = new Template("roomPreviewCardTemplate");
                $card2->parse($cardsConfig[$index + 1]);
                $tempCardView_2 = $card2->template;
                $index++;
            }

            $row = new Template("articleRow", ["prev-card-1", "prev-card-2"]);
            $row->parse(["prev-card-1" => $tempCardView_1, "prev-card-2" => $tempCardView_2]);
            array_push($cardCollection->templates, $row);
            $index++;
        }
        
        return $cardCollection;
    }
}