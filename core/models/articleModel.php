<?php 

require_once  getcwd()."/core/model.php";
require_once  getcwd()."/core/models/clientModel.php";
require_once  getcwd()."/parsedown/Parsedown.php";


//! Pfad f. pictures zB: ./public/uploads/pictures/stockmarket.jpg

class ArticleModel extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getArticles()
    {
        $query = "SELECT content, created, headline, authorId, thumbnailPath, postId FROM posts p
        JOIN pictures pic ON p.pictureid = pic.pictureId
        ORDER BY created DESC;";

        $articles = parent::executeQuery($query);

        console_log($articles);
        
        return $articles;
    }

    public function getArticleById($articleId)
    {
        $query = "SELECT * FROM posts p
        JOIN pictures pic ON p.pictureid = pic.pictureId
        WHERE p.postId = ?;";

        $article = $this->executeQuery($query, "d", [$articleId]);
        
        return $article;
    }

    public function uploadImage($imagePath, $thumbnailPath)
    {

        $query = "INSERT INTO pictures (picturePath, thumbnailPath) VALUES (?, ?)";

        $article = parent::executeQuery($query, "ss", [$imagePath, $thumbnailPath]);

        // * returns pictureID
        return $article;
        
    }

    // public function createArticle($authorId, $headline, $content)
    public function createArticle($authorId, $headline, $content, $subtitle, $pictureId)
    {
        $Parsedown = new Parsedown();
        $Parsedown->setSafeMode(true);
        $contentMarkdown = $Parsedown->text($content);

        $query = "INSERT INTO posts (authorId, headline, content, subtitle, pictureid) VALUES (?, ?, ?, ?, ?)";
    

        $article = parent::executeQuery($query, "dsssd", [$authorId, $headline, $contentMarkdown, $subtitle, $pictureId]);

    // * returns pictureID
        return $article;
    }

}