<?php
  
header("Content-Type: text/event-stream");
header("Cache-Control: no-cache");
  
  echo "retry: 1000\n\n"; 
  echo "data: " . " no message " . "\n\n"; //message which will be sent 
  flush();  
?> 
