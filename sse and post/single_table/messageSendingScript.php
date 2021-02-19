<?php
 
//this is the common script for sending messages to the database

$retrun=array();
if(isset($_POST['msg'])){
	$serverName = "xx";
	$connectionOptions = array("Database" => "xx", 
	    "Uid" => "xx", 
	    "PWD" => "xx");
	$conn = sqlsrv_connect($serverName, $connectionOptions) or die( print_r( sqlsrv_errors(), true));

	$tt=$_POST['msg'];
	$tsql= "INSERT INTO dbo.common (msg) VALUES ('$tt')"; 

	$get_results=sqlsrv_query($conn,$tsql);

	if(!$get_results)
		$retrun['msg']="error";
	else $retrun['msg']="done";

}

echo json_encode($retrun);


?>