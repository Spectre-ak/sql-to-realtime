<?php
session_start();
$type=$_POST['type'];
$name=$_POST['msg'];

$serverName = "xx";
$connectionOptions = array("Database" => "xx", 
    "Uid" => "xx", 
    "PWD" => "xx");
$conn = sqlsrv_connect($serverName, $connectionOptions) or die( print_r( sqlsrv_errors(), true));

$result="ok";

$_SESSION['type']=$type;
$_SESSION['chk']=$name;
$iden=uniqid($name);
$_SESSION['thisUser']=$iden;

if($type=="create"){
	$tsql= "CREATE TABLE $name ( msg VARCHAR(5000)) "; 
	$getResults= sqlsrv_query($conn, $tsql);
    if ($getResults == FALSE){ 
       $result="nameInUse";echo json_encode($result);exit();
    }
    $tsql= "ALTER TABLE $name ADD $iden varchar(4000)";    
	$getResults= sqlsrv_query($conn, $tsql);
    if ($getResults == FALSE){ 
       $result="error";
    }
}
else{
    $tsql="ALTER TABLE $name ADD $iden varchar(4000)";
    $getResults= sqlsrv_query($conn, $tsql);
    if ($getResults == FALSE){ 
       $result="room does not exist";
       echo json_encode($result);exit(); 
    }
}


echo json_encode($result);

?>