<?php

require_once getcwd()."/public/views/Components/page.php";

class AdminProfilePage extends Page
{
    function __construct()
    {
        parent::__construct();
        
        $profileLinks = [
            [
                "profile-link-href" => "",
                "profile-link-text" => "Buchungen",
            ],
            [
                "profile-link-href" => "./profile/personaldata/index",
                "profile-link-text" => "Stammdaten",
            ],
            [
                "profile-link-href" => "./news/article/newpost/index",
                "profile-link-text" => "Neuer Artikel",
            ],
            [
                "profile-link-href" => "./login/logout",
                "profile-link-text" => "Logout",
            ],

        ];

        $profileLinksHtml = $this->createProfileLinks($profileLinks);
        $content = new Template("profileContentTemplate", ["profile-links" => $profileLinksHtml]);
        $this->changeContent($content);
        
    }

    protected function createProfileLinks($profileLinks)
    {
        $htmlString = "";
        $linkTemplate = Template::readFromFile(getcwd()."/public/templates/"."profileLinkTemplate");

        foreach($profileLinks as $link)
        {
            $htmlString .= Template::parseTemplate($linkTemplate, ["profile-link-href" => $link["profile-link-href"], "profile-link-text" => $link["profile-link-text"]]);
        }

        return $htmlString;
    }
}
//  /profile/menu/
//  /profile/stammdaten
//  /profile/buchungen