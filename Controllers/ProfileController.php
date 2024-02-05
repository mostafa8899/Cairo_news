<?php 

require_once '../../Models/Users.php';
require_once '../../Controllers/DBController.php';
class profileContoller
{
    protected $db;

    

    public function editprofile(Users $user)
    {
        $this->db=new DBController;
        if($this->db->openConnection())
        {
            $username = $user->getusername();
            $Pass = $user->getPass();
            $query="UPDATE `users` SET `pass`='$Pass',`email`='$user->email',`FullName`='$user->FullName' where `users`.`username`='$username'";
            $result=$this->db->update($query);
            if($result!==false)
            {
                // session_start();
                // $_SESSION["userId"]=$result;
                $_SESSION["username"]=$username;
               
                // $this->db->closeConnection();
                return true;
            }
            else
            {
                $_SESSION["errMsg"]="Somthing went wrong... try again later";
                // $this->db->closeConnection();
                return false;
            }
        }
        else
        {
            echo "Error in Database Connection";
            return false;
        }
    }
    
    public function getuser(Users $user)
    {
         $this->db=new DBController;
         if($this->db->openConnection())
         {
            $username = $user->getusername();
            $query="SELECT * FROM `users` WHERE username='$username'";
            return $this->db->select($query);
         }
         else
         {
            echo "Error in Database Connection";
            return false; 
         }
        }

        public function SetIamge(Profile $profile)
        {
            $this->db=new DBController;
            if($this->db->openConnection())
            {
                $query="UPDATE `users` SET `image` = '$profile->image' WHERE `users`.`username` = '$profile->username';";
                $result=$this->db->update($query);
                if($result!==false)
                {
                   
                   
                    // $this->db->closeConnection();
                    return true;
                }
                else
                {
                    $_SESSION["errMsg"]="Somthing went wrong... try again later";
                    // $this->db->closeConnection();
                    return false;
                }
            }
            else
            {
                echo "Error in Database Connection";
                return false;
            }
        }
}



?>
