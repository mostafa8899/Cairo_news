<?php 

require_once '../../Models/Comment.php';
require_once '../../Controllers/DBController.php';
require_once '../../Controllers/AuthController.php';
class commentController
{
    protected $db;
    public function sendComment(Comment $comment)
    {
      $articleID=$comment->getArticleID();
      $username=$comment->getUsername();
         $this->db=new DBController;
         if($this->db->openConnection())
         {  

            $query = "INSERT INTO `comment`(`CID`, `content`, `ArticleID`, `username`, `DateAdded`) 
          VALUES ('', '$comment->Content', '$articleID', '$username', NOW())";
            return $this->db->insert($query);
         }
         else
         {
            echo "Error in Database Connection";
            return false; 
         }
    }

    public function getAllComments($ArticleID)
    {
         $this->db=new DBController;
         if($this->db->openConnection())
         {
            $query="SELECT * FROM `comment` where ArticleID='$ArticleID'";
            return $this->db->select($query);
         }
         else
         {
            echo "Error in Database Connection";
            return false; 
         }
        }
        public function deleteComment($commentId)
        {
           $this->db = new DBController;
     
           if ($this->db->openConnection()) {
              $query = "DELETE FROM `comment` WHERE `CID`='$commentId'";
              return $this->db->delete($query);
           } else {
              echo "Error in Database Connection";
              return false;
           }
          }
    
}