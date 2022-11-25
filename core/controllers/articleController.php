<?php

require_once  getcwd() . "/core/controller.php";
// require_once  getcwd() . "/core/config.php";
require_once  getcwd() . "/core/config.php";
require_once  getcwd()."/core/user.php";
require_once  getcwd()."/core/models/articleModel.php";
require_once  getcwd()."/core/models/clientModel.php";

function mock()
{
    // $config = new Config();
    $mysqli = new mysqli("localhost", "root", "", "ipsum");

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
        if (isset($this->request["articleid"])) {
            $this->getView("/Pages/articlePage");
            $page = new ArticlePage();
            $page->parse([
                "headline" => $row["headline"],
                "content" => $row["content"],
                "subtitle" => $row["subtitle"],
                "picturepath" => $row["picturePath"],
            ]);
            $page->render();
        }
    }

    private function renderNewPostPage()
    {
        $this->getView("/Pages/articlePageAdmin");
        $page = new ArticlePageAdmin();
        $page->parse();
        $page->render();
    }

    private function renderPreviewPage()
    {
        $row = mock();
        $this->getView("/Pages/articlePreviewPage");

        $page = new ArticlePreviewPage();
        $article = new ArticleModel;
        $articles = $article->getArticles();

        $mockArticles = [
            ["article-link" => $row["postId"], "headline" => $row["headline"], "preview" => "Lorem Ipsum dolor blablabla", "author" => $row["firstname"] . " " . $row["surname"], "updated" => $row["updated"]],
            ["headline" => "Familien SM-Workshop", "preview" => "Lorem Ipsum dolor blablabla", "author" => "Markus Rösner"],
            ["headline" => "Familien SM-Workshop", "preview" => "Lorem Ipsum dolor blablabla", "author" => "Markus Rösner"],
        ];
        
        $page->addPreviews($articles);

        $page->parse($this->userData);
        $page->render();
    }

    public function newAction()
    {

        $this->getView("/Pages/articlePageAdmin");
        $page = new ArticlePageAdmin();
        $page->parse($this->userData);
        $page->render();
    }

    public function uploadAction()
    {

    $user = new User();

    $article = new ArticleModel();

    // * prepare image for upload
    $ImageName = str_replace(' ','-',strtolower($_FILES['articleImage']['name']));
    $ImageExt = substr($ImageName, strrpos($ImageName, '.'));
    $ImageExt = str_replace('.','',$ImageExt);
    $ImageName = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
    $NewImageName = $ImageName.'.'.$ImageExt;

    $destinationPath = getcwd() . "/public/uploads/pictures/" . $_FILES["articleImage"]["name"];

    $picturePath = "/uploads/pictures/" . $_FILES["articleImage"]["name"];

    move_uploaded_file($_FILES["articleImage"]["tmp_name"], $destinationPath);


    // * upload Image path to database
    $post_pictureId = $article->uploadImage($picturePath);

    $authorId = $user->userId;
    $post_headline = $_POST['articleTitle'] ? $_POST['articleTitle'] : "";
    $post_content = $_POST['articleContent'] ? $_POST['articleContent'] : "";
    $post_subtitle = $_POST['subtitle'] ? $_POST['subtitle'] : "";
    $post_pictureId = $post_pictureId;

    $newArticleId = $article->createArticle($authorId, $post_headline, $post_content, $post_subtitle, $post_pictureId);

    header("Location: post/id/" . $newArticleId . "/index");

    }
}
