<?php 

require_once '../../Models/Notification.php';
require_once '../../Controllers/DBController.php';
require_once '../../Controllers/AuthController.php';
class NotificationController
{
    protected $db;
    public function sendNotification( Notification $Notification)
    {
         $this->db=new DBController;
         if($this->db->openConnection())
         {  

            $query = "INSERT INTO `notification`(`content`, `NotificationID`, `DateAdded`) VALUES ('$Notification->content', '', NOW())";
            return $this->db->insert($query);
         }
         else
         {
            echo "Error in Database Connection";
            return false; 
         }
    }

    public function getAllNotification()
    {
         $this->db=new DBController;
         if($this->db->openConnection())
         {
            $query="  select * FROM notification ORDER BY NotificationID DESC" ;
            return $this->db->select($query);
         }
         else
         {
            echo "Error in Database Connection";
            return false; 
         }
        }
        public function deletenotification(Notification $Notification)
        {
           $this->db = new DBController;
           $NotificationID=$Notification->getNotificationID();
           if ($this->db->openConnection()) {
              $query = "DELETE FROM `notification` WHERE `NotificationID`='$NotificationID'";
              return $this->db->delete($query);
           } else {
              echo "Error in Database Connection";
              return false;
           }
          }
    
    
}