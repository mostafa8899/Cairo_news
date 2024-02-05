<?php
 
 class Save
 {
     public $link_url;
     private $ArticleID;
     private $username;
 
     public function __construct($ArticleID = null,$username='',)
     {
         $this->ArticleID = $ArticleID;
         $this->username = $username;
     }
 
     public function setArticleID($ArticleID)
     {
         $this->ArticleID = $ArticleID;
     }
 
     public function getArticleID()
     {
         return $this->ArticleID;
     }

     public function getusername(){
          return $this->username;
      }
  
      public function setusername($username){
          $this->username=$username;
      }
 }

?>