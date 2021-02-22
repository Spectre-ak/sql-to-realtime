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
	$rows=array();
	
	$exe1=true;
	foreach(sqlsrv_field_metadata($stmt) as $field){
	    // echo $field['Name']; // The Name key provides the column name
	    $col=$field['Name'];
	    array_push($rows,$col);
	}

	$sql = "SELECT * FROM $name";

	$stmt = sqlsrv_query( $conn, $sql );
	if( $stmt === false) {
	    $result="error";
		echo json_encode($result);exit();
	}

	while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
	   $con=0;
	   for($i=0;$i<count($rows);$i++){
		   if($row[$rows[$i]]==null)$con++;
	   }
	   if($con==count($rows)-1){
		   $m=$row['msg'];
		   $tsql="DELETE FROM $name WHERE msg='$m' ";
		   $stmt2 = sqlsrv_query( $conn, $tsql );
			if( $stmt2 === false) {
				$result="error";
				echo json_encode($result);exit();
			}
	   }                  
	}
	
	
	
	
     
}


echo json_encode($result);
?>