<?php
  
  session_start();
header("Content-Type: text/event-stream");
header("Cache-Control: no-cache");
  
  echo "retry: 1000\n\n"; 
  echo "data: " . " no message " . "\n\n"; 
  flush();  

  
//echo "retry: 500\n\n";  
//echo "data: "." msg form server ";  
//flush(); 
       

/* if(isset($_SESSION['msg'])){
    
  echo "retry: 1000\n\n"; 
  echo "data: " . "message" . "\n\n"; 
  flush(); 
 

 }
 else{
    
  echo "retry: 1000\n\n"; 
  echo "data: " . "no messager" . "\n\n"; 
  flush(); 
} */
 
  


 
?> 