<?php
 
class Comment
{
     public $Content;
     private $CID;
     public $DateAdded;
     private $ArticleID;
     private $username;

     function __construct($username='',$CID='',$ArticleID='') {
       
        $this->$CID =$CID;
        $this->$username =$username;
        
        $this->$ArticleID =$ArticleID;
    }
     

    public function getCID()
    {
        return $this->CID;
    }

    public function setCID($CID)
    {
        $this->CID = $CID;
    }

    public function getArticleID()
    {
        return $this->ArticleID;
    }

    public function setArticleID($ArticleID)
    {
        $this->ArticleID = $ArticleID;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }
}

?>