<?php

require_once  getcwd() . "/core/controller.php";
// require_once  getcwd() . "/core/config.php";
// require_once  getcwd() . "/core/config.php";
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

        $article = $this->articleModel->getArticleById($articleId)[0];

        if (isset($this->request["articleid"])) {
            $this->getTemplate("/Pages/articlePage");
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
        $this->getTemplate("/Pages/articlePageAdmin");
        $page = new ArticlePageAdmin();
        $page->parse($this->userData);
        $page->render();
    }

    private function renderPreviewPage()
    {
        $this->getTemplate("/Pages/articlePreviewPage");

        $page = new ArticlePreviewPage();
        $articleModel = new ArticleModel();
        $articles = $articleModel->getArticles();

        
        $page->addPreviews($articles);

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
