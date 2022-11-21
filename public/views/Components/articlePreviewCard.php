<?php

require_once getcwd()."/core/component.php";
// ? notwendig?
class ArticlePreviewCard extends Component
{
    function __construct($previewConfig)
    {        
        parent::__construct();

        // article-preview, article-updated, article-headline, article-author
        $newPreview = new View("articlePreviewCard", 
        [
            "article-preview"=>$previewConfig["preview"],
            "article-updated"=>$previewConfig["updated"],
            "article-headline"=>$previewConfig["headline"],
            "article-author"=>$previewConfig["author"]
        ]);
        
        $this->views = ["card"=>$newPreview];
    }

}