<?php
 require_once "Person.php";
class Users extends Person
{
    private $username;
    private $Pass;
    public  $position;
    public  $FullName;
    public  $email;
    public  $image;

    function __construct($username='',$Pass='') {
        $this->username = $username;
        $this->Pass= $Pass;
      }

    



    public function getusername(){
        return $this->username;
    }

    public function setusername($username){
        $this->username=$username;
    }
    public function getPass(){
      return $this->Pass;
  }

  public function setPass($ps){
      $this->Pass=$ps;
  }  


}
?>