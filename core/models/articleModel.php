<?php 

require_once  getcwd()."/core/model.php";
require_once  getcwd()."/core/models/clientModel.php";


//! Pfad f. pictures zB: ./public/uploads/pictures/stockmarket.jpg

class ArticleModel extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getArticles()
    {
        $query = "SELECT content, updated, headline, authorId, picturePath, postId FROM posts p
        JOIN pictures pic ON p.pictureid = pic.pictureId;";

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

    public function uploadImage($imagePath)
    {

        $query = "INSERT INTO pictures (picturePath) VALUES (?)";

        $article = parent::executeQuery($query, "s", [$imagePath]);

        // * returns pictureID
        return $article;
        
    }

    // public function createArticle($authorId, $headline, $content)
    public function createArticle($authorId, $headline, $content, $subtitle, $pictureId)
    {
        $query = "INSERT INTO posts (authorId, headline, content, subtitle, pictureid) VALUES (?, ?, ?, ?, ?)";
    

        $article = parent::executeQuery($query, "dsssd", [$authorId, $headline, $content, $subtitle, $pictureId]);

    // * returns pictureID
        return $article;
    }

    public function getArticle()
    {
        
    }

}