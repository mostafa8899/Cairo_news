<?php 

require_once '../../Models/Users.php';
require_once '../../Controllers/DBController.php';
class AuthController
{
    protected $db;

 
    public function login(Users $user)
    {
        $this->db=new DBController;
        if($this->db->openConnection())
        {
            $username = $user->getusername();
            $Pass = $user->getPass();
            $query="SELECT * FROM users WHERE username='$username' AND pass ='$Pass'";
            $result=$this->db->select($query);
            if($result===false)
            {
                echo "Error in Query";
                return false;
            }
            else
            {
                if(count($result)==0)
                {
                    session_start();
                    $_SESSION["errMsg"]="You have entered wrong Username or password";
                    $this->db->closeConnection();
                    return false;
                }
                else
                {
                    session_start();
                    
                    $_SESSION["username"]=$result[0]["username"];
                    
                    $_SESSION["password"]=$result[0]["pass"];
                    $_SESSION["position"]=$result[0]["position"];
                    $_SESSION["Name"]=$result[0]["FullName"];
                    $_SESSION["Email"]=$result[0]["email"];
                    $_SESSION["photo"]=$result[0]["image"];
                    if($result[0]["position"]=='admin')
                    {
                        $_SESSION["position"]="admin";
                    }
                    else if($result[0]["position"]=='user')
                    {
                        
                        $_SESSION["position"]="user";
                    }
                    else
                    {
                        $_SESSION["position"]="author";
                        echo "error";
                    }
                    $this->db->closeConnection();
                    return true;
                    
                }
                
                
            }
        }
        else
        {
            echo "Error in Database Connection";
            return false;
        }
    }
    public function register(Users $user)
    {
        $this->db=new DBController;
        if($this->db->openConnection())
        {
            $username = $user->getusername();
            $Pass = $user->getPass();
    
        
            $query="SELECT * FROM `users` WHERE `username`='$username'";
            $result=$this->db->runQuery($query);
    
            if(mysqli_num_rows($result) > 0) {
               
                $_SESSION["errMsg"]="Username already exists";
                $this->db->closeConnection();
                return false;
            }
            else {
               
                $query="INSERT INTO `users`(`username`, `pass`, `email`, `position`, `FullName`) VALUES ('$username','$Pass','$user->email','user','$user->FullName')";
                $result=$this->db->insert($query);
                if($result!==false)
                {
                    session_start();
                    $username = $_SESSION['username'];
                  
                   
                    $this->db->closeConnection();
                    return true;
                }
                else
                {
                    $_SESSION["errMsg"]="Something went wrong... try again later";
                    $this->db->closeConnection();
                    return false;
                }
            }
        }
        else
        {
            echo "Error in Database Connection";
            return false;
        }
    }

    public function addAuthor(Users $Author)
    {
        $this->db=new DBController;
        if($this->db->openConnection())
        {
            $username = $Author->getUsername();
            $pass = $Author->getPass();
            
    
            // Check if the username already exists
            $query="SELECT * FROM `users` WHERE `username`='$username'";
            $result=$this->db->runQuery($query);
    
            if(mysqli_num_rows($result) > 0) {
                // Username already exists
                $_SESSION["errMsg"]="Username already exists";
                $this->db->closeConnection();
                return false;
            }
            else {
                // Username is unique, proceed with insert query
                $query="INSERT INTO `users`(`username`, `pass`, `email`, `position`, `FullName`) VALUES ('$username','$pass','$Author->email','author','$Author->FullName')";
                $result=$this->db->insert($query);
                if($result!==false)
                {
                    return true;
                }
                else
                {
                    $_SESSION["errMsg"]="Something went wrong... try again later";
                    // $this->db->closeConnection();
                    return false;
                }
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