<?php

require_once  getcwd() . "/core/controller.php";
// require_once  getcwd() . "/core/config.php";
// require_once  getcwd() . "/core/config.php";
require_once  getcwd()."/core/user.php";
require_once  getcwd()."/core/models/articleModel.php";

function mock()
{
    // $config = new Config();
    $mysqli = new mysqli("localhost", "root", "Wlenfeni1428780", "ipsum");

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
        $this->articleModel = new ArticleModel();
    }

    public function indexAction()
    {
        switch ($this->requestedView)
        {
            case "preview":
                $this->renderPreviewPage();
                break;
            case "post":
                $this->renderArticlePage($this->request["articleid"]);
                break;
            case "newpost":
                $this->renderNewPostPage();
                break;
            default:
                $this->renderErrorPage(["content-title" => "markus duftet"]);
                break;
        }
    }
    // FIXME
    private function renderArticlePage($articleId)
    {

        $article = $this->articleModel->getArticleById($articleId);

        if (isset($this->request["articleid"])) {
            $this->getView("/Pages/articlePage");
            $page = new ArticlePage();
            // $articleData = [
            //     "headline" => $article["headline"],
            //     "content" => $article["content"],
            //     "subtitle" => $article["subtitle"],
            //     "picturepath" => $article["picturePath"],
            // ]
            $data = array_merge($article, $this->userData);
            $page->parse($data);
            $page->render();
        }
    }

    private function renderNewPostPage()
    {
        $this->getView("/Pages/articlePageAdmin");
        $page = new ArticlePageAdmin();
        $page->parse($this->userData);
        $page->render();
    }

    private function renderPreviewPage()
    {
        $row = mock();
        $this->getView("/Pages/articlePreviewPage");

        $page = new ArticlePreviewPage();
        $mockArticles = [
            ["article-id" => $row["postId"], "headline" => $row["headline"], "preview" => "Lorem Ipsum dolor blablabla", "author" => $row["firstname"] . " " . $row["surname"], "updated" => $row["updated"]],

        ];
        $page->addPreviews($mockArticles);
        $page->parse($this->userData);
        $page->render();
    }


    public function createAction()
    {
    }
}
