<?php

require_once  getcwd() . "/core/controller.php";
// require_once  getcwd() . "/core/config.php";
// require_once  getcwd() . "/core/config.php";
require_once  getcwd()."/core/user.php";
require_once  getcwd()."/core/models/articleModel.php";
require_once  getcwd()."/core/models/clientModel.php";

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
    
    private function renderArticlePage($articleId)
    {

        $article = $this->articleModel->getArticleById($articleId);
        if (!isset($this->request["articleid"]) || !$article) {
            $this->renderErrorPage(["content-title"=>"Sorry...", "content-body" => "Dieser Artikel existiert leider nicht!"]);

            return false;
        }
            
            $article = $article[0];
            $this->getTemplate("/Pages/articlePage");
            $page = new ArticlePage();
            $data = array_merge($article, $this->userData);
            $page->parse($data);
            $page->render();

            return true;

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

        $articleModel = new ArticleModel();
        $articles = $articleModel->getArticles();
        
        $page = new ArticlePreviewPage($articles);
        $page->parse($this->userData);
        $page->render();
    }


    public function postAction()
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

    header("Location: post/id/" . $newArticleId . "");

    }
}
