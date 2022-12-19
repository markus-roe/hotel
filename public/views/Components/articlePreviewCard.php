<?php

require_once getcwd()."/core/component.php";
// ? notwendig?
class ArticlePreviewCard extends Component
{
    function __construct($previewConfig)
    {        
        parent::__construct();

        // article-preview, article-created, article-headline, article-author
        $newPreview = new Template("articlePreviewCard", 
        [
            "article-preview"=>$previewConfig["preview"],
            "article-created"=>$previewConfig["created"],
            "article-headline"=>$previewConfig["headline"],
            "article-author"=>$previewConfig["author"]
        ]);
        
        $this->templates = ["card"=>$newPreview];
    }

}