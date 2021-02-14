<?php
    
    $servername = "x";
    $username = "x";
    $password = "x";
    $database="x";
    $mysqli = new mysqli($servername, $username, $password, $database);
    $mysqli->select_db($database) or die( "Unable to select database");
    $msg=array();
	
	$tt=$_POST['msg'];
    $tsql= "SELECT * FROM `dbo.f2` "; 

	if ($result = $mysqli -> query($tsql)) {
    	while ($row = $result -> fetch_assoc()) { 
            array_push($msg,$row['msg']);
        }
	}else{
		$msg['msg']="err";
	}
    
    $tsql= "TRUNCATE TABLE `dbo.f2` "; 

	if ($result = $mysqli -> query($tsql)) {
        array_push($msg,"done");
    }
    else{
        array_push($msg,"err");
    }
	
	echo  json_encode($msg);   

?>