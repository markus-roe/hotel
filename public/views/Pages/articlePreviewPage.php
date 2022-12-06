<?php

require_once getcwd() . "/public/views/Components/page.php";

class ArticlePreviewPage extends Page
{
    function __construct($cardsConfig)
    {
        parent::__construct();

        $this->cardsConfig = $cardsConfig;
        // $this->previewTemplate = Template::readFromFile(getcwd()."/public/templates/articlePreviewCard");
        // array der geparsten Preview-Cards (type == Views)
        $this->requireTemplate("/Components/content");

        $previewCards = $this->getPreviewCards($cardsConfig);
        $this->changeContent($previewCards);
    }


    private function getPreviewCards(array $cardsConfig)
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
            $card1 = new Template("articlePreviewCard", $cardsConfig[$index]);
            $card1->parse();
            $tempCardView_1 = $card1->template;

            if ($nbrOfCards - $index  >= 2) {
                $card2 = new Template("articlePreviewCard", $cardsConfig[$index + 1]);
                $card2->parse();
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
