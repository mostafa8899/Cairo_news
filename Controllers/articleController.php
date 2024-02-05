
<?php

require_once '../../Models/Article.php';
require_once '../../Controllers/DBController.php';


class articleController
{

    public $db;

    
   
    public function addarticle(articles $article)
    {
         $this->db=new DBController;
         if($this->db->openConnection())
         {
            


            $query="insert into `articles` (`Content`, `category`, `ArticleID`,`image`, `DateAdded`) VALUES ('$article->Content', '$article->category', NULL,'$article->image', NOW())";
            
            return $this->db->insert($query);
         }
         else
         {
            echo "Error in Database Connection";
            return false; 
         }
    }

    public function getCategory($category)
    {
         $this->db=new DBController;
         if($this->db->openConnection())
         {
            $query="SELECT * FROM `articles` WHERE category='$category'";
            return $this->db->select($query);
         }
         else
         {
            echo "Error in Database Connection";
            return false; 
         }
        }

    public function getArticle($articleID)
    {
         $this->db=new DBController;
         if($this->db->openConnection())
         {
            $query="SELECT * FROM `articles` WHERE ArticleID='$articleID'";
            return $this->db->select($query);
         }
         else
         {
            echo "Error in Database Connection";
            return false; 
         }
        }

    public function getArticleL()
    {
         $this->db=new DBController;
         if($this->db->openConnection())
         {
            $query="SELECT * FROM articles ORDER BY ArticleID DESC LIMIT 3;";
            return $this->db->select($query);
         }
         else
         {
            echo "Error in Database Connection";
            return false; 
         }
        }

        public function updateArticle(articles $article)
        {
            $this->db=new DBController;
            if($this->db->openConnection())

            {
               $articleID=$article->getArticleID();
                $query="UPDATE `articles` SET `Content`='$article->Content',`category`='$article->category',`image`='$article->image' where `ArticleID`='$articleID'";
                return $this->db->update($query);
                if($result!==false)
                {
                    
                    return true;
                }
                else
                {
                    $_SESSION["errMsg"]="Somthing went wrong... try again later";
                    
                    return false;
                }
            }
            else
            {
                echo "Error in Database Connection";
                return false;
            }
        }

        public function delteArticle($articleID)
        {
           $this->db = new DBController;
     
           if ($this->db->openConnection()) {
              $query = "DELETE FROM `articles` WHERE `ArticleID`='$articleID'";
              return $this->db->delete($query);
           } else {
              echo "Error in Database Connection";
              return false;
           }
          }


}



?>