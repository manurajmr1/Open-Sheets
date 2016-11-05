<html>
	<head>
		<title>Socket notification</title>
	</head>
	<body >
	<div style="display:none;">
		<div id="status"> test
		</div>
		<div id="comment">
			<input type = "text" id = "name" value ='shahid' size = "40"><br><br>
			<textarea cols = "30" rows = "10" id = "comment" >test cmt</textarea><br><br>
			
			<input type = "text" id = "u_id" size = "40" value ='1'><br><br>
			<input type = "button" id = "addComment" value = "Comment"  ><br>
			<span id = "message"> test</span>
		</div>
	</div>
	<!--<?php

	$stud_id =$this->session->userdata('logged_in_user_id'); 
	?> -->
	</body>
	<script src="http://localhost:8080/socket.io/socket.io.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script language="JavaScript">
		$(document).ready(function(){
			/*var socket = io();*/

			var socket = io.connect( 'http://localhost:8080' );
			$(window).on('beforeunload', function(){
			    socket.close();
			});
			/*$.get("/getStatus",function(data){
				if(data.error) {
					$("#message").empty().text(data.message);
				} else {
					$("#status").text(data.message[0].UserPostContent);
				}
			});*/
		//$("#status").text(data.message[0].UserPostContent);
			//$("#addComment").click(function(event){  alert(1);
				$("#addComment").on('click', function () {  alert(1);
				var userName = $("#name").val();
				var userComment = $('textarea#comment').val(); //alert(userComment);  
				var u_id = $("#u_id").val();
				if(userName === "" || userComment === "") {
					alert("Please fill the form.");
					return;
				}
				socket.emit('comment added',{user : userName, comment : userComment , u_id : u_id });
				socket.on('notify everyone',function(msg){
					notifyMe(msg.user,msg.comment,msg.u_id);
				});
			});
		});
		function notifyMe(user,message,u_id) { 
			// var stud_id=<?php  echo  $stud_id ;?>;alert(stud_id);

		//	if(stud_id == '423'){


					  // Let's check if the browser supports notifications
					  if (!("Notification" in window)) {
						alert("This browser does not support desktop notification");
					  }
					  // Let's check if the user is okay to get some notification
					  else if (Notification.permission === "granted") { 
						// If it's okay let's create a notification
					  var options = {
							body: user + " Posted a comment " + message,
							 icon: "icon.jpg",
							dir : "ltr"
						};
					  var notification = new Notification("Hi there",options);
					  }
					  // Otherwise, we need to ask the user for permission
					  // Note, Chrome does not implement the permission static property
					  // So we have to check for NOT 'denied' instead of 'default'
					  else if (Notification.permission !== 'denied') {
						Notification.requestPermission(function (permission) {
						  // Whatever the user answers, we make sure we store the information
						  if (!('permission' in Notification)) {
							Notification.permission = permission;
						  }
						  // If the user is okay, let's create a notification
						  if (permission === "granted") {
							var options = {
								body: user + " Posted a comment " + message,
								 icon: "icon.jpg",
								dir : "ltr"
							  };
							var notification = new Notification("New comment added.",options);
						  }
						});
					  }
					  // At last, if the user already denied any notification, and you
					  // want to be respectful there is no need to bother them any more.
		//	}

		
	}
	</script>
</html>
