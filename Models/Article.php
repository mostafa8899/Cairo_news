<?php 

class articles
{
    private $ArticleID;

    public $num_comment;
    public $Content;
    public $category;
    public $image;


public function __constuct($ArticleID=null){
    $this->ArticleID=$ArticleID;
    
   
}
    function getArticleID() {
        return $this->ArticleID;
      }

      public function SetArticleID($articleID){
        $this->ArticleID=$articleID;
    }


}



