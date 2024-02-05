<?php
 
 class Subscription
 {
     private $UserName;
     public $package;
     private $CrdCard;
     private $SubID;
 
     public function __construct($SubID='',$CrdCard='',$UserName='')
     {
         $this->SubID = $SubID;
         $this->CrdCard = $CrdCard;
         $this->UserName = $UserName;
     }
 
     public function setSubID($SubID)
     {
         $this->SubID = $SubID;
     }
 
     public function getSubID()
     {
         return $this->SubID;
     }
 
     public function setUserName($UserName)
     {
         $this->UserName = $UserName;
     }
 
     public function getUserName()
     {
         return $this->UserName;
     }
 
     public function setCrdCard($CrdCard)
     {
         $this->CrdCard = $CrdCard;
     }
 
     public function getCrdCard()
     {
         return $this->CrdCard;
     }
 
  
 }

?>