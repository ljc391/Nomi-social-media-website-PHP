var instanse = false;
var state;
var mes;
var file;
var m_time;

function Notifier () {
    this.update = notifyuser;
    this.send = sendnotify;
    this.getState = getStateOfNotification;
}
function scrollWin(x, y) {
    var element = document.getElementById('chat-area');
    element.scrollBy(x, y);
}

//gets the state of the chat
function getStateOfNotification(){
    if(!instanse){
         instanse = true;
         $.ajax({
               type: "POST",
               url: "process_notify.php",
               data: {
                        'function': 'getState'
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
function notifyuser(postId){

      $.ajax({
        type: "GET",
            url:'./getapi.php',
        data:{
          action:'notifyUser',
          postId:postId
        },
        dataType:'json',
        success: function(response){
          if (response.success){
            console.log(response.data);


                  var t = "<?php echo($u_id); ?>";
                  if(response.data.includes(t)){
                      alert("notify!!");

              }else{
                console.log("no need to notify")
              }




          }else{
            console.log("success error");
          }
        },
        error: function(response){
          console.log(response);
        }

      });
      //setTimeout(notifyuser(postId), 15000); // Every 15 seconds.
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
