<?php

require_once  getcwd() . "/core/controller.php";
require_once  getcwd() . "/core/config.php";

function mock()
{
    $config = new Config();
    $mysqli = new mysqli($config->host, $config->user, $config->password, $config->database);

    $query =
    "select * from posts po
    join pictures pi on po.pictureid=pi.pictureid
    join users u on u.userid=po.authorid
    where po.postid=1;";
    

    $res = $mysqli->query($query);
    $row = $res->fetch_array(MYSQLI_ASSOC);

    return $row;
}

class ArticleController extends Controller
{
    public function init()
    {
    }

    public function indexAction()
    {

        $row = mock();

        if (isset($this->request["articleid"])) {
            $this->getView("/Pages/articlePage");
            $page = new ArticlePage();
            $page->parse([
                "headline"=>$row["headline"],
                "content"=>$row["content"],
                "subtitle"=>$row["subtitle"],
                "picturepath"=>$row["picturePath"],
            ]);
            $page->render();
        }
    }

    public function overviewAction()
    {
        $row = mock();
        $this->getView("/Pages/ArticlePreviewPage");

        $page = new ArticlePreviewPage();
        $mockArticles = [
            ["article-link"=>$row["postId"], "headline" => $row["headline"], "preview" => "Lorem Ipsum dolor blablabla", "author" => $row["firstname"]." ".$row["surname"], "updated"=>$row["updated"]],
            ["headline" => "Familien SM-Workshop", "preview" => "Lorem Ipsum dolor blablabla", "author" => "Markus Rösner"],
            ["headline" => "Familien SM-Workshop", "preview" => "Lorem Ipsum dolor blablabla", "author" => "Markus Rösner"],

        ];
        $page->addPreviews($mockArticles);
        $page->parse($this->userData);
        $page->render();
    }

    public function new()
    {

        $this->getView("/Pages/articlePageAdmin");
        $page = new ArticlePageAdmin();
        $page->parse($this->userData);
        $page->render();
    }

    public function postarticle()
    {
    }
}
