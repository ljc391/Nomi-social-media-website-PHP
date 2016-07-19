<?php
    include("mysql_connect.php");
    session_start();
    if (!isset($_SESSION['u_id'])) header("Location: login.php") ;

    $u_id = $_SESSION['u_id'];
    $u_name = $_SESSION['u_name'];
    $message = $_SESSION['message'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>Chat</title>

    <title>Nomi in the House~</title>
    <?php include('_headCommon.php');?>

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script type="text/javascript" src="chat.js"></script>
    <script type="text/javascript">

        // ask user for name with popup prompt
        var name = "<?php echo $u_name ?>";


        // display name on page
        $("#name-area").html("You are: <span>" + name + "</span>");

        // kick off chat
        var chat =  new Chat();
        $(function() {

             chat.getState();

            setInterval(chat.update, 1000);
            //setTimeout(chat.update, 1000);

             // watch textarea for key presses
             $("#sendie").keydown(function(event) {

                 var key = event.which;

                 //all keys including return.
                 if (key >= 33) {

                     var maxLength = $(this).attr("maxlength");
                     var length = this.value.length;

                     // don't allow new content if length is maxed out
                     if (length >= maxLength) {
                         event.preventDefault();
                     }
                  }
                                                                                                                                                                                                            });
             // watch textarea for release of key press
             $('#sendie').keyup(function(e) {

                  if (e.keyCode == 13) {

                    var text = $(this).val();
                    var maxLength = $(this).attr("maxlength");
                    var length = text.length;

                    // send
                    if (length <= maxLength + 1) {

                        chat.send(text, name);
                        $(this).val("");

                    } else {

                        $(this).val(text.substring(0, maxLength));

                    }


                  }
             });

        });
    </script>

</head>

<body onload="">
    <nav class="navbar navbar-fixed-top">
            <div class="nav navbar-nav navbar-left nomiimg">
                <img src="image/nomi_icon.png" width = "50px">
                <a href="index.php">NOMI</a>
            </div>



                <form class="navbar-form navbar-right nomisear " role="search">
                  <div class=" form-group">
                    <input type="text" id = "inputbox" class="form-control" placeholder="Search">
                    <ul class="list-group" id="searchresult" style="z-index:1000; position:absolute;">

                    </ul>
                  </div>
                </form>
                <ul class="nav navbar-nav navbar-right nomibtn">
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"   ><img src="image/edit.png" width = "50px"></a>
                  <ul class="dropdown-menu">
                    <li><a  class ="glyphicon glyphicon-log-out" href="#logout"> Logout</a></li>
                    <li><a class = "glyphicon glyphicon-pencil"href="edit.php"> Edit </a></li>
                    <li><a class = "glyphicon glyphicon-envelope"href="message.php" id = "message"> Chat Room </a></li>
                  </ul>
                </li>

            </ul>

        </div>
    </nav>

    <div id="page-wrap" class = "container content" align = "center">

        <h2>Chat Room</h2>

        <p id="name-area"> Welcome to the chat room <?php echo $u_name; ?> !</p>

        <div id="chat-wrap"  >
            <div id="chat-area"></div>
        </div>

        <form id="send-message-area">
            <textarea id="sendie" maxlength = '100'  class="form-control" rows="1" id="comment"  ></textarea>
        </form>

    </div>

    <?php include('_footer.php');?>
    <?php include('_scripts.php');?>
</body>

</html>