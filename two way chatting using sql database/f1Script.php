<?php
    
$servername = "x";
$username = "x";
$password = "x";
$database="x";
$mysqli = new mysqli($servername, $username, $password, $database);
$mysqli->select_db($database) or die( "Unable to select database");
$msg=array();
	
$tt=$_POST['msg'];
$tsql= "INSERT INTO `dbo.f1` (msg) VALUES ('$tt')"; 

if ($result = $mysqli -> query($tsql)) {
	$msg['msg']="done";
}else{
	$msg['msg']="err";
}


echo  json_encode($msg);   

?>
