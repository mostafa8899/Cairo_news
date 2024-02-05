<?php 

require_once '../../Models/Comment.php';
require_once '../../Controllers/DBController.php';
require_once '../../Controllers/AuthController.php';
class LikeController
{
    public $db;
    
    
    public function AddLike($UserName, $ArticleID)
    {
        $this->db = new DBController;
        if ($this->db->openConnection()) {
            $query = "SELECT * FROM user_article WHERE username='$UserName' AND `ArticleID`='$ArticleID'";
            $result = $this->db->runQuery($query);
    
            
            if (mysqli_num_rows($result) == 0) {
                $query = "INSERT INTO `user_article`(`ArticleID`, `username`, `likeID`) VALUES ('$ArticleID', '$UserName', '')";
                return $this->db->insert($query);
            } else {
                // Like already exists for this user and article
                return false;
            }
        } else {
            echo "Error in Database Connection";
            return false;
        }
    }
    public function deleteLike($ArticleID,$UserName)
        {
           $this->db = new DBController;
     
           if ($this->db->openConnection()) {
              $query = "DELETE FROM `user_article` WHERE `ArticleID`='$ArticleID' And username='$UserName'";
              return $this->db->delete($query);
           } else {
              echo "Error in Database Connection";
              return false;
           }
          }

          public function getLike($ArticleID)
          {
               $this->db=new DBController;
               if($this->db->openConnection())
               {
                  $query="SELECT COUNT(*) as likes FROM user_article where ArticleID='$ArticleID'";
                  return $this->db->select($query);
               }
               else
               {
                  echo "Error in Database Connection";
                  return false; 
               }
              }
}