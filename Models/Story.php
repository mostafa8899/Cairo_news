<?php
 
 class story
 {
     public $image;
     private $StoryID;
 
     public function __construct($StoryID='')
     {
         $this->StoryID = $StoryID;
     }
 
     public function setStoryID($StoryID)
     {
         $this->StoryID = $StoryID;
     }
 
     public function getStoryID()
     {
         return $this->StoryID;
     }
 }

?>