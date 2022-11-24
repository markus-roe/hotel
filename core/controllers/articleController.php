<?php

require_once  getcwd() . "/core/controller.php";
require_once  getcwd() . "/core/config.php";
require_once  getcwd()."/core/user.php";
require_once  getcwd()."/core/models/articleModel.php";

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
        $this->getView("/Pages/articlePreviewPage");

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

    public function newAction()
    {

        $this->getView("/Pages/articlePageAdmin");
        $page = new ArticlePageAdmin();
        $page->parse($this->userData);
        $page->render();
    }

    public function createAction()
    {

        $this->getView("/Pages/articlePageAdmin");
        $page = new Page();
        $page->parse($this->userData);
        $page->render();

        $article = new ArticleModel();

    

        // * --------
        //* new mock user
        $userObj = ["userId" => 999];
        $user->setUserData($userObj);
        // * set UserId
        
        // * upload Image
        $image = "image";
        $uploadedPictureId = $article->uploadImage($image);
    
        $authorId = $user->userId;
        $post_headline = "head";
        $post_content = "content";
        $post_subtitle = "sub";
        $post_pictureId = $uploadedPictureId;
        // * -----------


        // $art->createArticle($authorId, $headline, $content, $subtitle, $pictureId));

        
        // * redirect to article
    }
}
