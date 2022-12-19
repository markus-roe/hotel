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
                $this->renderPostPage($this->request["articleid"]);
                break;
            case "newpost":
                $this->renderNewpostPage();
                break;
            default:
                $this->renderErrorPage(["content-title" => "markus duftet"]);
                break;
        }
    }
    
    private function renderPostPage($articleId)
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

    private function renderNewpostPage()
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
    $thumbnailPath = getcwd() . "/public/uploads/pictures/thumbnails/" . $_FILES["articleImage"]["name"];

    $picturePath = "/uploads/pictures/" . $_FILES["articleImage"]["name"];

    move_uploaded_file($_FILES["articleImage"]["tmp_name"], $destinationPath);

    if (is_file($destinationPath)) 
    {
        // get width and height of source image
        list ($width, $height) = getimagesize($destinationPath);
        $ratio = $width / $height;

        $max = 500;
        if($width > $max || $height > $max)
        {
            if($width > $height)
            {
                $newWidth = round($max);
                $newHeight = round($max / $ratio);
            }
            else 
            {
                $newHeight = round($max);
                $newWidth = round($max * $ratio);
            }
        }
        else 
        {
            $newWidth = round($width);
            $newHeight = round($height);
        }

        $thumbnail = imagecreatetruecolor($newWidth, $newHeight);
        $source = imagecreatefromjpeg($destinationPath);

        // copy thumbnail with new size
        imagecopyresized($thumbnail, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

        // save new resized thumbnail to "/thumbnails" folder
        imagejpeg($thumbnail, $thumbnailPath);

    }

    // * upload Image path to database
    $post_pictureId = $article->uploadImage($picturePath, $thumbnailPath);

    $authorId = $user->userId;
    $post_headline = $_POST['articleTitle'] ? $_POST['articleTitle'] : "";
    $post_content = $_POST['articleContent'] ? $_POST['articleContent'] : "";
    $post_subtitle = $_POST['subtitle'] ? $_POST['subtitle'] : "";
    $post_pictureId = $post_pictureId;

    $newArticleId = $article->createArticle($authorId, $post_headline, $post_content, $post_subtitle, $post_pictureId);

    header("Location: post/id/" . $newArticleId . "");

    }
}
