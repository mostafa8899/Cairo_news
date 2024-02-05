<?php 

require_once '../../Models/Jokes.php';
require_once '../../Controllers/DBController.php';
require_once '../../Controllers/AuthController.php';
class JokesController
{
    protected $db;
    public function AddJokes( Jokes $Joke)
    {
         $this->db=new DBController;
         if($this->db->openConnection())
         {  

            $query="INSERT INTO `jokes`(`JokesID`,  `Content`) VALUES ('','$Joke->Content')";
            return $this->db->insert($query);
         }
         else
         {
            echo "Error in Database Connection";
            return false; 
         }
    }

    public function getJokes()
    {
         $this->db=new DBController;
         if($this->db->openConnection())
         {
            $query="  select * FROM Jokes ORDER BY JokesID DESC" ;
            return $this->db->select($query);
         }
         else
         {
            echo "Error in Database Connection";
            return false; 
         }
        }

        public function deleteJokes(Jokes $Joke)
        {   
            $JokeID=$Joke->getJokesID();
           $this->db = new DBController;
     
           if ($this->db->openConnection()) {
              $query = "DELETE FROM `jokes` WHERE `JokesID`='$JokeID'";
              return $this->db->delete($query);
           } else {
              echo "Error in Database Connection";
              return false;
           }
          }
    
}