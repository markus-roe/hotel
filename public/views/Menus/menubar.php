<?php
require_once getcwd() . "/core/component.php";

//? wie MenuBar-Links konfigurieren f. untersch. User (Admin/User)
class MenuBar extends Component
{
    protected $linkTemplate;

    function __construct()
    {
        parent::__construct();


        $this->linkTemplate = Template::readFromFile("./public/templates/menuBarLink");
        $this->logoutLinkTemplate = Template::readFromFile("./public/templates/logoutLinkWrapper");
        $this->menuBarTemplate = new Template("menuBarTemplate", ["links", "current_uri"]);
        $this->templates = ["menuBar" => $this->menuBarTemplate];
    }

    //TODO active link aus request[current_uri]
    public function createLinks(array $config) :string
    {
        $htmlString = "";
        foreach ($config as $c) {
            $params =
                [
                    "href" => $c["href"],
                    "icon" => $c["icon"],
                    "linkTitle" => $c["title"],
                ];

                if ($c["title"] != "Logout")
                {
                    $htmlString .= Template::parseTemplate($this->linkTemplate, $params);
                    continue;
                }
                $htmlString .= Template::parseTemplate($this->logoutLinkTemplate, $params);
            }
        
        return $htmlString;
    }
}
