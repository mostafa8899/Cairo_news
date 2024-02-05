
<?php

require_once '../../Models/Story.php';
require_once '../../Controllers/DBController.php';


class storyController
{

    public $db;

  
   
    public function addStory(story $Story)
    {
      $this->db = new DBController;
    
      if ($this->db->openConnection()) {
        
        $now = time();
        $Twenty_four = $now + (24* 60 * 60);
        $expirationTime = date('Y-m-d H:i:s', $Twenty_four);
    
        
        $query = "INSERT INTO `story` (StoryID, `image`, `timestamp`, `expiration_time`)
                  VALUES ('', '$Story->image', NOW(), '$expirationTime')";
        return $this->db->insert($query);
      } else {
        echo "Error in Database Connection";
        return false;
      }
    }



    public function getStory()
    {
         $this->db=new DBController;
         if($this->db->openConnection())
         {
            $query="SELECT * FROM `story` ORDER BY `story`.`StoryID` DESC LIMIT 5";
            return $this->db->select($query);
         }
         else
         {
            echo "Error in Database Connection";
            return false; 
         }
        }




        public function deleteStory(story $Story)
        {
           $this->db = new DBController;
           $StoryID=$Story->getStoryID();
           if ($this->db->openConnection()) {
              $query = "DELETE FROM `story` WHERE `StoryID`='$StoryID'";
              return $this->db->delete($query);
           } else {
              echo "Error in Database Connection";
              return false;
           }
          }

          public function deleteExpiredStories($StoryID){
          $this->db = new DBController;

            if ($this->db->openConnection()) {
                
                $query = "SELECT `expiration_Time` FROM `story` WHERE `StoryID`='$StoryID'";
                $result = $this->db->runQuery($query);
                if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $expirationTime = strtotime($row['expiration_Time']);
                if (time() >= $expirationTime) {
                    
                    $query = "DELETE FROM `story` WHERE `StoryID`='$StoryID'";
                    return $this->db->delete($query);
                } else {
                    
                    return false;
                }
                } else {
                
                echo "Error: Story not found";
                return false;
                }
            } else {
                echo "Error in Database Connection";
                return false;
            }

          }
}



?>