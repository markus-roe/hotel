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
        return "all Articles in Array";
    }

    public function getArticleById($articleId)
    {
        $query = "SELECT * FROM posts p
        JOIN pictures pic ON p.pictureid = pic.pictureId
        WHERE p.postId = ?;";

        $article = $this->executeQuery($query, "d", [1]);
        
        return $article;
    }

    public function uploadImage($image)
    {

        // move_uploaded_file($image, $destinationPath);
        
        // * returns pictureID
        return 1;
    }

    // public function createArticle($authorId, $headline, $content)
    public function createArticle($authorId, $headline, $content, $subtitle, $pictureId)
    {
        $query = "INSERT INTO posts (authorId, headline, content, subtitle, pictureid) VALUES (?, ?, ?, ?, ?)";
        
        $authorId = 2;
        $headline = "title";
        $content = "content";
        $subtitle = "sub";
        $pictureId = 1;

        $article = $this->executeQuery($query, "dsssd", [$authorId, $headline, $content, $subtitle, $pictureId]);

        // var_dump($article);
        return $article;
    }

    public function getArticle()
    {
        
    }

    public function executeQuery($query, $paramString, $paramsArray)
    {
        try
        {

            $params = array();
  
            // * push params to bind in array
            foreach ($paramsArray as $key => $value)
            {
                array_push($params, $value);
            }
            
            // * execute sql with parent model connection
            $stmt = self::$connection->prepare($query);
            $stmt->bind_param($paramString, ...$params);
            $stmt->execute();
            $result = $stmt->get_result();
            if(str_contains($query, "SELECT"))
            {
                $row = $result->fetch_array(MYSQLI_ASSOC);
                return $row;
            }
            return $result;

        } 
        catch (\Throwable $th) {
            throw $th;
        }
    }

}