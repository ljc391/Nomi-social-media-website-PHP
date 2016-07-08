var instanse = false;
var state;
var mes;
var file;
var m_time;

function Chat () {
    this.update = updateChat;
    this.send = sendChat;
	this.getState = getStateOfChat;
}
function scrollWin(x, y) {
	var element = document.getElementById('chat-area');
    element.scrollBy(x, y);
}

//gets the state of the chat
function getStateOfChat(){
	if(!instanse){
		 instanse = true;
		 $.ajax({
			   type: "POST",
			   url: "process.php",
			   data: {
			   			'function': 'getState',
						'file': file
						},
			   dataType: "json",

			   success: function(data){
				   state = data.state;
				   m_time = data.m_time;
				   instanse = false;
			   },
			});
	}
}

//Updates the chat
function updateChat(){
	 if(!instanse){
		 instanse = true;
	     $.ajax({
			   type: "POST",
			   url: "process.php",
			   data: {
			   			'function': 'update',
						'state': state,
						'm_time': m_time,
						'file': file
						},
			   dataType: "json",
			   success: function(data){
				   /*
				   if(data.text){
						for (var i = 0; i < data.text.length; i++) {
                            $('#chat-area').append($("<p>"+ data.text[i] +"</p>"));
                        }
				   }
				   */

				   if(data.message){
						for (var i = 0; i < data.message.length; i++) {
                            $('#chat-area').append($("<p><span>"+ data.message[i].u_id +"</span>"+data.message[i].m_text+"</p>"));
                        	//$('#chat-area').append($("<p><i>["+ data.message[i].u_id +"]</i>:<br/>"+data.message[i].m_text+"</p>"));
                        	m_time = data.message[i].m_time;
                        	//scrollWin(0, 50);
                        }
				   }
				   //scrollWin(0, 50);
				   document.getElementById('chat-area').scrollTop = document.getElementById('chat-area').scrollHeight;
				   instanse = false;
				   state = data.state;

			   },
			});
	 }
	 else {
	 	//console.log('EH?');
		 setTimeout(updateChat, 1500);
	 }
}

//send the message
function sendChat(message, nickname)
{
    updateChat();
     $.ajax({
		   type: "POST",
		   url: "process.php",
		   data: {
		   			'function': 'send',
					'message': message,
					'nickname': nickname,
					'file': file
				 },
		   dataType: "json",
		   success: function(data){
			   updateChat();
		   },
		});
}
