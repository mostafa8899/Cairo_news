<?php 

class Feedbacks
{
    private $feedID;
    public $adminName;
    public $content;

    public function __construct($feedID='')
    {
        $this->feedID = $feedID;
    }

    public function setFeedID($feedID)
    {
        $this->feedID = $feedID;
    }

    public function getFeedID()
    {
        return $this->feedID;
    }
}
?>