<?php

session_start();

if(isset($_SESSION['chk'])){
  $type=$_SESSION['type'];
$name=$_SESSION['chk'];
$thisUser=$_SESSION['thisUser'];

echo("
    <script>
	   	window.onload=function(){
	   		document.getElementById('roomID').innerHTML='$name';
	   		document.getElementById('userID').innerHTML='$thisUser';
	    }
	</script>
    ");
}

else{
  echo("
    <script>
	   	window.location.href='../JoinOrCreate.html'; 
	</script>
    ");
}


        

?>
<!DOCTYPE html>
<html>
<head> 
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

	<title>Room</title>
</head>
<body style="background-color: #131316;color:white" > 
	
<div class="container">
	<h5>your room name is <strong id="roomID">dfg</strong> and id is <strong id="userID"></strong></h5> 
	


	<div class="container" id="divForMessagingArea">
          
    </div>

    <p><input  type="text" class="messageInput" id="inputSendMessage" name="usernameLogin" placeholder="Msg..." required>

     <big><i onclick="sendFunc();" class="fa fa-paper-plane fa-lg" aria-hidden="true" style="padding-left: 10px;"></i></big>
    </p>
	
		
</div>
 
<script>
	function sendAndReceiveMessageUIUpdate(msg,flagForSendingOrReceiving){
      var msgComplete=document.createElement("p");
      
      var msgElement=document.createElement("a");
      msgElement.innerHTML=msg;

      msgComplete.appendChild(msgElement);
      

      if(flagForSendingOrReceiving)
        msgComplete.style.textAlign="right";

      document.getElementById("divForMessagingArea").appendChild(msgComplete);
      document.getElementById("divForMessagingArea").scrollTop=document.getElementById("divForMessagingArea").scrollHeight;

      if(flagForSendingOrReceiving)
        document.getElementById("inputSendMessage").value="";

    }

	function sendFunc(){
		if(document.getElementById("inputSendMessage").value=="")return; 
		var fd = new FormData();
		console.log(document.getElementById("inputSendMessage").value); 
		fd.append('msg',document.getElementById("inputSendMessage").value);
		$.ajax({
			url: 'SendMessage.php',
			type: 'post',
			data: fd, 
			contentType: false,
			processData: false,
			success: function(response){
				console.log(response);
				sendAndReceiveMessageUIUpdate(document.getElementById("inputSendMessage").value,true);
			},
		});
	}

	if(typeof(EventSource)!="undefined"){
	   var source=new EventSource("SSEReceiver.php");
	   source.onmessage=function(event){
       console.log(event.data); 
   		  var data=JSON.parse(event.data); 
         
   		  for (var i = 0; i<data.length; i++) {
   		  	sendAndReceiveMessageUIUpdate(data[i],false);
   		  }
	      
	   } 
	}
	else{
	   document.getElementById("result").innerHTML="Sorry, your browser does not support    server-sent events...";
	}
  
  
  setInterval(function(){ 
        var fd = new FormData();

		fd.append('msg',"del");
		
		$.ajax({
			url: 'RemoveEmptyRows.php',
			type: 'post',
			data: fd, 
			contentType: false,
			processData: false,
			success: function(response){
				response=JSON.parse(response); 
				console.log(response);
				
				
			},
		}); 
        
      }, 8000);
      
      
      
      
	
	

</script>


<style>
  
  
  #divForMessagingArea{
    color: white;
    width: 100%;
    
    height:87vh;
    
    border: 2px solid #34755b;
    border-radius: 29px;
    overflow-x: hidden; 
       overflow-y: auto
  }

  .messageInput{

      color: white;
      background-color: #131316;
      width: 80%;
      height: 40px;
      padding: 1% 4% 1%;
      margin: 2px;
      border: 2px solid #0c82e2;
      border-radius: 20px;
  }

  



::-webkit-scrollbar {
  width: 3px;
  border-radius: 10px;
  opacity: 0.0;
}

/* Track */
::-webkit-scrollbar-track {
  background: #0b0b0c00;; 
   border-radius: 10px;
}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background: #6c757d; 
   border-radius: 10px;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #555; 
}
</style>


<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>




</body>
</html>