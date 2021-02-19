<?php

header("Content-Type: text/event-stream");
header("Cache-Control: no-cache");
  


$serverName = "xx";
$connectionOptions = array("Database" => "xx", 
    "Uid" => "xx", 
    "PWD" => "xx");
$conn = sqlsrv_connect($serverName, $connectionOptions) or die( print_r( sqlsrv_errors(), true));

$tsql= "SELECT * FROM dbo.common"; 

$msg=array();

$getResults= sqlsrv_query($conn, $tsql);
while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)){
	array_push($msg,$row['msg']);
}

$tsql= "TRUNCATE TABLE dbo.common;"; 

$getResults= sqlsrv_query($conn, $tsql);

$msg=json_encode($msg);

echo "retry: 1000\n\n"; 
echo "data: " . " $msg " . "\n\n"; 
flush();  



?>