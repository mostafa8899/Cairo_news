<?php
  
  require_once '../../Controllers/DBController.php';
  require_once '../../Controllers/AuthController.php';

$conn=mysqli_connect("localhost","root", "", "caironews");
//$db_select=mysqli_select_db($conn) or die(mysqli_error());
//$dbhost="localhost"; 

//$dbuser = "root"; 

//$dbpass = ""; 


  //$conn= new mysqli($dbhost, $dbuser, $dbpass, 'caironews');
if($conn->connect_error) die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
?>