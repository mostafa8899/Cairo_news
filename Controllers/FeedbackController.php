<?php 

require_once '../../Models/Users.php';
require_once '../../Controllers/DBController.php';
require_once '../../Controllers/AuthController.php';
class FeedbackController
{
    protected $db;
    public function sendFeedback(Feedbacks $feedback ,Users $user)
    {
         $this->db=new DBController;
         if($this->db->openConnection())
         {     
            $username = $user->getusername();

            $query="INSERT INTO `feedback` (`feedID`, `content`, `username`) VALUES (NULL, '$feedback->content', '$username');";
            return $this->db->insert($query);
         }
         else
         {
            echo "Error in Database Connection";
            return false; 
         }
    }

    public function getAllFeedback()
    {
         $this->db=new DBController;
         if($this->db->openConnection())
         {
            $query="SELECT * FROM `feedback` ORDER BY `feedback`.`feedID` DESC";
            return $this->db->select($query);
         }
         else
         {
            echo "Error in Database Connection";
            return false; 
         }
        }
    
}