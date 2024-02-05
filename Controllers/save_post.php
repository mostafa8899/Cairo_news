<?php 

require_once '../../Models/Users.php';
require_once '../../Models/Article.php';
require_once '../../Models/Save.php';
require_once '../../Controllers/DBController.php';
require_once '../../Controllers/AuthController.php';
class save_post
{
    protected $db;

  
 
    public function AddSave(Save $save)
    {
        $this->db = new DBController;
        if ($this->db->openConnection()) {
            $link_url = $save->link_url;
             $username=$save->getusername();
            $articleID=$save->getArticleID();
            $query = "SELECT * FROM links WHERE link_url='$link_url' AND username='$username'";
            $result = $this->db->runQuery($query);
    
            // Check if link_url already exists in table
            if (mysqli_num_rows($result) == 0) {
                $query = "INSERT INTO `links`(`link_url`, `ArticleID`, `username`) VALUES ('$save->link_url','$articleID','$username');";
                return $this->db->insert($query);
            } else {
                // Link already exists
                return false;
            }
        } else {
            echo "Error in Database Connection";
            return false;
        
  }
}
    


   
        public function getAllSave($username)
        {
             $this->db=new DBController;
             if($this->db->openConnection())
             {
                $query="SELECT * FROM `links` where username='$username'";
                return $this->db->select($query);
             }
             else
             {
                echo "Error in Database Connection";
                return false; 
             }
            }


            public function getSavedPost(Save $save) {
                $this->db = new DBController;
                if ($this->db->openConnection()) {
                    $link_url = $save->link_url;
                    $username = $save->getusername();
                    $query = "SELECT * FROM links WHERE link_url='$link_url' AND username='$username'";
                    $result = $this->db->runQuery($query);
                    return mysqli_fetch_assoc($result);
                } else {
                    echo "Error in Database Connection";
                    return false;
                }
            }

            
    public function deleteSave(Save $save)
    {
       $this->db = new DBController;
       $articleID=$save->getArticleID();
       $username=$save->getusername();
       if ($this->db->openConnection()) {
        $query = "DELETE FROM `links` WHERE `ArticleID`='$articleID' And username='$username';";
          return $this->db->delete($query);
       } else {
          echo "Error in Database Connection";
          return false;
       }
      }


  
     
  


}