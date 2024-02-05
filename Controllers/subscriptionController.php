<?php 

require_once '../../Models/Subscription.php';
require_once '../../Controllers/DBController.php';
require_once '../../Controllers/AuthController.php';
class subscriptionController
{
    protected $db;
  


   public function setsubscripe(Subscription $Subscription)
    {
        $this->db = new DBController;
        if ($this->db->openConnection()) {
            $UserName=$Subscription->getUserName();
            $CrdCard=$Subscription->getCrdCard();
            $query = "SELECT * FROM subscription WHERE UserName ='$UserName'";
            $result = $this->db->runQuery($query);
    
            // Check if link_url already exists in table
            if (mysqli_num_rows($result) == 0) {
                $query = "INSERT INTO `subscription`(`UserName`, `package`, `CrdCard`, `SubID`) VALUES ('$UserName','$Subscription->package','$CrdCard','')";
                return $this->db->insert($query);
                
            } else {
               $query = "UPDATE `subscription` SET `package`='$Subscription->package',`CrdCard`='$CrdCard' where UserName ='$UserName'";
               return $this->db->update($query);
            }
        } else {
            echo "Error in Database Connection";
            return false;
        }
    }

    public function getsupscripe($username)
    {
         $this->db=new DBController;
         if($this->db->openConnection())
         {
            $query="select * FROM `subscription` WHERE UserName='$username'";
            return $this->db->select($query);
         }
         else
         {
            echo "Error in Database Connection";
            return false; 
         }
        }
    
}