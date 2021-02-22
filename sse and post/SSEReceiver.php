<?php

session_start();          
header("Content-Type: text/event-stream");
header("Cache-Control: no-cache");
 

$type=$_SESSION['type'];
$name=$_SESSION['chk'];
$thisUser=$_SESSION['thisUser'];

$ans=array();

if(isset($_SESSION['chk'])){
	$serverName = "xx";
	$connectionOptions = array("Database" => "xx", 
	    "Uid" => "xx", 
	    "PWD" => "xx");
	$conn = sqlsrv_connect($serverName, $connectionOptions) or die( print_r( sqlsrv_errors(), true));

	$sql = "SELECT * FROM $name";

	$stmt = sqlsrv_query( $conn, $sql );
	if( $stmt === false) {
	    $result="error";
		echo json_encode($result);exit();
	}

	while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
	   array_push($ans,$row[$thisUser]); 
	   $ms=$row['msg'];
	    $tsql  = "update $name set $thisUser=null where msg='$ms' ";     
		$stmt1 = sqlsrv_query( $conn, $tsql); 
		if(!$stmt1){
			array_push($ans,sqlsrv_errors());  
		}                  
	} 

	$ans=json_encode($ans);
	echo "retry: 1000\n\n"; 
	echo "data:" ."$ans  \n\n" ;         
	flush();
}
else{
	$ans=json_encode($ans); 
	echo "retry: 1000\n\n"; 
	echo "data:" ."$ans \n\n" ;         
	flush();
}
  

?>