<?php
 
class Notification
{
    public $content;
    private $NotificationID;

    public function __construct($NotificationID='')
    {
        $this->NotificationID = $NotificationID;
    }

    public function setNotificationID($NotificationID)
    {
        $this->NotificationID = $NotificationID;
    }

    public function getNotificationID()
    {
        return $this->NotificationID;
    }
    
}

?>