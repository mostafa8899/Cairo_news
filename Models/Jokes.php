<?php
 
 class Jokes
 {
     private $JokesID;
     public $AdminName;
     public $Content;
 
     public function __construct($JokesID='')
     {
         $this->JokesID = $JokesID;
     }
 
     public function setJokesID($JokesID)
     {
         $this->JokesID = $JokesID;
     }
 
     public function getJokesID()
     {
         return $this->JokesID;
     }
 }

?>