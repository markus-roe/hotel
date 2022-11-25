<?php

require_once getcwd()."/public/views/Components/page.php";

class ProfilePage extends Page
{
    function __construct()
    {
        parent::__construct();
        
        $profileLinks = [];
        $profileLinksHtml = $this->createProfileLinks($profileLinks);
        $content = new Template("profileContentTemplate", ["profile-links"]);
        
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