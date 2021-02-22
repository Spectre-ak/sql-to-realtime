<?php
$result="ok";

if(isset($_POST['msg'])){
	$msg=$_POST['msg'];
	session_start();

	$type=$_SESSION['type'];
	$name=$_SESSION['chk'];
	$thisUser=$_SESSION['thisUser'];

	$serverName = "xx";
	$connectionOptions = array("Database" => "xx", 
	    "Uid" => "xx", 
	    "PWD" => "xx");
	$conn = sqlsrv_connect($serverName, $connectionOptions) or die( print_r( sqlsrv_errors(), true));

	$sql = "SELECT * FROM $name";
	$stmt = sqlsrv_query( $conn, $sql );
	if( $stmt === false) {
	    $result="error1"; 
		echo json_encode($result);exit();
	}
	
	$exe1=true;
	foreach(sqlsrv_field_metadata($stmt) as $field){
	    // echo $field['Name']; // The Name key provides the column name
	    $col=$field['Name'];
	    if($col==$thisUser)continue;
	    if($exe1){
			$sql = "INSERT INTO $name ($col) VALUES ('$msg')"; 
			$exe1=false;
		}
	    else
			$sql = "UPDATE $name set $col= '$msg' where msg='$msg' "; 
		$stmt = sqlsrv_query( $conn, $sql );
		if( $stmt === false) {
		    $result=$sql;     
			echo json_encode($result);exit();
		}
	}


     
}


echo json_encode($result);
?>